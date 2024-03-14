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
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
            $table->bigInteger('ean_code');
            $table->float('price', 5, 2);
            $table->boolean('featured');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            // ASSIGNS THE FK TO THE ID COLUMN ON CATEGORIES TABLE
            $table->foreign('category_id')->on('categories')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');

            // if (Schema::hasColumn('products', 'category_id')) {
            //     $table->dropForeign(['category_id']);
            // }

        });

        Schema::dropIfExists('products');
    }
};
