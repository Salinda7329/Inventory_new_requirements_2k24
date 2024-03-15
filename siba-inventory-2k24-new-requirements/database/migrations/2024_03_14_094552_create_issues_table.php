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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->nullable()->constrained('itemsnew');
            $table->string('count')->nullable();
            $table->foreignId('issued_to')->nullable()->constrained('departments');
            $table->string('issue_remark')->nullable();
            $table->foreignId('issued_by')->nullable()->constrained('users');
            $table->boolean('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
