@extends('layouts.layout')

@section('style')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
<h1 class="text-Left"> Usuarios </h1>
@if (Session::has('message'))
<div class="alert alert-info">{{Session::get('message')}}</div>
@endif
<a class="btn btn-secondary" href="{{ route('users.create') }}">Agregar Usuarios</a>

<div class="mt-5  tabla-datos">
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th scope="col">Nombre completo</th>
                <th scope="col">Nickname</th>
                <th scope="col">Email</th>
                <th scope="col">Rol</th>
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
      ajax: '{{ route('users.get_datatable') }}',
      columns: [
            {"render":
                  function ( data, type, row ) {
                      return (row.name + ' ' + row.last_name );
                  }
            },
            {data: 'userName'},
            {data: 'email'},
            {data: 'rol'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
      ]
  });

</script>
@endsection
