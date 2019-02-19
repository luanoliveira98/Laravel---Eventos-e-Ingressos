<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'name'              => 'Festa na Praia',
            'max_tickets_order' => '13',
            'date'              => '2019-03-10',
            'date_end'          => '2019-03-12',
            'time'              => '20:00:00',
            'time_end'          => '22:00:00',
            'image'             => 'images/s8LhtLlg0HqPizCPZ7iD3IIeBjZ1SBDFA5GdcXfp.jpeg',
            'description'       => 'Festa na praia de Santos, aproveitando a noite ao som do mar.',
            'place_name'        => 'Praia do Gonzaga',
            'place_city'        => 'Santos',
            'place_uf'          => 'SP',
            'user_id'           => '1'
        ]); 
        DB::table('events')->insert([
            'name'              => 'Dia dos Gatos',
            'max_tickets_order' => '5',
            'date'              => '2019-02-17',
            'date_end'          => '2019-02-17',
            'time'              => '12:45:00',
            'time_end'          => '18:00:00',
            'image'             => 'images/yjkg29aRqpXIaMvoVZ0VEGNuCFZccyReY7H0quAa.jpeg',
            'description'       => 'Festa beneficiente para ajudar a ONG dos gatos de rua.',
            'place_name'        => 'Shopping Grande Circular',
            'place_city'        => 'Manaus',
            'place_uf'          => 'AM',
            'user_id'           => '1'
        ]);
        DB::table('events')->insert([
            'name'              => 'Encontro Cosplay',
            'max_tickets_order' => '20',
            'date'              => '2019-03-08',
            'date_end'          => '2019-03-09',
            'time'              => '10:00:00',
            'time_end'          => '20:00:00',
            'image'             => 'images/tPXdhIPM7VVR0fDLzgz8BznXIf1UQCvMOXq2mh7I.jpeg',
            'description'       => 'Encontro cosplay otaku/geek na redenção no fim de semana.',
            'place_name'        => 'Parque da Redenção',
            'place_city'        => 'Porto Alegre',
            'place_uf'          => 'RS',
            'user_id'           => '1'
        ]);
    }
}
