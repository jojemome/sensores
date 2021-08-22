<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Scripts -->
    <script src="{{ asset('public/js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    <!-- inicio mis librerias -->

    <!-- Google Charts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        html, body {
      height: 100%;
      margin: 0px 0px 0px 0px;
      overflow: hidden;
      padding: 0px 0px 0px 0px;
    }
    
    .chart {
      height: 100%;
    }
    </style>
    
</head>

    <div class="container">
    
    <br>
    
    <h2>Graficación de registros por estación</h2>
    
    <br>
    
        <div class="form-row">
            <label for="idestacion">ID de la estación: </label>
            <div class="col-md-5 mb-3">
                <select id="idestacion" class="custom-select">
                    <option value=" ">Selecciona una estación existente</option>
                </select>       
            </div>
        </div>
    
    <button type="submit" id="buscaidestacion" class="btn btn-primary">Buscar</button>
    
    <br>
    <br>
    
    <div class="chart" id="chart_div"></div>
    <div id="chart_div_error"></div>
    
    </div>
    
    <script type="text/javascript">
    
        $(document).on('ready',function (){
             
            var u1 = '{{ url('/api/estaciones') }}';
            $.ajax({
                url: u1,
                type: 'GET',
                contentType: "application/x-www-form-urlencoded",
                dataType: "json",
                /* Esto es lo que indica que la respuesta será un objeto JSon */
                success: function(data) {       
                $.each(data, function(index, value) {
                    $("#idestacion").append('<option value="' + value.idestacion + '">' + value.nombre + '</option>');
                });  
                } 
            });   
        });
        
        $(document).ready(function() {
        $("#buscaidestacion").click(function() {
            var idestacion = $("#idestacion").val();
            if ($('#idestacion').val().trim() === '') {
              alert('Debe seleccionar una opción');
              }
              else
              { 
                var idest = idestacion;
                var u = '{{ url('/api/registros') }}' + '/' + idest;
        
                    // Load the Visualization API and the corechart package.
                    google.charts.load('current', {
                    'packages': ['corechart']
                    });
        
                    // Set a callback to run when the Google Visualization API is loaded.
                    google.charts.setOnLoadCallback(drawChart);
        
                    function drawChart() {           
                        $.ajax({
                            url: u,
                            type: "GET",
                            ContentType: "application/json; charset=utf-8",
                            success: function (data)
                            {
                                if (data != null && $.isArray(data) && data != 0 ) {
    
                                var arrReg = [['Fecha y hora', 'Temperatura Cº', 'Humedad %']];   
        
                                $.each(data.slice(-5), function (index, value) {
                                    arrReg.push([value.created_at, value.temperatura, value.humedad]);
                                });
        
                                var options = {
                                    title: 'Registros',
                                    curveType: 'function',
                                    chartArea: {
                                    height: '100%',
                                    width: '100%',
                                    top: 60,
                                    left: 60,
                                    right: 60,
                                    bottom: 60
                                    },
                                    hAxis: {
                                    title: 'Fecha y hora'
                                    },
                                    height: '100%',
                                    legend: {
                                    position: 'top'
                                    },
                                    width: '100%'
                                };                    
                                var figures = google.visualization.arrayToDataTable(arrReg)
                                var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                                chart.draw(figures, options); 
                                $("#chart_div_error").empty();
                                }
                                else
                                {
                                    $("#chart_div_error").html(
                                    '<center><p style="color:#FF0000"> No hay datos para mostrar </p></center>'
                                    );
                                    $("#chart_div").empty();
                                    alert('No hay datos que mostrar');
                                }    
                            },
                            error: function (jqxhr, status, exception) {
                                console.log(jqxhr.responseText);
                            }
                        });           
                    }
                }
            });
        });
        </script>