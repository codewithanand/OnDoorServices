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
        Schema::create('service_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->string('father_name');
            $table->string('company_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('email');
            $table->string('phone_number', 12);
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->integer('experience_year');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_partners');
    }
};
