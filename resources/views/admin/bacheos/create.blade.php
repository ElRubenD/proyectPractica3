@extends('adminlte::page')

@section('title', 'Bacheo')

@section('css')
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
<style>
  #mapid { min-height: 300px; }
</style>
@stop

@section('content_header')
    <h1>Agregar Obra</h1>
@stop

@section('content')
@section('plugins.Select2', true)
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.bacheos.store']) !!}
                {!! Form::hidden('user_id',auth()->user()->id ,) !!}

                <div class="form-group">
                    <label for="calles">Calle</label>
                    <select class="form-control " name="calle_id" id="calle_id" >
                        <option value="">Seleccione</option>
                        @if ($calles)
                             @foreach ($calles as $calle)
                                <option value="{{$calle->id}}">{{$calle->barrios->name.'  '.$calle->name}}</option>
                             @endforeach
                        @endif
                       
                    </select>
                </div>
                
                <div class="form-group"> 
                    {!! Form::label('longitude', 'Longitud') !!}
                    {!! Form::text('longitude',null, ['class'=>'form-control longitude','placeholder'=>'Ingrese la longitude']) !!}
                    @error('longitude')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group"> 
                    {!! Form::label('latitude', 'Latitude') !!}
                    {!! Form::text('latitude',null, ['class'=>'form-control latitude','placeholder'=>'Ingrese la latitude']) !!}
                    @error('latitude')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group"> 
                    {!! Form::label('latitude', 'barrio') !!}
                    {!! Form::text('barrio',null, ['class'=>'form-control barrio','placeholder'=>'Ingrese la latitude']) !!}
                    @error('longitude')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div>
                <div class="container" id="mapid"></div>

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


                {!! Form::submit('Crear Obra', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop


@section('js')

<script src="{{asset('js/app.js')}}"></script>

      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>
      <script src="{{asset('vendor/geoserver-gis/geoserver-GetFeature-Barrios.js')}}"></script>

@if (session('mensaje')=='ok')
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'La Obra ha sido Creada',
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
 <script>
    var mapCenter = [
            {{ config('leafletsetup.map_center_latitude') }},
            {{ config('leafletsetup.map_center_longitude') }},
    ];
    var map = L.map('mapid').setView(mapCenter,{{ config('leafletsetup.zoom_level') }});
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> S.R.S.O'
    }).addTo(map);
    var marker = L.marker(mapCenter).addTo(map);
    
    function onEachFeature(feature,layer) {
        // layer.bindPopup(feature.properties.nombre_barrio)
}
    var geojsonLayer =L.geoJSON(Barrios, {
        onEachFeature: onEachFeature
});

map.addLayer(geojsonLayer);



function updateMarker(lat,lng){
        marker.setLatLng([lat,lng])
        .bindPopup("Tu Ubicacion :" + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click',function(e) {
        let latitude  = e.latlng.lat.toString().substring(0,15);
        let longitude = e.latlng.lng.toString().substring(0,15);
      

        $('.latitude').val(latitude);
        $('.longitude').val(longitude);

        updateMarker(latitude,longitude);
    });

    // var updateMarkerByInputs = function () {
    //     return updateMarker( $('.latitude').val(), $('.longitude').val());
    // }
    // $('.latitude').on('input',updateMarkerByInputs);
    // $('.longitude').on('input',updateMarkerByInputs);
//     function buscarLocalizacion(e) {
//         var radius = e.accuracy;

// L.marker(e.latlng).addTo(map)
//     .bindPopup("You are within " + radius + " meters from this point").openPopup();

// L.circle(e.latlng, radius).addTo(map);
   
// }

// function errorLocalizacion(e) {
//    alert("No es posible encontrar su ubicación. Es posible que tenga que activar la geolocalización.");
// }

// map.on('locationerror', errorLocalizacion);
// map.on('locationfound', buscarLocalizacion);
// map.locate({setView: true, maxZoom:20,watch: true}).on('locationfound', function(e){
//     let latitude = e.latlng.lat.toString().substring(0, 15);
//         let longitude = e.latlng.lng.toString().substring(0, 15);
//         $('#latitude').val(latitude);
//         $('#longitude').val(longitude);

//         updateMarker(latitude, longitude);
//     });
    
</script>
@stop