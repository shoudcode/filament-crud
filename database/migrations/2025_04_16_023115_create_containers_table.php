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
        Schema::create('containers', function (Blueprint $table) {
            $table->id();
            $table->string('kapal');
            $table->date('etd');
            $table->date('eta');
            $table->string('shipper');
            $table->string('penerima');
            $table->string('no_container');
            $table->enum('ukuran', ['20', '40']);
            $table->string('lokasi_bongkar');
            $table->date('tgl_muat');
            $table->date('tgl_bongkar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('containers');
    }
};
