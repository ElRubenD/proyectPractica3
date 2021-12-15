@extends('adminlte::page')

@section('title', 'Usuarios')
@section('css')
<link rel="icon" type="image/png" href="{{ asset('logo-municipalidad.png') }}">
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection

@section('content_header')
@can('admin.users.create')
<a class="btn btn-secondary float-right " href="{{route('admin.users.create')}}">Agregar Usuario</a>
@endcan

    <h1>Lista de Usuarios</h1>
@stop

@section('content')
@if (session('creacion'))
    <div class="alert alert-success"> 
        <strong>{{session('creacion')}}</strong>
    </div>
@endif
@if (session('Delete'))
    <div class="alert alert-success">
        <strong>{{session('Delete')}}</strong>
    </div> 
@endif
    <div class="card">
            
        <div class="card-body">
            <table class="table table-striped" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Horas</th>
                        <th>Fecha De Creación</th>
                        <th>Fecha De Actualizacion</th>
                        <th></th>
                        <th></th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at }}</td>
                            
                    <td >@can('admin.users.edit')
                        <a href="{{route('admin.users.edit',$user)}}" class=" btn btn-primary btn-sm">Editar</a>
                    @endcan
                        </td>
                    <td>@can('admin.users.destroy')
                        <form action="{{route('admin.users.destroy',$user)}}" method="post" class="formulario-eliminar">
                            @csrf
                            @method('delete')
                            <button type="submit" class=" btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    @endcan
                         
                    </td>
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
            'El Usuario ha sido eliminado.',
            'success'
            )
    </script>
@endif

    <script>
         $(document).ready( function () {
    $('#myTable').DataTable()


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