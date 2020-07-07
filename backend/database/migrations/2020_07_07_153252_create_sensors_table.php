<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perusahaan_id');
            $table->unsignedBigInteger('site_id');
            $table->string('kode');
            $table->string('nama');
            $table->string('keterangan')->nullable();
            $table->string('satuan');
            $table->decimal('nilai_minimum')->nullable();
            $table->decimal('nilai_maximum')->nullable();
            $table->decimal('nilai_rendah')->nullable();
            $table->decimal('nilai_tinggi')->nullable();
            $table->string('jenis_chart')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('sensors');
    }
}
