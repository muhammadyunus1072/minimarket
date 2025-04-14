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
        Schema::create('business_partners', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_business_partners', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('business_partners');
        Schema::dropIfExists('_history_business_partners');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
            $table->string('code')->comment('Kode Mitra Bisnis');
        } else {
            $table->string('code')->unique()->comment('Kode Mitra Bisnis');

            $table->index('code', 'business_partners_code_idx');
            $table->index('name', 'business_partners_name_idx');
            
        }

        $table->string('name')->comment('Nama Mitra Bisnis');
        $table->string('price_level_id')->comment('Price Level ID Mitra Bisnis');
        $table->text('address')->nullable()->comment('Alamat Mitra Bisnis');
        $table->string('phone')->nullable()->comment('No Telp Mitra Bisnis');
        $table->boolean('is_customer')->default(false)->comment('Penanda Customer Mitra Bisnis');
        $table->boolean('is_supplier')->default(false)->comment('Penanda Supplier Mitra Bisnis');
        $table->boolean('is_active')->default(true)->comment('Penanda Active Mitra Bisnis');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
