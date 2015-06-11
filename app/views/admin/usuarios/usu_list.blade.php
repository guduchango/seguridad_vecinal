@extends ('layouts/admin')
@section ('title') Listado de Usuarios - POANES @stop
@section ('content') 
<div class="row ">
    <div class="col-lg-3 pull-right">
        <div class="form-group">
        <div class="input-group custom-search-form ">           
            {{ Form::open(array('url' => 'usuarios/find/','method' => 'get', 'title' => 'Buscar Usuario')) }}
            <input type="text" id="usu_valor" name="usu_valor" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            {{ Form::close() }}
        </div><!-- /input-group -->        
        </div>
    </div>
    <div class="col-lg-3 pull-left">
        <span><a class="btn btn-success" href="{{ URL('/usuarios/create' ) }}" >Crear usuarios</a></span>
    </div>
</div>
<div class="table-responsive">
<table class="table table-striped">
    <tr>
        <th>N°</th>
        <th>Nombre</th>
        <th>Nombre de Usuario</th>
        <th>Email</th>
        <th>Rol</th>

        <th>Acciones</th>
    </tr>

    @foreach ($usuarios as $var)
    <tr>
        <td>{{ $var->usu_id }}</td>
        <td>{{ $var->usu_nombre }}</td>
        <td>{{ $var->usu_username}}</td>
        <td>{{ $var->usu_email }}</td>
        <td>{{ $var->usu_rol }}</td>

        <td>
            <a class='btn  btn-info glyphicon glyphicon-edit' title='Editar usuario' href="{{ URL::to('/usuarios/edit', $var->usu_id ) }}"></a>
            {{ Form::open(array('url' => 'usuarios/destroy/' . $var->usu_id,'method' => 'delete', 'class' => 'pull-right', 'title' => 'Eliminar usuario')) }}
            <button class="glyphicon glyphicon-trash btn btn-danger"></button>
            {{ Form::close() }}

        </td>
    </tr>
    @endforeach
</table> 
</div>
{{ $usuarios->links() }} 
@stop
