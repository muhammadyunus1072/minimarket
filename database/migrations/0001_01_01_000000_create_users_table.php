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
        Schema::create('users', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_users', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('_history_users');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
            $table->index('email', 'users_email_idx');
            $table->index('username', 'users_username_idx');
        }

        $table->string('name')->comment('Nama Pengguna');
        $table->string('email')->comment('Email Pengguna');
        $table->string('username')->comment('Usernmae Pengguna');
        $table->string('password')->comment('Password Pengguna');
        $table->string('phone')->nullable()->comment('No Telp Pengguna');
        $table->text('address')->nullable()->comment('Alamat Pengguna');
        $table->boolean('is_active')->default(true)->comment('Penanda Aktive Pengguna');
        $table->rememberToken();

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
