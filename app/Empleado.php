<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{

  protected $fillable = [
      'nombre',//alimento_id',
      'idTrabajo',
      'idSupervisor',//usuario
      'estado',
      'idUnidad',
    ];

//Relaciones de la clase empleado
  public function users()
  {
      return $this->belongsTo('App\User','idSupervisor', 'id');
  }
  public function trabajo()//trabajo()
  {
      return $this->belongsTo('App\Trabajo','idTrabajo', 'id');
  }
  public function unidad()
  {
      return $this->belongsTo('App\Unidad','idUnidad', 'id');
  }

}
