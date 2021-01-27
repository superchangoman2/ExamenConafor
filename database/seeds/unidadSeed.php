<?php

use Illuminate\Database\Seeder;

class unidadSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nombre'=>'Sub Unidad1'],
            ['nombre'=>'Sub Unidad2'],
            ['nombre'=>'Sub Unidad3'],
            ['nombre'=>'Sub Unidad4'],
            ['nombre'=>'Sub Unidad5'],
            ['nombre'=>'Sub Unidad6'],
    
            ];
    
            DB::table('unidads')->insert($data);
    }
}
