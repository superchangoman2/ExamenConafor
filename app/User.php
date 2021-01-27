<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

  use Notifiable;

  protected $fillable = [
    'name',
    'last_name',
    'userName',
    'email',
    'password',
    'rol',
    'estado',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


      public function autorizarAdmin($rol){

        if($this->rol == 'ADMINISTRADOR'){
          return true;
        }
        abort(401, 'Esta accion no esta disponible');
      }
      public function autorizarUsuario($rol){

        if($this->rol == 'ADMINISTRADOR' || $this->rol == 'USUARIO'){
          return true;
        }
        abort(401, 'Esta accion no esta disponible');
      }




}
