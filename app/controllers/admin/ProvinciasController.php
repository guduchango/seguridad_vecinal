<?php

Class ProvinciasController extends \BaseController {

    public function getList() {
        //Trae el listado de provincias
        $provincias = Provincia::paginate(30);
        $data = [
            'provincias' => $provincias,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/provincias/pro_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/provincias/pro_create');
    }

    public function postStore() {
        //Esta regla permite que el campo pro_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'pro_nombre' => 'required | unique:provincias,pro_nombre',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'pro_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('provincias/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $provincia = new Provincia();
        $provincia->pro_nombre = Input::get('pro_nombre');
        $provincia->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','La provincia se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('provincias');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $provincia = Provincia::find($id);

        $data = [
            'provincia' => $provincia,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/provincias/pro_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo pro_nombre sea un campo requerido
        $rules = array(
            'pro_nombre' => 'required',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'pro_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('provincias/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $provincia = Provincia::find($id);
        $provincia->pro_nombre = Input::get('pro_nombre');
        $provincia->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'La provincia se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('provincias');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $provincia = Provincia::find($id);
        $provincia->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','La provincia se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('provincias');
    }

}
