@extends('layouts.app2')

@section('title',config('app.name').' | Editar Rol' )
@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
              <h3 class="panel-title">Editar Rol</h3>
              <div class="pull-right">
                  <a class="btn btn-primary" href="{{ route('roles.index') }}"> Regresar</a>
              </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
            <div class="panel-body">

                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>


                    <div class="form-group">
                        <strong>Permisos:</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div>


                    <button type="submit" class="btn btn-primary">Actualizar</button>

            {!! Form::close() !!}
              <!-- /.box-body -->

              <div class="panel-footer">

              </div>
              </div>
          </div>
          <!-- /.box -->

        </div>

      </div>
      <!-- /.row -->
    </section>


@endsection
