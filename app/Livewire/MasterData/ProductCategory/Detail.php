<?php

namespace App\Livewire\MasterData\ProductCategory;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Repositories\MasterData\ProductCategory\ProductCategoryRepository;
use App\Repositories\MasterData\PriceLevel\PriceLevelRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;

class Detail extends Component
{
    
    public $objId;
    
    #[Validate('required', message: 'Nama Kategori Produk Harus Diisi', onUpdate: false)]
    public $name;

    public function mount()
    {
        if($this->objId)
        {
            $product = ProductCategoryRepository::find(Crypt::decrypt($this->objId));
            $this->name = $product->name;
        }else{
        }

    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('product_category.edit', $this->objId);
        }else{
            $this->redirectRoute('product_category.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('product_category.index');
    }

    public function store()
    {
        try {       
            $this->validate();
            DB::beginTransaction();
            $validatedData = [
                'name' => $this->name,
            ];
            if ($this->objId) {
                $objId = Crypt::decrypt($this->objId);
                ProductCategoryRepository::update($objId, $validatedData);
            } else {
                $obj = ProductCategoryRepository::create($validatedData);
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
        return view('livewire.master-data.product-category.detail');
    }
}
