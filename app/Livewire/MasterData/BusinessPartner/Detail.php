<?php

namespace App\Livewire\MasterData\BusinessPartner;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\MasterData\BusinessPartner;
use App\Repositories\MasterData\BusinessPartner\BusinessPartnerRepository;
use App\Repositories\MasterData\PriceLevel\PriceLevelRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;

class Detail extends Component
{
    
    public $objId;
    
    #[Validate('required', message: 'Nama Mitra Bisnis Harus Diisi', onUpdate: false)]
    public $name;

    #[Validate('required', message: 'Level Harga Harus Diisi', onUpdate: false)]
    public $price_level_id;

    public $address;
    public $phone;
    public $is_customer = false;
    public $is_supplier = false;
    public $is_active;

    public $price_level_choices = [];

    public function mount()
    {
        if($this->objId)
        {
            $product = BusinessPartnerRepository::find(Crypt::decrypt($this->objId));
            $this->name = $product->name;
            $this->price_level_id = simple_encrypt($product->price_level_id);
            $this->address = $product->address;
            $this->phone = $product->phone;
            $this->is_customer = $product->is_customer ? true : false;
            $this->is_supplier = $product->is_supplier ? true : false;
            $this->is_active = $product->is_active ? true : false;
        }else{
            $this->price_level_id = simple_encrypt(PriceLevelRepository::first()->id);
        }

        $this->price_level_choices = PriceLevelRepository::all()->map(function ($item) {
            return [
                'id' => simple_encrypt($item['id']),
                'name' => $item['name'],
            ];
        })->toArray();

    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('business_partner.edit', $this->objId);
        }else{
            $this->redirectRoute('business_partner.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('business_partner.index');
    }

    public function store()
    {
        try {       
            $this->validate();
            DB::beginTransaction();
            $phone = preg_replace('/[^\d]/', '', $this->phone);
            if (!preg_match("/^8[0-9]{9,11}$/", $phone) || (strlen($phone) < 9 || strlen($phone) > 11)) {
                throw new \Exception("Format No Telp tidak sesuai,<br>Contoh: +62 8XX-XXXX-XXXX");
            }
            $validatedData = [
                'name' => $this->name,
                'price_level_id' => simple_decrypt($this->price_level_id),
                'address' => $this->address,
                'phone' => $phone,
                'is_customer' => $this->is_customer,
                'is_supplier' => $this->is_supplier,
                'is_active' => $this->is_active,
            ];
            if ($this->objId) {
                $objId = Crypt::decrypt($this->objId);
                BusinessPartnerRepository::update($objId, $validatedData);
            } else {
                $obj = BusinessPartnerRepository::create($validatedData);
                $objId = $obj->id;
            }

            DB::commit();
            Alert::confirmation(
                $this,
                Alert::ICON_SUCCESS,
                "Berhasil",
                "Data Berhasil Diperbarui",
                "on-dialog-confirm",
                "on-dialog-cancel",
                "Oke",
                "Tutup",
            );
        } catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.master-data.business-partner.detail');
    }
}
