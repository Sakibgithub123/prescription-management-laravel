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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('profile_image')->nullable();
            $table->string('name');
            $table->string('education_informations');
            $table->string('qualification');
            $table->string('specialist');
            $table->string('whenyouseat');
            $table->string('seating_day');
            $table->string('friday_seating_time');
            $table->string('visit_fee');
            $table->string('phone');
            $table->string('birthday');
            $table->string('address');
            $table->string('gender');
            $table->string('role')->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('0')->comment('1 for active,0 for inactive');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
