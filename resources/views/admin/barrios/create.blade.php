
@extends('adminlte::page')

@section('title', 'Barrio')
@section('css')
<link rel="icon" type="image/png" href="{{ asset('logo-municipalidad.png') }}">
@stop
@section('content_header')
    <h1>Crear Barrio</h1>
@stop

@section('content')
@section('plugins.Sweetalert2', true)
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.barrios.store','autocomplete'=>"off"]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'ingrese el nombre']) !!}
                    @error('name')
                    <small class="malr text-danger">*{{$message}}</small>
                @enderror
                </div>
                {!! Form::submit('Crear Barrio', ['class'=>'btn btn-primary formulario-agregar']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('js')
<script src="{{asset('js/app.js')}}"></script>

@if (session('mensaje')=='ok')
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'El barrio ha sido guardado',
  showConfirmButton: false,
  timer: 2300
})

</script>


@endif
@stop