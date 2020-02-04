@extends('layouts.app2')
@section('title',config('app.name').' | Editar Usuario' )
@section('css')
<link href="{{asset('themes/plugins/bower_components/select2/select2.min.css')}}" rel="stylesheet" />
<!-- iCheck for checkboxes and radio inputs -->
 <link rel="stylesheet" href="{{asset('themes/plugins/bower_components/icheck/skins/all.css')}}">
@endsection
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
    <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading with-border">
               <h3 class="panel-title"><i class="fa fa-pencil-square-o"></i> Editar Usuario</h3>

            </div>
            <!-- /.box-header -->
            <div class="panel-body">
              <div class="pull-right">
                  <a class="btn btn-primary" href="{{ route('user.index') }}"> Regresar</a>
              </div>
              {!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->id]]) !!}

                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Name:</strong>
                          {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Email:</strong>
                          {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Password:</strong>
                          {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Confirm Password:</strong>
                          {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group">
                          <strong>Role:</strong>
                          {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control select2','multiple')) !!}
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
              {!! Form::close() !!}

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>

@endsection
@section('scripts')
<script src="{{asset('themes/plugins/bower_components/select2/select2.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('themes/plugins/bower_components/iCheck/icheck.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
