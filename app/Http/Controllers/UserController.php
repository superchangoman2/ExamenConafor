<?php
namespace App\Http\Controllers;

use App\User;
use App\T_cita;
use Carbon\carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;
use Yajra\Datatables\Datatables;


class UserController extends Controller
{

    public function get_datatable(Request $request){

      $request->user()->autorizarAdmin($request->user()->rol);
      $users = User::select(['id','name','last_name', 'userName', 'email', 'rol'])->where('ESTADO','ACTIVO');

      return Datatables::of($users)
            ->addColumn('action', function ($users) {
                return '<form action="'. route('users.destroy', $users->id) .'" method="post">
                            <input type="hidden" name="_method" value="delete">
                            <a class="btn-sm btn-info botonInput" href="' . route('users.edit', $users->id) . '"><i class="fas fa-user-edit"></i></a>
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <button type="submit" class="btn-sm btn-danger mt-3"><i class="fas fa-user-times"></i></button>
                        </form>';
            })
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }

    public function index(Request $request)
    {
      $request->user()->autorizarAdmin($request->user()->rol);

      $user = User::where('estado','ACTIVO')->orderBy('name')->paginate(10);
      return view('users.index',compact('user'));
    }

    public function index_perfil (Request $request)
    {
        $request->user()->autorizarUsuario($request->user()->rol);
        $user = User::where('id', $request->id);

        return view('perfil.index', compact('user'));
    }

    public function edit_perfil(Request $request)
    {
        $request->user()->autorizarUsuario($request->user()->rol);
        return view('perfil.edit');
    }

    public function update_perfil(Request $request)
    {
      $request->user()->autorizarUsuario($request->user()->rol);
      $data=T_cita::all();

        $user = User::where('email','=',$request->email)->first();

        $request->validate([
          'name' => 'required|regex:/^[\pL\s\-]+$/u',
          'last_name' => 'required|regex:/^[\pL\s\-]+$/u',
          'userName' => 'required',
          'email' => 'required',
        ]);

        $user->update($request->all());
        Session::flash('message','Usuario Modificado Correctamente');
        return redirect()->route('perfil.index');
    }

    public function create(Request $request)
    {
        $request->user()->autorizarAdmin($request->user()->rol);
        return view('users.create');
    }

    public function store(Request $request)
    {
      $apellido = $request->input('last_nameP').' '.$request->input('last_nameM');

      $request->merge(['last_name' => $apellido]);

      $request->validate([
        'name' => 'required|regex:/^[\pL\s\-]+$/u',
        'last_nameP' => 'required|regex:/^[\pL\s\-]+$/u',
        'last_nameM' => 'required|regex:/^[\pL\s\-]+$/u',
        'userName' => 'required|unique:users',
        'email' => 'required|email|unique:users',

      ]);

      $request->merge(['password' => bcrypt($request->input('password')), 'estado' => 'ACTIVO']);

      User::create($request->all());
      Session::flash('message','Usuario Creado Correctamente');
      return redirect()->route('users.index');
    }


    public function edit(User $user, Request $request)
    {
        $request->user()->autorizarAdmin($request->user()->rol);
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
      $apellido = $request->input('last_nameP').' '.$request->input('last_nameM');

      $request->merge(['last_name' => $apellido,]);

      $request->validate([
        'name' => 'required|regex:/^[\pL\s\-]+$/u',
        'last_nameP' => 'required|regex:/^[\pL\s\-]+$/u',
        'last_nameM' => 'required|regex:/^[\pL\s\-]+$/u',
        'userName' => ['required',Rule::unique('users')->ignore($user->id)],
        'email' => ['required',Rule::unique('users')->ignore($user->id)],

      ]);

      if($request->input('password') != null){
        $request->merge(['password' => bcrypt($request->input('password'))]);
      }else{
        $request->merge(['password' => $user->password]);
      }

      $user->update($request->all());
      Session::flash('message','Usuario Creado Correctamente');
      return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
      $user->estado = 'INACTIVO';

      $user->update();
      Session::flash('message','Usuario inactivado correctamente');
      return redirect()->route('users.index');
    }
}
