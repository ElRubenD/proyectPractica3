@extends('adminlte::page')

@section('title', 'Bacheo')
@section('css')
 
@stop
@section('content_header')
    <h1>Editar Obra</h1>
@stop

@section('content')
@section('plugins.Select2', true)
<div class="card">
    <div class="card-body">
        {!! Form::model($bacheo,['route'=>['admin.bacheos.update',$bacheo],'method'=>'put','autocomplete'=>"off"]) !!}
            
        {!! Form::hidden('user_id',auth()->user()->id ,) !!}
    
        <div class="form-group">
            <label for="calles">Calle</label>
            <select class="form-control " name="calle_id" id="calle_id" >
                <option value="{{$bacheo->calle->id}}">{{$bacheo->calle->barrios->name}} {{$bacheo->calle->name}}</option>
                @if ($calles)
                     @foreach ($calles as $calle)
                        <option value="{{$calle->id}}">{{$calle->barrios->name.'  '.$calle->name}}</option>
                     @endforeach
                @endif
               
            </select>
        </div>
        <div class="form-group"> 
            {!! Form::label('numeracion', 'Numeracion') !!}
            {!! Form::text('numeracion',null, ['class'=>'form-control','placeholder'=>'Ingrese la numeracion']) !!}
            @error('numeracion')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('largo', 'Largo') !!}
            {!! Form::text('largo',null, ['class'=>'form-control','placeholder'=>'Ingrese el Largo']) !!}
            @error('largo')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('ancho', 'Ancho') !!}
            {!! Form::text('ancho',null, ['class'=>'form-control','placeholder'=>'Ingrese el Ancho']) !!}
            @error('ancho')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('mts', 'Mts') !!}
            {!! Form::text('mts',null, ['class'=>'form-control','placeholder'=>'ingrese los Mts']) !!}
            @error('mts')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
        
        <div class="form-group">
            {!! Form::label('status_id', 'Estado') !!}
            {!! Form::select('status_id',$status,null, ['class'=>'form-control']) !!}
        
            @error('status_id')
            <small class="malr text-danger">*{{$message}}</small>
        @enderror
        </div>


        {!! Form::submit('Actualizar Obra', ['class'=>'btn btn-primary']) !!}
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
  title: 'La Obra ha sido Actualizada',
  showConfirmButton: false,
  timer: 2300
})

</script>
@endif
<script>
    $(document).ready( function () {
     $('#calle_id').select2({
       });
    });
</script>
@stop