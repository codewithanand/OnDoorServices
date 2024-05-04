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
        Schema::create('seekers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('qualification');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->tinyInteger('working');
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->integer('expirience')->nullable();
            $table->string('image');
            $table->string('id_proof');
            $table->string('mobile');
            $table->string('altphone')->nullable();
            $table->integer('state_code');
            $table->integer('district_code');
            $table->integer('city_code');
            $table->integer('village_code');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seekers');
    }
};
