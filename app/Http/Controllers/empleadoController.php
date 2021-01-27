<?php

namespace App\Http\Controllers;

use App\empleado;
use App\User;
use App\Trabajo;
use App\Unidad;
use Illuminate\Http\Request;
use Carbon\carbon;
use Session;
use Yajra\Datatables\Datatables;

class empleadoController extends Controller
{

  public function get_datatable(Request $request){
    $request->user()->autorizarUsuario($request->user()->rol);

    if($request->user()->rol == "USUARIO")
      $empleados = empleado::with(['users','trabajo', 'unidad'])->where('estado','ACTIVO')->where('idSupervisor','=', $request->user()->id)->get();
    else
      $empleados = empleado::with(['users', 'trabajo', 'unidad'])->where('estado','ACTIVO')->get();      

    return Datatables::of($empleados)
          ->addColumn('action', function ($empleados) {
              return '<form action="'. route('empleados.destroy', $empleados->id) .'" method="post">
                          <input type="hidden" name="_method" value="delete">
                          <a class="btn-sm btn-info botonInput" href="' . route('empleados.edit', $empleados->id) . '"><i class="fas fa-user-edit"></i></a>
                          <input type="hidden" name="_token" value="'. csrf_token() .'">
                          <button type="submit" class="btn-sm btn-danger mt-3"><i class="fas fa-user-times"></i></button>
                      </form>';
          })
          ->editColumn('id', '{{$id}}')
          ->make(true);
  }

    public function index(Request $request)
    {
        $request->user()->autorizarUsuario($request->user()->rol);
        return view('empleados.index');
    }

    public function create(Request $request)
    {
        $request->user()->autorizarUsuario($request->user()->rol);
        //Consultas para la vista create, información de los trabajos, supervisores y unidades disponibles
        $supervisor = User::where('id', '=', $request->user()->id)->where('estado','ACTIVO')->orderBy('name', 'ASC')->get();
        $trabajo = Trabajo::orderBy('nombre', 'ASC')->get();       
        $unidad = Unidad::orderBy('nombre', 'ASC')->get();
        return view('empleados.create',compact('supervisor','trabajo','unidad'));
    }

    public function store(Request $request)
    {
      $request->validate([
        'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
        'idSupervisor' => 'required',   
        'idTrabajo' => 'required',
        'estado' => 'required',
        'idUnidad' => 'required',
      ]);

      empleado::create($request->all());
      Session::flash('message','Empleado creado correctamente');
      return redirect()->route('empleados.index');
    }

    public function show(empleado $empleado)
    {
        //
    }


    public function edit(empleado $empleado, Request $request)
    {
      $request->user()->autorizarUsuario($request->user()->rol);

      $supervisor = User::where('id', '=', $request->user()->id)->where('estado','ACTIVO')->orderBy('name', 'ASC')->get();
      $trabajo = Trabajo::orderBy('nombre', 'ASC')->get();       
      $unidad = Unidad::orderBy('nombre', 'ASC')->get();

      return view('empleados.edit',compact('empleado','supervisor','trabajo','unidad'));
    }


    public function update(Request $request, empleado $empleado)
    {
        $request->validate([
        'nombre' => 'required|regex:/^[\pL\s\-]+$/u',
        'idSupervisor' => 'required',   
        'idTrabajo' => 'required',
        'estado' => 'required',
        'idUnidad' => 'required',
        ]);
        $empleado->update($request->all());
        Session::flash('message','Empleado actualizado correctamente');

      return redirect()->route('empleados.index');
    }


    public function destroy(empleado $empleado)
    {
      $empleado->estado = 'INACTIVO';

      $empleado->update();
      Session::flash('message','Empleado despedido correctamente');
      return redirect()->route('empleados.index');
    }


}
