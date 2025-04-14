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
        Schema::create('price_levels', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_price_levels', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('price_levels');
        Schema::dropIfExists('_history_price_levels');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
            $table->string('code')->comment('Level Harga Kode');
        }else{
            $table->string('code')->unique()->comment('Level Harga Kode');
            $table->index('name', 'price_levels_name_idx');
            $table->index('code', 'price_levels_code_idx');
        }

        $table->string('name')->comment('Level Harga Nama');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};
