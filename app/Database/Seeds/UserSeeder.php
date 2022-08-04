<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i=0; $i <= 100; $i++) { 
            $data = [
                'name' => $faker->name(),
                'address'    => $faker->address(),
                'created_at' => $faker->date(),
                'updated_at' => $faker->date(),
            ];
            $this->db->table('user')->insert($data);
        }


    }
}
