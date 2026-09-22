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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('barcode')->nullable()->index();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories')->nullOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->string('model')->nullable();
            $table->text('specs');
            $table->longText('description')->nullable();
            $table->decimal('purchase_price', 12, 2)->default(0);
            $table->decimal('selling_price', 12, 2)->default(0);
            $table->decimal('mrp', 12, 2)->nullable();
            $table->decimal('gst_rate', 5, 2)->default(18.00);
            $table->integer('stock')->default(0);
            $table->integer('min_stock')->default(3);
            $table->string('warranty')->default('1 Year Onsite Warranty');
            $table->string('status')->default('active'); // active, inactive, out_of_stock
            $table->decimal('rating', 3, 2)->default(4.50);
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);

            // PC Builder & Hardware compatibility specs
            $table->string('socket')->nullable();       // e.g. LGA1700, AM5
            $table->string('ram_type')->nullable();     // e.g. DDR4, DDR5
            $table->integer('wattage_req')->nullable(); // e.g. 550
            $table->integer('wattage')->nullable();     // e.g. 650 (for PSU)
            $table->string('pcb_type')->nullable();     // cpu, motherboard, ram, storage, gpu, psu, cabinet, cooler, monitor, peripherals

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
