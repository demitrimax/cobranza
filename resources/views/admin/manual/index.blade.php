@extends('layouts.app2')

@section('content')

<div class="error-box">
            <div class="error-body text-center">
                <h2>En Construcción</h1>
                <h3 class="text-uppercase">Este sitio actualmente se encuentra en construcción.</h3>
                <p class="text-muted m-t-30 m-b-30">Te avisaremos cuando esta sección este disponible.</p>
                <a href="{{url('home')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Regresar al Inicio</a> </div>
            <footer class="footer text-center">2017 © Elite Admin.</footer>
        </div>
@endsection
