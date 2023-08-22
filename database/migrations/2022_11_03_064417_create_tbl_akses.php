<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_akses', function (Blueprint $table) {
            $table->increments('akses_id');
            $table->string('menu_id')->nullable();
            $table->string('submenu_id')->nullable();
            $table->string('othermenu_id')->nullable();
            $table->string('role_id');
            $table->string('akses_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_akses');
    }
};
