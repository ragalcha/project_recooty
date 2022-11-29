<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=10;$i++)
        { 
            
        $faker=Faker::create(); 
        $customer=new Customer;
        $customer->name=$faker->name;
        $customer->email=$faker->email;
        $customer->password=$faker->password;
        $customer->save();
    }
      
    }
}
