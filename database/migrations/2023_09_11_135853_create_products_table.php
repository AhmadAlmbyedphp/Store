<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
        $table->foreignId('category_id')->nullable()->constrained('categories')->nullonDelete();
        $table->string('name');
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->float('price')->default(0);
        $table->float('compare_price')->nullable();
        $table->unsignedBigInteger('quantity')->default(100);
        $table->json('options')->nullable();
        $table->float('rating')->default(0);
        $table->boolean('featured')->default(0);
        $table->enum('status', ['active', 'draft', 'archvied'])->default('active');
        $table->timestamps();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
