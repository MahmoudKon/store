<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('123'),
        ]);

        $user->attachRole('super_admin');


        $first_name = ['Mostafa', 'Magdi', 'Maged', 'Mahmoud', 'Ahmed', 'Emad'];
        $last_name = 'Mohammed';

        foreach ($first_name as $name) {

            $user = \App\User::create([
                'first_name' => $name,
                'last_name' => $last_name,
                'email' => $name . '_' . $last_name . '@yahoo.com',
                'password' => bcrypt('123'),
            ]);

            $user->attachRole('admin');

        }//end of foreach


    }//end of run

}//end of seeder
