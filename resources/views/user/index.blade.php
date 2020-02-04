@extends('layouts.app2')

@section('title',config('app.name').' | Administración de Usuarios' )

@section('content')

<section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                          <h3 class="panel-title">Administración de Usuarios</h3>

                      </div>
                    <div class="panel-body">

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
              <p>{{ $message }}</p>
            </div>
            @endif
            <!-- /.box-header -->

                <a class="btn btn-success" href="{{ route('user.create') }}"> Alta de Nuevo Usuario</a>


              <div class="table-responsive">
                <table class="table table-bordered">
                 <tr>
                   <th>No</th>
                   <th>Nombre</th>
                   <th>Email</th>
                   <th>Estado</th>
                   <th>Roles</th>
                   <th width="280px">Action</th>
                 </tr>
                 @foreach ($data as $key => $user)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{!! $user->isOnline() == 1 ? '<span class="label label-info">Online</span>' : '<span class="label label-default">Offline</span>' !!}</td>
                    <td>
                      @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                           <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                      @endif
                    </td>
                    <td>
                       <a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Detalles</a>
                       <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Editar</a>
                        {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                  </tr>
                 @endforeach
                </table>



              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                                {!! $data->render() !!}
              </div>

          </div>
          <!-- /.box -->



        </div>
      </div>

      </div>
      <!-- /.row -->



@endsection
