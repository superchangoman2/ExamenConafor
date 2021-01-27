@extends('layouts.layout')
@section('content')
@if (Session::has('flash_message'))
<div class="alert alert-info">{{Session::get('flash_message')}}</div>
@endif
<h1> Restablecer Contraseña </h1>

<div class="container footer">
    <div class="col-md-8 mt-5  justify-content-between">
        <div class="card">
            <div class="head" align="center" style="background-color:gray;  padding:15px; color:white; font-size:20px;">
                Restablecer Contraseña
            </div>
            <div class="card-body">
                <!-- formulario -->
                <form action="{{ route('contra.store')}}" method="POST">
                    @csrf

                    <div class="field">
                        <input id="txtPasswordActual" type="password" placeholder=" " class="form-control" name="txtPasswordActual" value="{{old('txtPasswordActual')}}" required autofocus>
                        <label for="txtPasswordActual">Contraseña actual </label>

                        <p class="inputError">{{ $errors->first('txtPasswordActual') }}</p>
                    </div>

                    <div class="field">
                        <input id="txtNuevaPassword" type="password" placeholder=" " class="form-control" name="txtNuevaPassword" value="{{old('txtNuevaPassword')}}" required autofocus>
                        <label for="txtNuevaPassword"> Nueva Contraseña </label>
                        <p class="inputError">{{ $errors->first('txtNuevaPassword') }}</p>
                    </div>

                    <div class="field">
                        <input id="txtConfirmarPassword" type="password" placeholder=" " class="form-control" name="txtConfirmarPassword" value="{{old('txtConfirmarPassword')}}" required autofocus>
                        <label for="txtConfirmarPassword"> Confirmar Contraseña</label>
                        <p class="inputError">{{ $errors->first('txtConfirmarPassword') }}</p>
                    </div>

                    <br>
                    <div class="form-group mb-0 float-right">
                        <button type="submit" class="btn-secondary" style="height:50px;width:150px; border-radius: 10px;">
                            <i class="fas fa-save"></i>&nbsp;&nbsp;{{ __('Guardar') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
