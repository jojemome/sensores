@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
      <!--
          <div class="card">
              <div class="card-header">Dashboard</div>

              <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif

                  You are logged in!
              </div>
          </div>
      -->
      <!-- empieza lo bueno-->
  <br>
  <br>
    
    <!--
    <center>

    <table class="table table-borderless">
      <tbody>
        <tr>
          <td style="width: 50%" align="center">
            <img class="img-fluid" src="{{asset('public/storage/icono_estaciones.PNG')}}" height="100">
            <div class="dropdown">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Estaciones
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('regest') }}">Registar estación nueva</a>
                <a class="dropdown-item" href="{{ route('muestramonitor') }}">Mostrar estaciones existentes</a>
              </div>
            </div>
          </td>
          <td style="width: 50%" align="center">
            <img class="img-fluid" src="{{asset('public/storage/icono_registros.PNG')}}" height="100">
            <div class="dropdown">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Registros
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('mtt') }}">Tabulación de registros por estación</a>
                <a class="dropdown-item" href="{{ route('mgt') }}">Graficación de registros por estación</a>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    </center> -->
<br>

<center>
<h2>Menú principal</h2>
</center>

<br>

  <div class="container-fluid">
  <div class="row">
    <div class="col" align="center">
      <img class="img-fluid" src="{{asset('public/storage/icono_estaciones.PNG')}}" height="100px">
    </div>
    <div class="col" align="center">
      <img class="img-fluid" src="{{asset('public/storage/icono_registros.PNG')}}" height="120px">
    </div>
  </div>
  <div class="row">
    <div class="col" align="center">
      <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Estaciones
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('regest') }}">Registar estación nueva</a>
          <a class="dropdown-item" href="{{ route('muestramonitor') }}">Mostrar estaciones existentes</a>
        </div>
      </div>
    </div>
    <div class="col" align="center">
      <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        Registros
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('mtt') }}">Tabulación de registros por estación</a>
          <a class="dropdown-item" href="{{ route('mgt') }}">Graficación de registros por estación</a>
        </div>
      </div>
    </div>
  </div>
</div>

  

    <br>
    <br>

@endsection

