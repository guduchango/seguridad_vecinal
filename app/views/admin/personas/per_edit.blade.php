@extends ('layouts/admin')
@section ('title') Edit Persona - Seguridad Vecinal  @stop
@section ('content')
    <div class="col-md-12">
        {{ Form::model($persona,array('url' => 'personas/store', 'method' => 'POST', 'class' => 'form-horizontal'))   }}
        <fieldset>
            <legend>Crear Presona</legend>

            <!--Nombre del estudio-->
            <div class="form-group">
                <label class="col-sm-2 control-label" for="">Nombre: </label>
                <div class="col-sm-10 ">
                    {{ Form::text('per_nombre', Input::old('per_nombre'), array('class' => 'form-control', 'placeholder'=>'', 'id' =>'per_nombre')) }}
                    @if($errors->has('per_nombre'))
                        <p class="text-danger">{{ $errors->first('per_nombre') }}</p>
                    @endif
                </div>
            </div>

            <!--username-->
            <div class="form-group">
                <label class="col-sm-2 control-label" for="">Apellido: </label>
                <div class="col-sm-10 ">
                    {{ Form::text('per_apellido', Input::old('per_apellido'), array('class' => 'form-control', 'placeholder'=>'', 'id' =>'per_apellido')) }}
                    @if($errors->has('per_apellido'))
                        <p class="text-danger">{{ $errors->first('per_apellido') }}</p>
                    @endif
                </div>
            </div>

            <!--username-->
            <div class="form-group">
                <label class="col-sm-2 control-label" for="">DNI: </label>
                <div class="col-sm-10 ">
                    {{ Form::text('per_dni', Input::old('per_dni'), array('class' => 'form-control', 'placeholder'=>'', 'id' =>'per_dni')) }}
                    @if($errors->has('per_dni'))
                        <p class="text-danger">{{ $errors->first('per_dni') }}</p>
                    @endif
                </div>
            </div>
    </div>

    <!--botones-->

    <div class="col-sm-offset-2 col-sm-10">
        <div class="pull-right">
            <div class="form-group">
                <a class="btn btn-danger" href="{{ URL::to('personas')}}">Cancelar</a>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
    </fieldset>
    {{Form::close() }}
    </div>
@stop
