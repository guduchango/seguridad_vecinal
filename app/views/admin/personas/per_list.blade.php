@extends ('layouts/admin')
@section ('title') Listado de Alertas - POANES @stop
@section ('content')
    <div class="row ">
        <div class="col-lg-3 pull-right">
            <div class="form-group">
                <div class="input-group custom-search-form ">
                    {{ Form::open(array('url' => 'personas/find/','method' => 'get', 'title' => 'Buscar Usuario')) }}
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
            <span><a class="btn btn-success" href="{{ URL('/personas/create' ) }}" >Crear personas</a></span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Acciones</th>
            </tr>

            @foreach ($personas as $var)
                <tr>
                    <td>{{ $var->per_id }}</td>
                    <td>{{ $var->per_nombre }}</td>
                    <td>{{ $var->per_apellido}}</td>
                    <td>{{ $var->per_dni }}</td>
                    <td>
                        <a class='btn  btn-info glyphicon glyphicon-edit' title='Editar alerta' href="{{ URL::to('/personas/edit', $var->per_id ) }}"></a>
                        {{ Form::open(array('url' => 'personas/destroy/' . $var->per_id,'method' => 'delete', 'class' => 'pull-right', 'title' => 'Eliminar persona')) }}
                        <button class="glyphicon glyphicon-trash btn btn-danger"></button>
                        {{ Form::close() }}

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{ $personas->links() }}
@stop
