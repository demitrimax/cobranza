@extends('layouts.app2')

@section('title',config('app.name').' | Administración de Roles' )

@section('content')

<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="panel panel-primary table-responsive no-padding">
            <div class="panel-heading with-border">
              <h3 class="panel-title">Administrador de Roles</h3>



            </div>
            @can('role-create')
              <a class="btn btn-success pull-right" href="{{ route('roles.create') }}"> Alta de Nuevo Rol</a>
            @endcan
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <table class="table table-bordered table-responsive">
              <tr>
                 <th>No</th>
                 <th>Name</th>
                 <th width="280px">Action</th>
              </tr>
                @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Mostrar</a>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endcan
                    </td>
                </tr>
                @endforeach
            </table>
              <!-- /.box-body -->

              <div class="box-footer">
              {!! $roles->render() !!}
              </div>

          </div>
          <!-- /.box -->



        </div>

      </div>
      <!-- /.row -->

@endsection
