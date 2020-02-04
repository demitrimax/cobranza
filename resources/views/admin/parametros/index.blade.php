@extends('layouts.app2')

@section('content')
  <div class="container-fluid">
    <div class="row bg-title">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">{{{ $config['titulo'] }}}</h4>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
         @include('layouts.breadcrumbs',[ 'breadcrumbs' => $config['breadcrumbs'] ])
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Parámetros del Sistema</h3>
                            <p class="text-muted m-b-30 font-13"> Establezca los parametros del sistema </p>
                            {!! Form::open([url=>'admin/parametros/save'])!!}
                              @foreach($parametros as $parametro)
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-2 col-form-label">{{$parametro->parametro}}</label>
                                    <div class="col-8">
                                        <input class="form-control" type="{!! $parametro->tipo_input !!}"
                                        value="{!!$parametro->valor!!}" id="form[]"
                                        name="form[]">
                                        <input type="hidden" name="idform[]" value="{!! $parametro->id!!}">

                                    </div>
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Guardar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
  </div>
@endsection
