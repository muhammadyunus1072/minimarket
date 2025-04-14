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
        Schema::create('product_units', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_product_units', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_units');
        Schema::dropIfExists('_history_product_units');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        }else{
            $table->index('product_id', 'product_units_product_id_idx');
            $table->index('price_level_id', 'product_units_price_level_id_idx');
            $table->index('barcode', 'product_units_barcode_idx');
            $table->index('is_main', 'product_units_is_main_idx');
            $table->index('name', 'product_units_name_idx');
        }

        $table->unsignedBigInteger('product_id')->comment('Product ID');
        $table->unsignedBigInteger('price_level_id')->default(1)->comment('Product Price Level ID');

        $table->string('barcode')->comment('Product Barcode');
        $table->boolean('is_main')->default(false)->comment('Penanda Satuan Utama');
        $table->string('name')->comment('Satuan');
        $table->decimal('value', 12, 2)->default(1)->comment('Nilai Konversi');
        $table->decimal('retail_price', 12, 2)->comment('Product Harga Jual ke Customer');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
