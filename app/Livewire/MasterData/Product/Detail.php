<?php

namespace App\Livewire\MasterData\Product;

use Exception;
use App\Helpers\Alert;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\MasterData\Product;
use App\Repositories\MasterData\Product\ProductRepository;
use App\Repositories\MasterData\ProductCategory\ProductCategoryRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\Validate;

class Detail extends Component
{
    
    public $objId;

    #[Validate('required', message: 'Nama Produk Harus Diisi', onUpdate: false)]
    public $name;

    #[Validate('required', message: 'Kategori Produk Harus Diisi', onUpdate: false)]
    public $product_category_id;
    public $product_category_choices = [];
    
    #[Validate('required', message: 'Jenis Produk Harus Diisi', onUpdate: false)]
    public $type;
    public $type_choices = [];

    public $description;
    public $expired_date;
    public $min_stock;
    public $max_stock;
    public $brand;
    public $is_active = true;

    // UNIT
    public $product_units = [
        [
            'id' => null,
            'product_id' => null,   
            'price_level_id' => 1,
            'name' => 'PCS',
            'value' => 1,
            'is_main' => true,
            'barcode' => null,
            'retail_price' => 0,
        ]
    ];

    #[Validate('required', message: 'Harga Beli (HPP) Produk Harus Diisi', onUpdate: false)]
    public $purchase_price;

    public function mount()
    {
        if($this->objId)
        {
            $product = ProductRepository::find(Crypt::decrypt($this->objId));
            $this->name = $product->name;
            $this->product_category_id = $product->product_category_id;
            $this->type = $product->type;
            $this->description = $product->description;
            $this->expired_date = $product->expired_date;
            $this->min_stock = valueToImask($product->min_stock);
            $this->max_stock = valueToImask($product->max_stock);
            $this->brand = $product->brand;
            $this->is_active = $product->is_active ? true : false;
            $this->purchase_price = valueToImask($product->purchase_price);
        }else{
        }

        $this->product_category_choices = ProductCategoryRepository::all()->map(function ($item) {
            return [
                'id' => simple_encrypt($item['id']),
                'name' => $item['name'],
            ];
        })->toArray();

        $this->type_choices = Product::TYPE_CHOICE;
    }

    #[On('on-dialog-confirm')]
    public function onDialogConfirm()
    {
        if ($this->objId) {
            $this->redirectRoute('product.edit', $this->objId);
        }else{
            $this->redirectRoute('product.create');
        }
    }

    #[On('on-dialog-cancel')]
    public function onDialogCancel()
    {
        $this->redirectRoute('product.index');
    }

    public function store()
    {
        try {       
            $this->validate();
            DB::beginTransaction();

            $validatedData = [
                'name' => $this->name,
                'product_category_id' => simple_decrypt($this->product_category_id),
                'type' => $this->type,
                'description' => $this->description,
                'expired_date' => $this->expired_date,
                'min_stock' => $this->min_stock,
                'max_stock' => $this->max_stock,
                'brand' => $this->brand,
                'is_active' => $this->is_active,
                'purchase_price' => imaskToValue($this->purchase_price),
            ];

            if ($this->objId) {
                $objId = Crypt::decrypt($this->objId);
                ProductRepository::update($objId, $validatedData);
            } else {
                $obj = ProductRepository::create($validatedData);
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
        }catch (\Illuminate\Validation\ValidationException $e) {
            $message = $e->validator->errors()->first(); 
            DB::rollBack();
            Alert::fail($this, "Gagal", $message);
        }catch (Exception $e) {
            DB::rollBack();
            Alert::fail($this, "Gagal", $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.master-data.product.detail');
    }
}
