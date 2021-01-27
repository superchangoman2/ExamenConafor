@extends('layouts.layout')
@section('content')
  <?php $fecha = explode(' ',$empleado->fecha_inicio);?>

  <h1 class="mb-5"> Modificar empleado </h1>
  <form class="container" action="{{ route('empleados.update',$empleado->id)}}" method="post">
    @csrf
    @method('PUT')

    @csrf

    <div class="form-group row">
      <div class="col-sm-6">
        <label for="txtTrabajo" class="col-sm-2 col-form-label">Empleado</label>
        <input type="text" class="form-control" id="txtEmpleado" name="nombre" value="{{$empleado->nombre}}" onKeyPress="return soloLetras(event)">
        <p class="inputError">{{ $errors->first('nombre') }}</p>
      </div>
      <div class="col-sm-6">
        <label for="txtTrabajo" class="col-sm-2 col-form-label">Trabajo</label>
        <select id="txtTrabajo" class="form-control" name="idTrabajo" >
          @foreach($trabajo as $t)
             <option value="{{$t->id}}" {{$t->id == $empleado->idTrabajo ? 'selected' : ''}}> {{$t->nombre}} </option>
          @endforeach
        </select>
        <p class="inputError">{{ $errors->first('idTrabajo') }}</p>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6">
        <label for="txtSupervisor" class="col-sm-2 col-form-label">Supervisor</label>
        <select id="txtSupervisor" class="form-control" name="idSupervisor" >
          @foreach($supervisor as $s)
             <option value="{{$s->id}}" {{$s->id == $empleado->idSupervisor ? 'selected' : ''}}> {{$s->name}} </option>
          @endforeach
        </select>
        <p class="inputError">{{ $errors->first('idSupervisor') }}</p>
      </div>
      <div class="col-sm-6">
        <label for="txtEstado" class="col-sm-4 col-form-label">Estado Empleo</label>
        <select id="txtEstado" class="form-control" name="estado" >
             <option value="ACTIVO"> Activo </option>
             <option value="INACTIVO"> Inactivo </option>
        </select>
        <p class="inputError">{{ $errors->first('estado') }}</p>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6">
        <label for="txtUnidad" class="col-sm-4 col-form-label">Sub Unidad</label>
        <select id="txtUnidad" class="form-control" name="idUnidad" >
          @foreach($unidad as $u)
             <option value="{{$u->id}}" {{$u->id == $empleado->idUnidad ? 'selected' : ''}}> {{$u->nombre}} </option>
          @endforeach
        </select>
        <p class="inputError">{{ $errors->first('idUnidad') }}</p>
      </div>
    </div>

    <div class="col-sm-10">
      <button type="submit" class="btn btn-secondary float-right" >Guardar Cambios</button>
    </div>


</form>
@endsection
