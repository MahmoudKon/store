<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_name = ['Mostafa', 'Magdi', 'Maged', 'Mahmoud', 'Ahmed', 'Emad'];
        $last_name  = ['Mohammed' ,'Ahmed', 'Tamer', 'Hassan', 'Abdollah', 'Mezo'];
        $phone      = ['01112312312', '012546456456', '01345634345', '0146456456456', '01454545645', '0164564534532', '01645646454565'];
        $address    = ['Alex', 'Mansoura', 'Aswan', 'Luxor', 'Banha', 'Cairo',];

        foreach ($first_name as $index => $first) {

            $clients = \App\Client::create([
                'first_name' => $first,
                'last_name' => $last_name[$index],
                'email' => $first . '_' . $last_name[$index] . '@yahoo.com',
                'phone' => $phone[$index],
                'address' => $address[$index],
                'password' => bcrypt('123'),
            ]);

        }//end of foreach

    }//end of run

}//end of seeder
