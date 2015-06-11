<?php

class UsuariosController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getlist() {
        //

        $usuarios = Usuario::paginate(5);
        $data = [
            'usuarios' => $usuarios,
        ];

        return View::make('admin/usuarios/usu_list', $data);
    }

    public function getFind() {
        //
        $valor= Input::get('usu_valor');
        $usuarios = Usuario::find_all($valor);
        $data = [

            'usuarios' => $usuarios,
        ];

        return View::make('admin/usuarios/usu_list', $data);
    }    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getcreate() {
        //
        return View::make('admin/usuarios/usu_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function poststore() {
        //
        $rules = array(
            'usu_username' => 'required | unique:usuarios,usu_username',
            'usu_nombre' => 'required | unique:usuarios,usu_username',
            'usu_clave' => 'required',
            'usu_email' => 'unique:usuarios,usu_email|email',
        );

        $attributes = array(
            'usu_username' => 'nombre de usuario',
            'usu_clave' => 'clave',
            'usu_email' => 'correo'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('usuarios/create')
                            ->withErrors($validator)->withInput(Input::all());
        }

        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $usuario = new Usuario();
        $usuario->usu_nombre = Input::get('usu_nombre');
        $usuario->usu_username = Input::get('usu_username');
        $usuario->usu_clave = Input::get('usu_clave');
        $usuario->usu_email = Input::get('usu_email');
        $usuario->usu_rol = Input::get('usu_rol');
      
        
        $usuario->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El usuario se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getedit($id) {
        //
                //Se busca el id y se lo agrega a un objeto
        $usuario = Usuario::find($id);

        $data = [
            'usuario' => $usuario,

        ];
        //Llama a la vista y envia el objeto
        
        
        return View::make('admin/usuarios/usu_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function putUpdate($id) {
        
             $rules = array(
                 
            'usu_username' => 'required | unique:usuarios,usu_username,'.$id.',usu_id',
            'usu_nombre' => 'required',
            'usu_email' => 'email |unique:usuarios,usu_email,'.$id.',usu_id',
        );

        $attributes = array(
            'usu_username' => 'nombre de usuario',
            'usu_email' => 'correo'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('usuarios/create')
                            ->withErrors($validator)->withInput(Input::all());
        }

        
        $usuario = Usuario::find($id);
        $usuario->usu_nombre = Input::get('usu_nombre');
        $usuario->usu_username = Input::get('usu_username');
        $usuario->usu_clave = Input::get('usu_clave');
        $usuario->usu_email = Input::get('usu_email');
        $usuario->usu_rol = Input::get('usu_rol');
        $usuario->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El usuario se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteDestroy($id) {
        //
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
