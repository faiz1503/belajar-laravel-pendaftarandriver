<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchantsFood extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants_food', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_bisnis');
            $table->string('tipe_bisnis');
            $table->string('alamat');
            $table->string('kota');
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('no_hp');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('suratperusahaan')->nullable();
            $table->string('suratdirektur')->nullable();
            $table->string('suratpenanggungjawab')->nullable();
            $table->string('suratpembayaran')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('merchants_food');
    }
}
