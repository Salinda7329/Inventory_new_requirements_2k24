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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('item_user')->nullable()->constrained('items');
            $table->string('quantity_user')->nullable();
            $table->string('user_remark')->nullable();
            $table->foreignId('request_by')->nullable()->constrained('users');
            $table->timestamp('requested_timestamp')->default(null);

            $table->boolean('type')->default(1);

            $table->boolean('status')->default(0);

            $table->foreignId('item_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('sm_remark')->nullable();
            $table->foreignId('store_manager')->nullable()->constrained('users');
            $table->timestamp('store_manager_timestamp')->nullable();
            $table->boolean('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
  