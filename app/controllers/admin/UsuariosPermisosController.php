<?php

Class UsuariosPermisosController extends \BaseController {

    public function getList() {
        //Trae el listado de los usuarios
        $usuarios_permisos = Usuariopermiso::join('usuarios', 'usu_id', '=', 'up_usu_id')
                    ->join('permisos','per_id','=','up_per_id')->paginate(30);
        $data = [
            'usuarios_permisos' => $usuarios_permisos,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/usuarios_permisos/up_list', $data);
    }

    public function getCreate() {
        
        $usuarios= Usuario::lists ('usu_nombre', 'usu_id');
        $permisos= Permiso::lists ('per_nombre', 'per_id');
        
        $data = [
            'usuarios' => $usuarios,
            'permisos' => $permisos,
           
        ];
        //Llama a la vista para el formulario crear
        return View::make('admin/usuarios_permisos/up_create', $data);
    }

    public function postStore() {
        
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $usuario_permisos = new Usuariopermiso();
        $usuario_permisos->up_usu_id = Input::get('usu_id');
        $usuario_permisos->up_per_id = Input::get('per_id');
       
      
        
        $usuario_permisos->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','Se ha asignado el permiso al usuario correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios_permisos');
    }

    public function getEdit($id) {
        
        $usuarios= Usuario::lists ('usu_nombre', 'usu_id');
        $permisos= Permiso::lists('per_nombre','per_id');
        //Se busca el id y se lo agrega a un objeto
        $usuario_permisos = Usuariopermiso::find($id);

        $data = [
            'usuario_permisos' => $usuario_permisos,
            'usuarios'=> $usuarios,
            'permisos' => $permisos,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/usuarios_permisos/up_edit', $data);
    }

    public function putUpdate($id) {

     
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $usuario_permisos = Usuariopermiso::find($id);
        $usuario_permisos->up_usu_id = Input::get('usu_id');
        $usuario_permisos->up_per_id = Input::get('per_id');
     
        $usuario_permisos->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'La asignación se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios_permisos');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $usuario_permisos = Usuariopermiso::find($id);
        $usuario_permisos->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','La asignación se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('usuarios_permisos');
    }

}

