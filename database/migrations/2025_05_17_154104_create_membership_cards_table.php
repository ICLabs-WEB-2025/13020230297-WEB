<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_cards', function (Blueprint $table) {
            $table->id();  // ID sebagai primary key
            $table->string('name');  // Nama anggota gym
            $table->date('joining_date');  // Tanggal mulai keanggotaan
            $table->date('expiry_date')->nullable();  // Tanggal kadaluarsa keanggotaan, boleh kosong
            $table->string('membership_number')->unique();  // Nomor keanggotaan yang unik
            $table->timestamps();  // Timestamps untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_cards');
    }
}
