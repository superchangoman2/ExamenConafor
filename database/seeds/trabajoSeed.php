<?php

use Illuminate\Database\Seeder;

class trabajoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nombre'=>'Programador'],
            ['nombre'=>'Diseñador'],
            ['nombre'=>'Contador'],
            ['nombre'=>'Guardía'],
            ['nombre'=>'Brigadista'],
    
            ];
    
            DB::table('trabajos')->insert($data);
    }
}
