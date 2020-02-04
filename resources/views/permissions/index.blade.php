{{-- \resources\views\permissions\index.blade.php --}}
@extends('layouts.app')
@section('title',config('app.name').' | Permisos' )

@section('css')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('appzia/plugins/datatables/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
  <div class="row">
      <div class="col-md-12">
          <div class="panel panel-primary">
              <div class="panel-body">
                  <h4 class="m-b-30 m-t-0"><i class="fa fa-key"></i> Permisos Disponibles</h4>
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{ $message }}</p>
                  </div>
                  @endif
                  <div class="pull-right">
                    <a href="{{ route('user.index') }}" class="btn btn-primary pull-right">Usuarios</a>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary pull-right">Roles</a>
                  </div>

                  <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="permisos-table">
                              <thead>
                              <tr>
                                <th>#</th>
                                <th>Permiso</th>
                                <th>Operaciones</th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach ($permissions as $key=>$permission)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                    <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                                    {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}

                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                          </table>
                        </div>
                          <div class="box-footer">
                            <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Agregar Permiso</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{asset('appzia/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('appzia/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script>
  $(function () {
    $('#permisos-table').DataTable({
      "language": {
                "url": "{{asset('appzia/plugins/datatables/Spanish.json')}}"
            }
    })
  })
</script>
@endsection
