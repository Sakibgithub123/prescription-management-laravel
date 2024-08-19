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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dr_id');
            $table->string('patient_name');
            $table->string('patient_gender');
            $table->string('patient_age');
            $table->string('visit_fee')->nullable();
            $table->string('reg_no')->nullable();
            $table->date('date')->nullable();
            $table->string('complaints')->nullable();
            $table->string('tests')->nullable();
            $table->string('investigations')->nullable();
            $table->string('diagnoses')->nullable();
            $table->string('medicine')->nullable();
            $table->string('howmanytimes')->nullable();
            $table->string('afterbefore')->nullable();
            $table->string('nextdate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
