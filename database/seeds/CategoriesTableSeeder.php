<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['cat one', 'cat two', 'cat three', 'cat four', 'cat five', 'cat six'];

        foreach ($categories as $category) {

            \App\Category::create([
                'ar' => ['name' => $category],
                'en' => ['name' => $category],
                'es' => ['name' => $category],
            ]);

        }//end of foreach

    }//end of run

}//end of seeder
