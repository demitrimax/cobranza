@extends('layouts.app2')

@section('title',config('app.name').' | Alta de Roles' )

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Hay algunos problemas con su entrada.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="panel panel-primary">
            <div class="panel-heading with-border">
              <h3 class="panel-title">Alta de nuevo Rol</h3>

            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <div class="panel-body">

                  <a class="btn btn-primary" href="{{ route('roles.index') }}"> Regresar</a>

            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            {!! Form::close() !!}
              <!-- /.box-body -->

              <div class="box-footer">

              </div>

          </div>
          <!-- /.box -->

        </div>

      </div>
    </div>
      <!-- /.row -->
    </section>

@endsection
