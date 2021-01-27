<?php

use Illuminate\Database\Seeder;

class usersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $data = [
          ['name' => 'ADMIN',
          'last_name' => 'ADMIN ADMIN',
          'username' => 'ADMIN',
          'email' => 'ADMIN@ADMIN.COM',
          'password' => '$2y$12$kLHtOBcb9K3b7q9BwRZG9ufzF/99JsIzBMPHJbFDhBQalHJA66jci',
          'rol' =>'ADMINISTRADOR',
          'estado' => 'ACTIVO',
          ],

        ];
  
        DB::table('users')->insert($data);
    }
}
