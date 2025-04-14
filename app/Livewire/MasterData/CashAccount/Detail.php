<?php

namespace App\Livewire\MasterData\CashAccount;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\MasterData\CashAccount;
use App\Repositories\MasterData\CashAccount\CashAccountRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;

class Detail extends Component
{
    
    public $objId;
    
    #[Validate('required', message: 'Nama Akun Kas Harus Diisi', onUpdate: false)]
    public $name;

    #[Validate('required', message: 'Jenis Akun Kas Harus Harus Diisi', onUpdate: false)]
    public $type;

    #[Validate('required', message: 'Jenis Biaya Admin Harus Harus Diisi', onUpdate: false)]
    public $admin_type;

    public $admin_fee;
    public $current_balance = 0;
    public $code;
    public $is_active;

    public $admin_type_choices = [];
    public $type_choices = [];

    public function mount()
    {
        if($this->objId)
        {
            $product = CashAccountRepository::find(Crypt::decrypt($this->objId));
            $this->name = $product->name;
            $this->type = $product->type;
            $this->code = $product->code;
            $this->current_balance = $product->current_balance;
            $this->admin_type = $product->admin_type;
            $this->admin_fee = $product->admin_fee;
            $this->is_active = $product->is_active ? true : false;
        }else{
            $this->type = CashAccount::TYPE_CASH;
            $this->admin_type = CashAccount::ADMIN_TYPE_PERCENTAGE;
        }

        $this->type_choices = CashAccount::TYPE_CHOICE;
        $this->admin_type_choices = CashAccount::ADMIN_TYPE_CHOICE;
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('cash_account.edit', $this->objId);
        }else{
            $this->redirectRoute('cash_account.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('cash_account.index');
    }

    public function store()
    {
        try {       
            $this->validate();
            DB::beginTransaction();

            $validatedData = [
                'name' => $this->name,
                'type' => $this->type,
                'admin_type' => $this->admin_type,
                'admin_fee' => imaskToValue($this->admin_fee),
                'is_active' => $this->is_active,
            ];
            if ($this->objId) {
                $objId = Crypt::decrypt($this->objId);
                CashAccountRepository::update($objId, $validatedData);
            } else {
                $validatedData['current_balance'] = imaskToValue($this->current_balance);
                $obj = CashAccountRepository::create($validatedData);
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
        return view('livewire.master-data.cash-account.detail');
    }
}
