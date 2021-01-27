<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class contrasenaController extends Controller
{
  public function index()
  {
      return View('contra');
  }

  public function store(Request $request)
  {
    $valorMinimo = 7;
    $usuario = Auth::user();

    if((strlen($request->txtPasswordActual) <= $valorMinimo) || (strlen($request->txtNuevaPassword) <= $valorMinimo) || (strlen($request->txtConfirmarPassword) <= $valorMinimo)){
      Session::flash('flash_message', '¡Contraseña muy corta, la contraseña necesita tener minimo de '.($valorMinimo+1).' caracteres!');
    }else{
      if (Hash::check($request->txtPasswordActual, $usuario->password)) {

        if($request->txtNuevaPassword == $request->txtConfirmarPassword)
        {
          $usuario = User::findorfail($usuario->id);
          $usuario->password = bcrypt($request->txtNuevaPassword);
          $usuario->save();
          Session::flash('flash_message', '¡Contraseña cambiada correctamente!');
          return redirect()->route('home');
         }
        else {
          Session::flash('flash_message', '¡Contraseña nueva no coincide!');
         }
      }else {
        Session::flash('flash_message', '¡Contraseña incorrecta!');
      }
    }


    return View('contra');

  }
}
