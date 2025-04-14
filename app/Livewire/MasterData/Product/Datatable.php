<?php

namespace App\Livewire\MasterData\Product;

use App\Helpers\Alert;
use App\Models\MasterData\Product;
use App\Permissions\AccessMasterData;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\Livewire\WithDatatable;
use App\Permissions\PermissionHelper;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Account\UserRepository;
use App\Repositories\MasterData\Product\ProductRepository;

class Datatable extends Component
{
    use WithDatatable;

    public $isCanUpdate;
    public $isCanDelete;
    public $isCanUpdateBookingTime;
    public $isCanUpdateDetail;

    // Delete Dialog
    public $targetDeleteId;

    public function onMount()
    {
        $authUser = UserRepository::authenticatedUser();
        $this->isCanUpdate = $authUser->hasPermissionTo(PermissionHelper::transform(AccessMasterData::PRODUCT, PermissionHelper::TYPE_UPDATE));
    }

    #[On('on-delete-dialog-confirm')]
    public function onDialogDeleteConfirm()
    {
        if (!$this->isCanDelete || $this->targetDeleteId == null) {
            return;
        }
        
        ProductRepository::delete(Crypt::decrypt($this->targetDeleteId));
        Alert::success($this, 'Berhasil', 'Data berhasil dihapus');
    }

    #[On('on-delete-dialog-cancel')]
    public function onDialogDeleteCancel()
    {
        $this->targetDeleteId = null;
    }

    public function showDeleteDialog($id)
    {
        $this->targetDeleteId = $id;

        Alert::confirmation(
            $this,
            Alert::ICON_QUESTION,
            "Hapus Data",
            "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
            "on-delete-dialog-confirm",
            "on-delete-dialog-cancel",
            "Hapus",
            "Batal",
        );
    }

    public function getColumns(): array
    {
        return [
            [
                'name' => 'Aksi',
                'sortable' => false,
                'searchable' => false,
                'render' => function ($item) {

                    $editHtml = "";
                    $id = Crypt::encrypt($item->id);
                    if ($this->isCanUpdate) {
                        $editUrl = route('product.edit', $id);
                        $editHtml = "<div class='col-auto mb-2'>
                            <a class='btn btn-primary btn-sm' href='$editUrl'>
                                <i class='ki-duotone ki-notepad-edit fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                </i>
                                Ubah
                            </a>
                        </div>";
                    }

                    $destroyHtml = "";
                    if ($this->isCanDelete) {
                        $destroyHtml = "<div class='col-auto mb-2'>
                            <button class='btn btn-danger btn-sm m-0' 
                                wire:click=\"showDeleteDialog('$id')\">
                                <i class='ki-duotone ki-trash fs-1'>
                                    <span class='path1'></span>
                                    <span class='path2'></span>
                                    <span class='path3'></span>
                                    <span class='path4'></span>
                                    <span class='path5'></span>
                                </i>
                                Hapus
                            </button>
                        </div>";
                    }
                    

                    $html = "<div class='row'>
                        $editHtml $destroyHtml 
                    </div>";

                    return $html;
                },
            ],
            [
                'key' => 'pid',
                'name' => 'PID Produk',
            ],
            [
                'key' => 'name',
                'name' => 'Nama Produk',
            ],
            [
                'key' => 'brand',
                'name' => 'Merek Produk',
            ],
            [
                'sortable' => false,
                'searchable' => false,
                'name' => 'Kategori Produk',
                'render' => function ($item) {
                    return $item->category->name;
                },
            ],
            [
                'key' => 'type',
                'name' => 'Jenis Produk',
                'render' => function ($item) {
                    return Product::TYPE_CHOICE[$item->type];
                },
            ],
            [
                'key' => 'min_stock',
                'name' => 'Stok Minimal',
                'render' => function ($item) {
                    return number_format($item->min_stock);
                },
            ],
            [
                'key' => 'max_stock',
                'name' => 'Stok Maksimal',
                'render' => function ($item) {
                    return number_format($item->max_stock);
                },
            ],
            [
                'key' => 'is_active',
                'name' => 'Aktif',
                'render' => function($item)
                {
                    return $item->is_active ? "<span class='badge badge-success'>Aktif</span>" : "<span class='badge badge-danger'>Tidak Aktif</span>";
                }
            ],
        ];
    }

    public function getQuery(): Builder
    {
        return ProductRepository::datatable();
    }

    public function getView(): string
    {
        return 'livewire.master-data.product.datatable';
    }
}
