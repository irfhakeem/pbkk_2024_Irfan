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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('doctor_id');
            $table->string('sip')->unique();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('jenis_kelamin');
            $table->foreignId('spesialis_id')->constrained('specializations', 'spesialis_id')->onDelete('cascade');
            $table->foreignId('health_center_id')->constrained('health_centers', 'health_center_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
