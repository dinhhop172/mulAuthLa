<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer')->insert([
            'name' => 'keira',
            'email' => 'keiradom296@gmail.com',
            'password' => bcrypt('123123'),
            'address' => 'Hue'
        ]);
    }
}
