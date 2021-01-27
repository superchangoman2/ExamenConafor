<?php

use Illuminate\Database\Seeder;

class empleadoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nombre'=>'Juan Perez',
                'idTrabajo'=>'1',
                'idSupervisor'=>'1',
                'estado'=>'ACTIVO',
                'idUnidad'=>'1'
            ],
            [
                'nombre'=>'Ramon Corona',
                'idTrabajo'=>'2',
                'idSupervisor'=>'1',
                'estado'=>'ACTIVO',
                'idUnidad'=>'3'
            ],
            [
                'nombre'=>'Miguel Ruiz',
                'idTrabajo'=>'3',
                'idSupervisor'=>'1',
                'estado'=>'ACTIVO',
                'idUnidad'=>'3'
            ],

    
            ];
    
            DB::table('empleados')->insert($data);
    }
}
