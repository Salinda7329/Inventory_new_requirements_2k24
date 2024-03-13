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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('po_no')->nullable()->default(null);

            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('item_name')->nullable();
            $table->boolean('condition')->default(1);
            $table->foreignId('condition_updated_by')->constrained('users')->nullable()->default(null);
            $table->timestamp('condition_updated_timestamp')->nullable()->default(null);
            $table->string('items_remaining')->nullable()->default(null);
            $table->string('lower_limit')->nullable()->default(null);
            $table->boolean('availability')->default(1);
            $table->foreignId('flag_request')->constrained('users')->nullable()->default(null);
            $table->foreignId('flag_return')->constrained('users')->nullable()->default(null);
            $table->foreignId('owner')->constrained('users')->nullable()->default(null);
            $table->foreignId('created_by')->constrained('users')->nullable()->default(null);
            $table->boolean('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
