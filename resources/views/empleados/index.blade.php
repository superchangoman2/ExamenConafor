@extends('layouts.layout')

@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
<h1 class="text-Left"> Registro de Empleado </h1>
@if (Session::has('message'))

<div class="alert alert-info">{{Session::get('message')}}</div>
@endif

<a class="btn btn-secondary" href="{{ route('empleados.create') }}">Agregar Empleado</a>
<div class="mt-5">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Empleado</th>
                <th scope="col">Trabajo</th>
                <th scope="col">Supervisor</th>
                <th scope="col">Unidad</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
    </table>
</div>

@endsection

@section('script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript">

$('#myTable').DataTable({
      processing: true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
      serverSide: true,
      ajax: '{{ route('get_datatableempleado') }}',
      columns: [
            {data: 'id'},
            {data: 'nombre'},
            {data : 'trabajo.nombre'},
            {data : 'users.name'},
            {data : 'unidad.nombre'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });
</script>

@endsection
