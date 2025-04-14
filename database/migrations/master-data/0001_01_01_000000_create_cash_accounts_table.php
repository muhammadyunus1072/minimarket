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
        Schema::create('cash_accounts', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_cash_accounts', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_accounts');
        Schema::dropIfExists('_history_cash_accounts');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
            $table->string('code')->comment('Kode Akun Kas');
        } else {
            $table->string('code')->unique()->comment('Kode Akun Kas');
            $table->index('code', 'cash_accounts_code_idx');
            $table->index('name', 'cash_accounts_name_idx');
        }

        $table->string('type')->comment('Jenis Akun Kas');
        $table->string('name')->comment('Nama Akun Kas');
        $table->decimal('current_balance', 16, 2)->default(0)->comment('Saldo saat ini');
        $table->string('admin_type')->comment('Jenis Biaya Admin Akun Kas');
        $table->decimal('admin_fee', 12, 2)->default(0)->comment('Biaya Admin Akun Kas');
        $table->boolean('is_active')->default(true)->comment('Penanda Aktive Akun Kas');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
