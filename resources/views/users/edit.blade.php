@extends('layouts.layout')

@section('content')
<?php
    $apellido = explode(' ',$user->last_name);
  ?>

<h1 class="mb-5"> Editar Usuarios </h1>

<form action="{{route('users.update',$user->id)}}" method="post" name="form1">
    @csrf
    @method('PUT')

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="txtNombre">Nombre</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese su nombre" name="name" value="{{$user->name}}" onKeyPress="return soloLetras(event)" onkeyup="mayus(this);">
            <p class="inputError">{{ $errors->first('name') }}</p>
        </div>

        <div class="form-group col-md-4">
            <label for="txtApellidoP">Apellido Paterno</label>
            <input type="text" class="form-control" id="txtApellidoP" placeholder="Ingrese su apellido paterno" name="last_nameP" value="{{$apellido[0]}}" onKeyPress="return soloLetras(event)" onkeyup="mayus(this);">
            <p class="inputError">{{ $errors->first('last_nameP') }}</p>
        </div>

        <div class="form-group col-md-4">
            <label for="txtApellidoM">Apellido Materno</label>
            <input type="text" class="form-control" id="txtApellidoM" placeholder="Ingrese su apellido materno" name="last_nameM" value="{{$apellido[1]}}" onKeyPress="return soloLetras(event)" onkeyup="mayus(this);">
            <p class="inputError">{{ $errors->first('last_nameM') }}</p>
        </div>
    </div>

    <div class="container">
        <div class="form-group row">
            <label for="txtEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="txtEmail" placeholder="Ingrese su email" name="email" value="{{$user->email}}" onkeyup="mayus(this);">
                <p class="inputError">{{ $errors->first('email') }}</p>
            </div>
        </div>
        <div class="form-group row">
            <label for="txtUser_name" class="col-sm-2 col-form-label">Nombre del usuario</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="txtUser_name" placeholder="Ingrese un nombre de usuario" name="userName" value="{{$user->userName}}" onKeyPress="return sinSignos(event)" onkeyup="mayus(this);">
                <p class="inputError">{{ $errors->first('userName') }}</p>
            </div>
        </div>
        <div class="form-group row">
            <label for="txtPassword" class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="txtPassword" placeholder="Contraseña" name="password">
                <p class="inputError" id="errorPassword">{{ $errors->first('password') }}</p>
            </div>

        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Escoja el rol</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rol" id="gridRadios1" value="ADMINISTRADOR" {{ $user->rol == 'ADMINISTRADOR' ? 'checked' : '' }}>
                        <label class="form-check-label" for="gridRadios1">
                            Administrador
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rol" id="gridRadios2" value="USUARIO" {{ $user->rol == 'USUARIO' ? 'checked' : '' }}>
                        <label class="form-check-label" for="gridRadios2">
                            Usuario
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="form-group row">
            <div class="col-sm-10">
                <input type="button" class="btn btn-secondary float-right" value="Conservar cambios" id="btnComprobar">
            </div>
        </div>
    </div>

</form>
<script language="javascript" type="text/javascript">
    document.querySelector("#btnComprobar").addEventListener("click", validar);

    function validar() {
      let valorMinimo = 7;
        if (document.querySelector("#txtPassword").value.length <= 0) {
          document.form1.submit();


        } else if (document.querySelector("#txtPassword").value.length <= valorMinimo) {
            document.querySelector("#errorPassword").innerHTML = "La contraseña debe de contener minimo " + (valorMinimo + 1) + " caracteres ";
        }else {
            document.form1.submit();
        }
    }
</script>

<!-- Script generar domicilio -->
<script type="text/javascript" src="{{ asset('js/validador/validarFormulario.js') }}"></script>
@endsection
