@extends('adminlte::page')

@section('title', 'Inicio')
@section('css')
<link rel="icon" type="image/png" href="{{ asset('logo-municipalidad.png') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<link rel="stylesheet" href="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.css">
<style>
#mapid { min-height: 500px; }
</style>
@stop

@section('content_header')
    <h1>Inicio</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
              <div class="col-sm">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-black"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                      <span class=" h3 info-box-text">Usuarios</span>
                      <span class="info-box-number">{{$users}}</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
              </div>
              <div class="col-sm">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-green"><i class="fas fa-clipboard-check"></i></span>
                    <div class="info-box-content">
                      <span class=" h3 info-box-text">Obras Habilitadas</span>
                      <span class="info-box-number">{{$obras}}</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
              </div>
              <div class="col-sm">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-purple"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                      <span class="h3 info-box-text">Obras Activas</span>
                      <span class="info-box-number">{{$obras_activas}}</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
              </div>
              <div class="col-sm">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-yellow"><i class="fas fa-ban"></i></span>
                    <div class="info-box-content">
                      <span class=" h3  info-box-text">Obras Paralizadas</span>
                      <span class="info-box-number">{{$obras_Interrumpidas}}</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
              </div>
              <div class="col-sm">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-orange"><i class="fas fa-hard-hat"></i></span>
                    <div class="info-box-content">
                      <span class=" h3  info-box-text">Obras En total</span>
                      <span class="info-box-number">{{$obras_total}}</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
              </div>
              <div class="col-sm">
                <div class="info-box">
                    <!-- Apply any bg-* class to to the icon to color it -->
                    <span class="info-box-icon bg-blue"><i class="fas fa-house-user"></i></span>
                    <div class="info-box-content">
                      <span class=" h3  info-box-text"> Total Barrios </span>
                      <span class="info-box-number">{{$Barrios}}</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
              </div>
            </div>
          </div>      
    </div>
</div>
<div class="card">
  <div class="card-body">
    <div class="container">
      @include('admin.bacheos.map')
    </div>
  </div>
</div>

@stop


@section('js')

@stop