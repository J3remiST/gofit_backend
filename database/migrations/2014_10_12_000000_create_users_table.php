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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('role',100);
            $table->string('email')->unique();
            // $table->unsignedBigInteger('instruktur_id');
            // $table->foreign('instruktur_id')->references('id_instruktur')->on('instrukturs');
            // $table->unsignedBigInteger('member_id');
            // $table->foreign('member_id')->references('id_member')->on('members');
            // $table->unsignedBigInteger('pegawai_id');
            // $table->foreign('pegawai_id')->references('id_pegawai')->on('pegawais');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
};
