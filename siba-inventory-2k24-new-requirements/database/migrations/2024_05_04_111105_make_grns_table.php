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
        Schema::create('grns', function (Blueprint $table) {
            $table->id();
            $table->string("requested_by")->nullable();
            $table->string("good_receiving_note_number")->nullable()->unique();
            $table->string("company")->nullable();
            $table->string("item_to_be_used_location")->nullable();
            $table->string("handed_over_by")->nullable();
            $table->string("handed_over_date")->nullable();
            $table->string("received_by")->nullable();
            $table->string("received_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grns');
    }
};
