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
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa')->nullable();
            $table->string('kelas')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('orang_tua_tiada')->nullable();
            $table->string('penghasilan')->nullable();
            $table->string('surat_pernyataan')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function ($table) {
            $table->integer('id_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
        Schema::table('users', function ($table) {
            $table->dropColumn('id_pengajuan');
        });
    }
};