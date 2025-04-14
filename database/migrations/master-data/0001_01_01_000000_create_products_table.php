<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_products', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('_history_products');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        }else{
            $table->index('name', 'products_name_idx');
            $table->index('pid', 'products_pid_idx');
            $table->index('category_id', 'products_category_id_idx');
            $table->index('expired_date', 'products_expired_date_idx');
            $table->index('type', 'products_type_idx');
            $table->index('supplier_id', 'products_supplier_id_idx');
        }
        
        $table->string('pid')->comment('PID Produk');
        $table->string('name')->comment('Name Produk');
        $table->text('description')->nullable()->comment('Deskripsi Produk');
        $table->string('image')->nullable()->comment('Gambar Produk');
        $table->unsignedBigInteger('product_category_id')->comment('Product Category ID Produk');
        $table->date('expired_date')->nullable()->comment('Expired Date Produk');

        $table->string('type')->comment('Jenis Produk'); // Stock / Without St Produkock
        $table->decimal('stock', 12, 2)->default(0)->comment('Stok Produk');
        $table->decimal('min_stock', 12, 2)->default(0)->comment('Variant Min Stock Produk');
        $table->decimal('max_stock', 12, 2)->default(0)->comment('Variant Max Stock Produk');
        $table->decimal('purchase_price', 12, 2)->comment('Harga Beli dari Supplier (HPP) Produk');

        $table->string('brand')->nullable()->comment('Brand Produk');

        $table->unsignedBigInteger('supplier_id')->nullable()->comment('Supplier ID Produk');

        $table->unsignedBigInteger('default_purchase_unit_id')->nullable()->comment('Satuan Default Pembelian Produk');
        $table->unsignedBigInteger('default_retail_unit_id')->nullable()->comment('Satuan Default Penjualan Produk');
        $table->unsignedBigInteger('default_stock_unit_id')->nullable()->comment('Satuan Default Stok Produk');

        $table->boolean('is_active')->default(true)->comment('Penanda Active Produk');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
