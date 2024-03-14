<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Stmt\Catch_;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // $NewProduct = new Product();
        // $NewProduct->name = $faker->company();
        // $NewProduct->description = $faker->realText(200, 1);
        // $NewProduct->image =  'https://picsum.photos/id/' . rand(1, 100) . '/400';
        // $NewProduct->ean_code = $faker->randomNumber(13, true);
        // $NewProduct->price = $faker->randomFloat(2, 4.99, 999);
        // $NewProduct->featured = false;
        // $NewProduct->save();

        // USES FACTORY TO GENERATE FAKE PRODUCT ISTANCES
        // Product::factory(100)->create([
        //     'name' => $faker->company(),
        //     'description' => $faker->realText(200, 1),
        //     'image' => 'https://picsum.photos/id/' . rand(1, 100) . '/400',
        //     'ean_code' => $faker->randomNumber(13, true),
        //     'price' => $faker->randomFloat(2, 4.99, 999),
        //     'featured' => false,
        // ]);

        $categories = Category::all();

        for ($i = 0; $i < 100; $i++) {
            $product = new Product();
            $product->name = $faker->company();
            $product->description = $faker->realText(200, 1);
            $product->image = 'https://picsum.photos/id/' . rand(1, 100) . '/400';
            $product->ean_code = $faker->randomNumber(true);
            $product->price = $faker->randomFloat(2, 4.99, 999.99);
            $product->featured = false;

            // GETS A RANDOM CATEGORY
            $randomCategory = $categories->random();

            // ASSOCIATES THE CATEGORY TO THE PRODUCT
            $product->category()->associate($randomCategory);

            $product->save();
        }

        // SELECTS 5 RANDOM IDS
        $randomFeaturedProductIds = Product::inRandomOrder()->limit(5)->pluck('id');

        // SET FEATURED TO TRUE FOR THE SELECTED RANDOM IDS
        foreach ($randomFeaturedProductIds as $productId) {
            $product = Product::find($productId);
            $product->featured = true;
            $product->save();
        }
    }
}

// $table->id();
// $table->string('name');
// $table->longText( 'description' )->nullable();
// $table->longText('image')->nullable();
// $table->integer('ean_code');
// $table->float( 'price', 8, 2 );
// $table->boolean('featured');
// $table->timestamps();