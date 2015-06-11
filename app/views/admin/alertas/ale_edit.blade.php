@extends ('layouts/admin')
@section ('title') Modificar Alerta - Seguridad Vecinal  @stop
@section ('content')
<div class="col-md-12">
    {{ Form::model($alerta,array('url' => 'alertas/store', 'method' => 'POST', 'class' => 'form-horizontal'))   }}
    <fieldset>
        <legend>Crear usuario</legend>

        <!--Nombre del estudio-->
        <div class="form-group">
            <label class="col-sm-2 control-label" for="">Ubicacion: </label>
            <div class="col-sm-10 ">
                {{ Form::text('ale_ubicacion', Input::old('ale_ubicacion'), array('class' => 'form-control', 'placeholder'=>'', 'id' =>'ale_ubicacion')) }}
                @if($errors->has('ale_ubicacion'))
                <p class="text-danger">{{ $errors->first('ale_ubicacion') }}</p>
                @endif
            </div>
        </div>

        <!--username-->
        <div class="form-group">
            <label class="col-sm-2 control-label" for="">Mensaje: </label>
            <div class="col-sm-10 ">
                {{ Form::text('ale_mensaje', Input::old('ale_mensaje'), array('class' => 'form-control', 'placeholder'=>'', 'id' =>'ale_mensaje')) }}
                @if($errors->has('ale_username'))
                <p class="text-danger">{{ $errors->first('ale_mensaje') }}</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <!--select rol-->
            <label class="col-sm-2 control-label" for="">Tipo: </label>
            <div class="col-sm-10 ">
                {{ Form::select('ale_tipo', ['tipo_1' => 'tipo_1','tipo_2' => 'tipo_2'],Input::old('ale_tipo'), array('class' => 'form-control')
) }}
            </div>
        </div>
</div>

<!--botones-->

    <div class="col-sm-offset-2 col-sm-10">
        <div class="pull-right">
            <div class="form-group">
            <a class="btn btn-danger" href="{{ URL::to('alertas')}}">Cancelar</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</div>
</fieldset>
{{Form::close() }}
</div>
@stop
