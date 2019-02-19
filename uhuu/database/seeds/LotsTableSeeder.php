<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lots')->insert([
            'price' => '20.00',
            'tickets' => '20',
            'event_id' => '1'
        ]);
    }
}
