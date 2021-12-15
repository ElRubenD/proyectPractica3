<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map</title>
</head>
<body>
    <div class="card">
        <div class="card-body" id="mapid"></div>
    </div>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    
    <style>
        #mapid { min-height: 570px; }
    </style>
    
    
   
    <script src="{{asset('js/app.js')}}"></script>
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script src="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.js"></script>
    <script src="{{asset('vendor/geoserver-gis/geoserver-GetFeature-Barrios.js')}}"></script>
    <script>
        var mapCenter = [
                {{ config('leafletsetup.map_center_latitude') }},
                {{ config('leafletsetup.map_center_longitude') }},
        ];
        var map = L.map('mapid').setView(mapCenter,{{ config('leafletsetup.zoom_level') }});
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    
        var markers = L.markerClusterGroup();

        axios.get('{{ route('api.places.index') }}')
        .then(function (response) {
        //console.log(response.data);
       var markery = L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
            return ('<div class="my-2"><strong>Barrio</strong> :<br>'+layer.feature.properties.Barrio+'</div> <div class="my-2"><strong>Calle</strong> :<br>'+layer.feature.properties.Calle+'</div><div class="my-2"><strong>Numeracion</strong> :<br>'+layer.feature.properties.Numeracion+'</div><div class="my-2"><strong>Largo</strong> :<br>'+layer.feature.properties.Largo+'</div><div class="my-2"><strong>Ancho</strong> :<br>'+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Mts</strong> :<br>'+layer.feature.properties.Mts+'</div><div class="my-2"><strong>Estado</strong> :<br>'+'<div class="btn btn-'+layer.feature.properties.color+' btn-sm">'+layer.feature.properties.Estado+'</div>'+'</div><div class="my-2"><strong>Tiempo</strong> :<br>'+layer.feature.properties.Tiempo+'</div><div class="my-2"><strong>Fecha_Creacion</strong> :<br>'+layer.feature.properties.Fecha_Creacion+'</div><div class="my-2"><strong>Fecha_Modificacion</strong>:<br>'+layer.feature.properties.Fecha_Modificacion+'</div>');
        }).addTo(map);
    
    })
    .catch(function (error) {
        console.log(error);
    });
    map.addLayer(markers);
    
    // var owsrootUrl = 'https://gisdesa.ciudaddecorrientes.gov.ar:8282/geoserver/wfs_idemcc/wfs?';
	// 	var defaultParameters = {
	// 		service: 'WFS',
	// 		version: '1.1.0',
	// 	    request: 'GetFeature',
	// 		typeName: 'wfs_idemcc:vw_barrios_de_la_ciudad',
    //         format_options : 'getJson',
    //         SrsName : 'EPSG:4326',
    //         MaxFeatures: 200
	// 	};
	// 	var parameters = L.Util.extend(defaultParameters);
 
	// 	var URL = owsrootUrl + L.Util.getParamString(parameters);
		
	// 	var myStyle = {
	// 	    "color": "#ff7800",
	// 	    "weight": 5,
	// 	    "opacity": 0.65
	// 	};
			
	// 	$.ajax({
	// 		url: URL,
	// 		success: function (data) {
	// 			var geoJsonLayer = L.geoJSON(data,{
	// 	 		style: myStyle,
	// 			onEachFeature: function(feature, layer) {
	// 			layer.bindPopup ("<ul><h3>" +feature.properties.STATE_NAME+" </h3><li>Población: " +feature.properties.PERSONS+" Hab</li><li>Superficie: "+feature.properties.LAND_KM+" km2</li></ul>");
	// 				}
	// 			}).addTo(map);
	// 		}
	// 	});
    function onEachFeature(feature, layer) {
    // does this feature have a property named popupContent?
    if (feature.properties && feature.properties.nombre_barrio) {
        layer.bindPopup(feature.properties.nombre_barrio);
    }
}
    L.geoJSON(Barrios, {
        onEachFeature: onEachFeature
}).addTo(map);

    </script>
    
    
</body>
</html>
