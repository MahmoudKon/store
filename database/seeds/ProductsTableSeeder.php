<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['pro one', 'pro two', 'pro three', 'pro four', 'pro five', 'pro six'];
        $disc = [10, 20, null, 50, 5, null];

        foreach ($products as $index => $product) {

            \App\Product::create([
                'category_id'    => $index + 1,
                'ar'             => ['name'  => $product, 'description' => $product . ' desc'],
                'en'             => ['name'  => $product, 'description' => $product . ' desc'],
                'purchase_price' => rand(100,5000),
                'sale_price'     => rand(5000,10000),
                'stock'          => rand(5,100),
                'discount'       => $disc[$index],
                'start_discount' => date('m/d/Y'),
                'end_discount'   => date('9/30/2019'),
            ]);

        }//end of foreach

    }//end of run

}//end of seeder
