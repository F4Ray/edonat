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
        Schema::create('distribution', function (Blueprint $table) {
            $table->id();
            $table->string('id_program_donasi');
            $table->string('id_penerima');
            $table->string('nominal');
            $table->string('waktu');
            $table->string('dilakukan_oleh');
            $table->timestamps();
        });
        Schema::table('program_donasi', function ($table) {
            $table->tinyInteger('is_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distribution');
        Schema::table('program_donasi', function ($table) {
            $table->dropColumn('is_active');
        });
    }
};