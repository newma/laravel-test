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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('organisation');
            $table->string('property_type');
            $table->unsignedBigInteger('parent_property_id')->nullable();
            $table->string('uprn');
            $table->string('address');
            $table->string('town')->nullable();
            $table->string('postcode');
            $table->boolean('live')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_property_id')
                ->references('id')->on('properties')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
