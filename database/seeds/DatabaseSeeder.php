<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);

        $this->call(UsersTableSeeder::class);
        factory(App\Category::class, 10)->create();
        factory(App\Product::class, 30)->create();
        factory(App\Image::class, 40)->create();
        factory(App\Client::class, 20)->create();


        // $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(ProductsTableSeeder::class);
        // $this->call(ClientsTableSeeder::class);

    }//end of run

}//end of seeder
