@extends ('layouts/admin')

@section ('title') Crear Usuario - POANES  @stop

@section ('content')
<div class="col-md-12">
    {{ Form::open(array('url' => 'usuarios/store', 'method' => 'POST', 'class' => 'form-horizontal'))   }}
    <fieldset>
        <legend>Crear usuario</legend>

        <!--Nombre del estudio-->
        <div class="form-group">
            <label class="col-sm-2 control-label" for="">Nombre Completo: </label>
            <div class="col-sm-10 ">
                {{ Form::text('usu_nombre', Input::old('usu_nombre'), array('class' => 'form-control', 'placeholder'=>'Nombre Completo', 'id' =>'usu_nombre')) }}
                @if($errors->has('usu_nombre'))
                <p class="text-danger">{{ $errors->first('usu_nombre') }}</p>
                @endif
            </div>
        </div>

        <!--username-->
        <div class="form-group">
            <label class="col-sm-2 control-label" for="">Nombre de Usuario: </label>
            <div class="col-sm-10 ">
                {{ Form::text('usu_username', Input::old('usu_username'), array('class' => 'form-control', 'placeholder'=>'Nombre de usuario', 'id' =>'usu_username')) }}
                @if($errors->has('usu_username'))
                <p class="text-danger">{{ $errors->first('usu_username') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <!--select rol-->
            <label class="col-sm-2 control-label" for="">Rol: </label>
            <div class="col-sm-10 ">
                {{ Form::select('usu_rol', ['operador' => 'Operador','administrador' => 'Administrador'],Input::old('usu_rol'), array('class' => 'form-control')
) }}
            </div>
        </div>

        <!--contraseña-->
         <div class="form-group">
        <label class="col-sm-2 control-label" for="">Contraseña: </label>
        <div class="col-sm-10 ">
            {{ Form::password('usu_clave', array('class' => 'form-control', 'placeholder'=>'Contraseña', 'id' =>'usu_clave')) }}
            @if($errors->has('usu_clave'))
            <p class="text-danger">{{ $errors->first('usu_clave') }}</p>
            @endif
        </div>
         </div>
        
        <!--email-->
        <div class="form-group">
        <label class="col-sm-2 control-label" for="">Email: </label>
        <div class="col-sm-10 ">
            {{ Form::text('usu_email', Input::old('usu_email'), array('class' => 'form-control', 'placeholder'=>'Email', 'id' =>'usu_email')) }}
            @if($errors->has('usu_email'))
            <p class="text-danger">{{ $errors->first('usu_email') }}</p>
            @endif
        </div></div>


</div>

<!--botones-->

    <div class="col-sm-offset-2 col-sm-10">
        <div class="pull-right">
            <div class="form-group">
            <a class="btn btn-danger" href="{{ URL::to('usuarios')}}">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</div>
</fieldset>
{{Form::close() }}
</div>
@stop
