<?php

Class RolesController extends \BaseController {

    public function getList() {
        //Trae el listado de los roles
        $roles = Rol::paginate(30);
        $data = [
            'roles' => $roles,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/roles/rol_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/roles/rol_create');
    }

    public function postStore() {
        //Esta regla permite que el campo rol_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'rol_nombre' => 'required | unique:roles,rol_nombre',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "rol_nombre"
        $attributes = array(
            'usu_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('roles/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $rol = new Rol();
        $rol->rol_nombre = Input::get('rol_nombre');
       
      
        
        $rol->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El rol se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('roles');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $rol = Rol::find($id);

        $data = [
            'rol' => $rol,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/roles/rol_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo rol_nombre sea un campo requerido
        $rules = array(
            'rol_nombre' => 'required ',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "rol_nombre"
        $attributes = array(
            'rol_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('usuarios/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $rol = Rol::find($id);
        $rol->rol_nombre = Input::get('rol_nombre');
       
        $rol->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El rol se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('roles');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $rol = Rol::find($id);
        $rol->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El rol se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('roles');
    }

}

