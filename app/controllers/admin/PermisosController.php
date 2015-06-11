<?php

Class PermisosController extends \BaseController {

    public function getList() {
        //Trae el listado de los permisos
        $permisos = Permiso::paginate(30);
        $data = [
            'permisos' => $permisos,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/permisos/per_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/permisos/per_create');
    }

    public function postStore() {
        //Esta regla permite que el campo rol_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'per_nombre' => 'required | unique:permisos,per_nombre',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "per_nombre"
        $attributes = array(
            'per_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('permisos/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $permiso = new Permiso();
        $permiso->per_nombre = Input::get('per_nombre');
       
      
        
        $permiso->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El permiso se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('permisos');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $permiso = Permiso::find($id);

        $data = [
            'permiso' => $permiso,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/permisos/per_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo per_nombre sea un campo requerido
        $rules = array(
            'per_nombre' => 'required ',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "per_nombre"
        $attributes = array(
            'per_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('permisos/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $permiso = Permiso::find($id);
        $permiso->per_nombre = Input::get('per_nombre');
       
        $permiso->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El permiso se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('permisos');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $permiso = Permiso::find($id);
        $permiso->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El permiso se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('permisos');
    }

}