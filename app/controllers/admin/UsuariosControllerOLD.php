<?php

Class UsuariosController extends \BaseController {

    public function getList() {
        //Trae el listado de los usuarios
        $usuarios = Usuario::join('roles', 'rol_id', '=', 'usu_rol_id')->paginate(30);
        $data = [
            'usuarios' => $usuarios,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/usuarios/usu_list', $data);
    }

    public function getCreate() {
        
        $roles= Rol::lists ('rol_nombre', 'rol_id');
        
        $data = [
            'roles' => $roles,
           
        ];
        //Llama a la vista para el formulario crear
        return View::make('admin/usuarios/usu_create', $data);
    }

    public function postStore() {
        //Esta regla permite que el campo usu_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'usu_nombre' => 'required | unique:usuarios,usu_nombre',
            'usu_apellido' => 'required | unique:usuarios,usu_apellido',
            'usu_username' => 'required | unique:usuarios,usu_username',
            'usu_clave' => 'required | min:6',
            'usu_email' => 'required | email | unique:usuarios,usu_email',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "usu_nombre"
        $attributes = array(
            'usu_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('usuarios/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $usuario = new Usuario();
        $usuario->usu_nombre = Input::get('usu_nombre');
        $usuario->usu_apellido = Input::get('usu_apellido');
        $usuario->usu_username = Input::get('usu_username');
        $usuario->usu_clave = Input::get('usu_clave');
        $usuario->usu_email = Input::get('usu_email');
        $usuario->usu_rol_id = Input::get('rol_id');
      
        
        $usuario->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El usuario se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $usuario = Usuario::find($id);
        $roles= Rol::lists ('rol_nombre', 'rol_id');

        $data = [
            'usuario' => $usuario,
            'roles' => $roles,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/usuarios/usu_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo usu_nombre sea un campo requerido
        $rules = array(
            
            'usu_nombre' => 'required',
            'usu_username' => 'required | unique:usuarios,usu_username,usu_id' . $this->id, 
            'usu_clave' => 'required | min:6',
            'usu_email' => 'required | email | unique:usuarios,usu_email,usu_id'. $this->id, 
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "art_nombre"
        $attributes = array(
            'usu_nombre' => 'nombre'
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
        $usuario = Usuario::find($id);
        $usuario->usu_nombre = Input::get('usu_nombre');
        $usuario->usu_apellido = Input::get('usu_apellido');
        $usuario->usu_username = Input::get('usu_username');
        $usuario->usu_clave = Input::get('usu_clave');
        $usuario->usu_email = Input::get('usu_email');
        $usuario->usu_rol_id = Input::get('rol_id'); 
        $usuario->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El usuario se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $usuario = Usuario::find($id);
        $usuario->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El usuario se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios');
    }

}

