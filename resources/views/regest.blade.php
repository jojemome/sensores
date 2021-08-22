@extends('layouts.app')

@section('content')

<style type="text/css">
  .map-responsive {
    overflow: hidden;
    padding-bottom: 50%;
    position: relative;
    height: 0;
  }

  .map-responsive iframe {
    left: 0;
    top: 0;
    height: 50%;
    width: 50%;
    position: absolute;
  }
</style>


<div class="container">

  <br>

  <h2>Registro de estación</h2>

  <div id="datos">

    <br>
    
      <div class="col-md-4 mb-3 form-group">
        <label for="nombre">Nombre de la estación: </label>
        <input type="text" class="form-control" id="nombre">
      </div>
      <div class="col-md-4 mb-3 form-group">
        <label for="nombre">Municipio: </label>
        <select id="municipio" class="custom-select">
          <option value=" ">Selecciona una estación existente</option>
        </select>       
      </div>
      <div class="col-md-4 mb-3 form-group">
        <label for="nombre">Oficina: </label>
        <input type="text" class="form-control" id="oficina">
      </div>
      <div class="col-md-4 mb-3 form-group">
        <label>Seleccione en el mapa con ayuda del marcador, la ubicación geográfica de la estación: </label>
        <center>
        <!--<div class="map-responsive" id="map" style="width: 500px; height: 300px"></div>-->
          <div id="map_canvas" style="width: auto; height: 300px;">
        </center>
        <br>
        <p style="color:tomato;">NOTA: Se agregarán automáticamente la latitud y longitud en los cuadros cuadros de texto correspondientes</p>
      </div>
      <div class="col-md-4 mb-3 form-group">
        <label for="latitud">Latitud: </label>
        <input type="number" class="form-control" id="latitud" name="latitud" disabled>
      </div>
      <div class="col-md-4 mb-3 form-group">
        <label for="longitud">Longitud: </label>
        <input type="number" class="form-control" id="longitud" name="longitud" disabled>
      </div>
      <button type="submit" id="guardarreg" class="btn btn-primary">Guardar información</button>



    <br>
    <br>

  </div>

</div>

<script>
  $(document).ready(function() {
    $("#guardarreg").click(function() {
      var nombre = $("#nombre").val();
      var municipio = $("#municipio").val();
      var oficina = $("#oficina").val();
      var latitud = $("#latitud").val();
      var longitud = $("#longitud").val();
      if ($('#nombre').val().trim() === '' || $('#municipio').val().trim() === '' || $('#oficina').val().trim() === '' ||
          $('#latitud').val().trim() === '' || $('#longitud').val().trim() === ''  ) {
          alert('Debe llenar todo el formulario');
          }
          else
          { 
      $.ajax({
        url: '{{ url('/api/estaciones') }}',
        type: 'POST',
        data: {
          nombre: nombre,
          municipio: municipio,
          oficina: oficina,
          latitud: latitud,
          longitud: longitud
        },
        success: function(data) {
          alert('La estación ha sido registrada exitosamente');
        }
      });
      }
      $("#nombre").val(null);
      $("#municipio").val(null);
      $("#oficina").val(null);
      $("#latitud").val(null);
      $("#longitud").val(null);
    });
  });
 
</script>

<script type="text/javascript">

	$(document).on('ready',function (){
 		
		$.getJSON("{{asset('public/storage/mh.json')}}", function(data) {
			$.each(data, function(key, value) {
				$("#municipio").append('<option name="' + key + '">' + value + '</option>');
			}); // close each()
		}); // close getJSON()

	});

	</script>



<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGGy8Ad4clTMm8349eu_xJ0HQ-b6vHh_U"></script>
    <script type="text/javascript">
        $(document).on('ready',function (){
            // Creating map object
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(20.092757, -98.769646),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // creates a draggable marker to the given coords
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(20.092757, -98.769646),
                draggable: true
            });

            // adds a listener to the marker
            // gets the coords when drag event ends
            // then updates the input with the new coords
            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#latitud").val(evt.latLng.lat().toFixed(6));
                $("#longitud").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });

            // centers the map on markers coords
            map.setCenter(vMarker.position);

            // adds the marker on the map
            vMarker.setMap(map);
        });
    </script>


@endsection