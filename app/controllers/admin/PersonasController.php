<?php

Class PersonasController extends \BaseController {

    public function getList() {
        //Trae el listado de los alertas
        $personas = Persona::paginate(2);
        $data = [
            'personas' => $personas,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/personas/per_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/personas/per_create');
    }

    public function postStore() {

        //Esta regla permite que el campo ale_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'per_nombre' => 'required',
            'per_apellido' => 'required',
            'per_dni' => 'numeric',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "ale_nombre"
        $attributes = array(
            'per_nombre' => 'Nombre',
            'per_apellido' => 'Apellido',
            'per_dni' => 'DNI'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('personas/create')
                ->withErrors($validator)->withInput(Input::all());
        }

        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $persona = new Persona();
        $persona->per_nombre = Input::get('per_nombre');
        $persona->per_apellido = Input::get('per_apellido');
        $persona->per_dni = Input::get('per_dni');
        $persona->save();


        return Redirect::to('personas');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $persona = Persona::find($id);

        $data = [
            'persona' => $persona,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/personas/per_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo ale_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'per_nombre' => 'required',
            'per_apellido' => 'required',
            'per_dni' => 'numeric',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "ale_nombre"
        $attributes = array(
            'per_nombre' => 'Nombre',
            'per_apellido' => 'Apellido',
            'per_dni' => 'DNI'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('personas/edit/' . $id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $alerta = Alerta::find($id);
        $alerta->ale_ubicacion = Input::get('ale_ubicacion');
        $alerta->ale_mensaje = Input::get('ale_mensaje');
        $alerta->ale_tipo = Input::get('ale_tipo');
        $alerta->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El alerta se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('alertas');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $persona = Persona::find($id);
        $persona->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'La persona se elimino correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('personas');
    }



}