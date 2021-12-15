@extends('adminlte::page')

@section('title', 'Barrio')

@section('css')
<link rel="icon" type="image/png" href="{{ asset('logo-municipalidad.png') }}">
@stop

@section('content_header')
<h1>Editar {{$barrio->name}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($barrio,['route'=>['admin.barrios.update',$barrio],'method'=>'put','autocomplete'=>"off"]) !!}
            
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'ingrese el Barrio']) !!}
                    @error('name')
                    <small class="malr text-danger">*{{$message}}</small>
                @enderror
                </div>
                {!! Form::submit('Actualizar Barrio', ['class'=>'btn btn-primary']) !!}
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
  title: 'El barrio ha sido Actualizado',
  showConfirmButton: false,
  timer: 2300
})

</script>
@endif
@stop