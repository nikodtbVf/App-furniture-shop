<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
        	'interests' => 2.8,
        	'initialpay'=> 20,
        	'numbers_months'=>12,
        ]);
    }
}
