<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(usersSeed::class);
         $this->call(trabajoSeed::class);
         $this->call(unidadSeed::class);
         $this->call(empleadoSeed::class);
    }
}
