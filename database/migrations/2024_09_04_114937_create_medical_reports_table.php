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
        Schema::create('medical_reports', function (Blueprint $table) {
            $table->id('medical_report_id');
            $table->string('judul');
            $table->foreignId('patient_id')->constrained('patients', 'patient_id')->onDelete('cascade');
            $table->string('dokter');
            $table->string('faskes');
            $table->string('service');
            $table->date('date')->default(now());
            $table->string('status');
            $table->string('diagnosis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_reports');
    }
};
