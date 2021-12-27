<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('sekolah_id');
            $table->integer('universitas_id');
            $table->string('nisn', 50)->unique();
            $table->string('nama');
            $table->string('jenis_kelamin', 20);
            $table->string('jurusan_skl');
            $table->string('jurusan_pt');
            $table->string('tahun_lulus', 10);
            $table->string('tahun_masuk_pt', 10);
            $table->string('telepon')->nullable();
            $table->string('email');
            $table->string('alamat')->nullable();
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
        Schema::dropIfExists('siswas');
    }
}