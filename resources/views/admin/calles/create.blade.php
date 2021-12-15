@extends('adminlte::page')

@section('title', 'Calle')


@section('content_header')
<h1>Agregar Calle</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.calles.store','autocomplete'=>"off"]) !!}
        @section('plugins.Select2', true)
        <div class="form-group">
            {!! Form::label('barrio_id', 'Barrio') !!}
            {!! Form::select('barrio_id',$barrios,null, ['class'=>'form-control calle_id ']) !!}
            @error('barrio_id')
            <small class="malr text-danger">*{{$message}}</small>
        @enderror
        </div>

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'ingrese el nombre']) !!}
                    @error('name')
                    <small class="malr text-danger">*{{$message}}</small>
                @enderror
                </div>
                {!! Form::submit('Crear Calle', ['class'=>'btn btn-primary']) !!}
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
  title: 'La Calle ha sido Creada',
  showConfirmButton: false,
  timer: 2300
})

</script>


@endif
<script>
    $(document).ready( function () {
     $('.calle_id').select2({
       });
       
    });


</script>
@stop