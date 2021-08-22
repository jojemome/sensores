@extends('layouts.app')

@section('content')
<div class="container">

        <br>

        <h2>Estaciones existentes</h2>

        <div id="datos">

            <br>
            <br>

            <div class="table-responsive" id="tablaconsulta">

<script>
    $(document).on('ready',function (){

    var u = '{{ url('/api/estaciones') }}';
    $.ajax({
        //url: "ajax.php", /* Llamamos a tu archivo */
        //data: "parametro=si&", /* Ponemos los parametros de ser necesarios */
        //type: "POST",
        url: u,
        type: 'GET',
        contentType: "application/x-www-form-urlencoded",
        dataType: "json",
        /* Esto es lo que indica que la respuesta será un objeto JSon */
        success: function(data) {
          /* Vemos que la respuesta no este vacía y sea una arreglo */
          if (data != null && $.isArray(data) && data != 0 ) {
            /* Supongamos que #tblbd es el tbody de tu tabla */
            /* Inicializamos tu tabla */
            $("#tablaconsulta").html(
            '<table id="ejemplo" class="table table-striped table-bordered" style="width:100%">'+
            '        <thead>'+
            '            <tr>'+
            '                <th>ID</th>'+  
            '                <th>Nombre</th>'+
            '                <th>Municipio</th>'+
            '                <th>Oficina</th>'+
            '                <th>Latitud</th>'+
            '                <th>Longitud</th>'+
            '                <th>Fecha y Hora</th>'+
            '                <th>Ubicación</th>'+
            '            </tr>'+
            '        </thead>'+
            '        <tbody id="tblbd">'
            );
            /* Recorremos tu respuesta con each */
            $.each(data, function(index, value) {
              /* Vamos agregando a nuestra tabla las filas necesarias */
              $("#tblbd").append(
                "<tr>" +
                "<td>" + value.idestacion + "</td>" +
                "<td>" + value.nombre + "</td>" +
                "<td>" + value.municipio + "</td>" +
                "<td>" + value.oficina + "</td>" +
                "<td>" + value.latitud + "</td>" +
                "<td>" + value.longitud + "</td>" +
                "<td>" + value.created_at + "</td>" +
                "<td>" + '<a href="https://maps.google.com/?q=' + value.latitud + ',' + value.longitud + '" target="_blank">Ver ubicación</a>' + "</td>" +
                "</tr>");
            });
            var idioma=
            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "NingÃºn dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Ãšltimo",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copyTitle": 'Informacion copiada',
                    "copyKeys": 'Use your keyboard or menu to select the copy command',
                    "copySuccess": {
                        "_": '%d filas copiadas al portapapeles',
                        "1": '1 fila copiada al portapapeles'
                    },

                    "pageLength": {
                    "_": "Mostrar %d filas",
                    "-1": "Mostrar Todo"
                    }
                }
            };

            var table = $('#ejemplo').DataTable( {
    
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    "language": idioma,
    "lengthMenu": [[5,10,20, -1],[5,10,50,"Mostrar Todo"]],
    dom: 'Bfrt<"col-md-6 inline"i> <"col-md-6 inline"p>',
    
    
    buttons: {
          dom: {
            container:{
              tag:'div',
              className:'flexcontent'
            },
            buttonLiner: {
              tag: null
            }
          },
          
          
          
          
          buttons: [


                    {
                        extend:    'copyHtml5',
                        text:      '<i class="fa fa-clipboard"></i>Copiar',
                        title:'Estaciones existentes copiada',
                        titleAttr: 'Copiar',
                        className: 'btn btn-app export barras',
                        exportOptions: {
                            //columns: [ 0, 1 ]
                        }
                    },

                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fa fa-file-pdf-o"></i>PDF',
                        title:'Estaciones existentes en pdf',
                        titleAttr: 'PDF',
                        className: 'btn btn-app export pdf',
                        exportOptions: {
                            //columns: [ 0, 1 ]
                        },
                        customize:function(doc) {

                            doc.styles.title = {
                                color: '#4c8aa0',
                                fontSize: '30',
                                alignment: 'center'
                            }
                            doc.styles['td:nth-child(2)'] = { 
                                width: '100px',
                                'max-width': '100px'
                            },
                            doc.styles.tableHeader = {
                                fillColor:'#4c8aa0',
                                color:'white',
                                alignment:'center'
                            },
                            doc.content[1].margin = [ 100, 0, 100, 0 ]

                        }

                    },

                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fa fa-file-excel-o"></i>Excel',
                        title:'Estaciones existentes en excel',
                        titleAttr: 'Excel',
                        className: 'btn btn-app export excel',
                        exportOptions: {
                            //columns: [ 0, 1 ]
                        },
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="fa fa-file-text-o"></i>CSV',
                        title:'Estaciones existentes en CSV',
                        titleAttr: 'CSV',
                        className: 'btn btn-app export csv',
                        exportOptions: {
                            //columns: [ 0, 1 ]
                        }
                    },
                    {
                        extend:    'print',
                        text:      '<i class="fa fa-print"></i>Imprimir',
                        title:'Estaciones existentes en impresion',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-app export imprimir',
                        exportOptions: {
                            //columns: [ 0, 1 ]
                        }
                    },
                    {
                        extend:    'pageLength',
                        titleAttr: 'Registros a mostrar',
                        className: 'selectTable'
                    }
                ]         
        }
    });

          }
          else
          {
            $("#tablaconsulta").html(
              '<center><p style="color:#FF0000"> No hay datos para mostrar </p></center>'
            );
            alert('No hay datos que mostrar');
          }
        }
      });
});
</script>

@endsection