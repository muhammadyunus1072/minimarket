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
        Schema::create('branchs', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_branchs', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('branchs');
        Schema::dropIfExists('_history_branchs');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('code', 'branchs_code_idx');
            $table->index('name', 'branchs_name_idx');
        }

        $table->string('code')->unique()->comment('Kode Branch');
        $table->string('name')->comment('Nama Branch');
        $table->string('company_name')->nullable()->comment('Nama Perusahaan Branch');
        $table->string('phone')->nullable()->comment('No Telp Branch');
        $table->text('address')->nullable()->comment('Alamat Branch');
        $table->string('image')->nullable()->comment('Logo Branch');
        $table->bigInteger('default_customer_id')->nullable()->comment('Pelanggan ID Bawaan Branch');
        $table->string('default_customer_name')->nullable()->comment('Nama Pelanggan Bawaan Branch');
        $table->boolean('is_active')->default(true)->comment('Penanda Aktif Branch');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
