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
        Schema::create('prescription_drugs', function (Blueprint $table) {
            $table->id('prescription_drugs_id');
            $table->foreignId('prescription_id')->constrained('prescriptions', 'prescription_id')->onDelete('cascade');
            $table->foreignId('drug_id')->constrained('drugs', 'drug_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_drugs');
    }
};
