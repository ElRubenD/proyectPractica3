@extends('adminlte::page')

@section('title', 'Roles')
@section('css')
<link rel="icon" type="image/png" href="{{ asset('logo-municipalidad.png') }}">
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@stop

@section('content_header')
@can('admin.roles.create')
<a class="btn btn-secondary float-right " href="{{route('admin.roles.create')}}">Nuevo Rol</a>
@endcan

    <h1>Lista de Roles</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                    <tr>
                        <td>{{$rol->id}}</td>
                        <td>{{$rol->name}}</td>
                        <td width="10px">
                            @can('admin.roles.edit')
                            <a href="{{route('admin.roles.edit',$rol)}}" class=" btn btn-primary btn-sm">Editar</a>
                            @endcan
                        </td>
                        <td width="10px">@can('admin.roles.destroy')
                            <form action="{{route('admin.roles.destroy',$rol)}}" method="post" class="formulario-eliminar">
                                @csrf
                                @method('delete')
                                <button type="submit" class=" btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @endcan
                            
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('js')

<script src="{{asset('js/app.js')}}"></script>

@if (session('mensaje')=='ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El Barrio ha sido eliminado.',
            'success'
            )
    </script>
@endif

<script>


    $(document).ready( function () {
$('#myTable').DataTable();



$('.formulario-eliminar').submit(function(e){
      e.preventDefault();
      Swal.fire({
title: 'Estas seguro?',
text: "¡No podrás revertir esto!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: '¡Sí, bórralo!',
}).then((result) => {
if (result.isConfirmed) {
this.submit();
}
})
});

});

</script>
@stop