<?php

Class ClientesController extends \BaseController {

    public function getList() {
        //Trae el listado de los articulos
        $clientes = Cliente::join('regimenes', 'reg_id', '=', 'cli_reg_id')
                -> join('provincias', 'pro_id', '=', 'cli_pro_id')
                ->join('localidades', 'loc_id', '=', 'cli_loc_id')->paginate(30);
        $data = [
            'clientes' => $clientes,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/clientes/cli_list', $data);
    }

    public function getCreate() {
        
       $regimenes= Regimen::lists ('reg_nombre', 'reg_id');
       $provincias= Provincia::lists('pro_nombre','pro_id');
       $localidades= Localidad::lists('loc_nombre', 'loc_id');
        
         $data = [
            'regimenes' => $regimenes,
            'provincias'=> $provincias,
            'localidades'=>$localidades,
        ];

       
        //Llama a la vista para el formulario crear
        return View::make('admin/clientes/cli_create', $data);
    }

    public function postStore() {
        
        $rules = array(
            'cli_razon_social' => 'required | unique:clientes,cli_razon_social',
            'cli_cuit' => 'required | unique:clientes,cli_cuit',
            'cli_domicilio' => 'required',
            'cli_email' => 'required | email |unique:clientes,cli_email',
            'cli_telefono' => 'required | numeric',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "razonsocial" y no "cli_razon_social"
        $attributes = array(
            'cli_razon_social' => 'razonsocial'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('clientes/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $cliente = new Cliente();
        $cliente->cli_razon_social = Input::get('cli_razon_social');
        $cliente->cli_domicilio = Input::get('cli_domicilio');
        $cliente->cli_cuit = Input::get('cli_cuit');
        $cliente->cli_reg_id = Input::get('reg_id');
        $cliente->cli_telefono = Input::get('cli_telefono');
        $cliente->cli_email = Input::get('cli_email');
        $cliente->cli_loc_id = Input::get('loc_id');
        $cliente->cli_pro_id= Input::get('pro_id');
        
        $cliente->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El usuario se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('clientes');
    }

    public function getEdit($id) {
        
        //Se busca el id y se lo agrega a un objeto
        $cliente = Cliente::find($id);
        $regimenes= Regimen::lists ('reg_nombre', 'reg_id');
        $provincias= Provincia::lists('pro_nombre','pro_id');
        $localidades= Localidad::lists('loc_nombre', 'loc_id');

        $data = [
            'cliente' => $cliente,
            'regimenes'=> $regimenes,
            'provincias'=>$provincias,
            'localidades' =>$localidades,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/clientes/cli_edit', $data);
    }

    public function putUpdate($id) {
        
        /*print_r(Input::get());
        exit();*/
        
        //Esta regla permite que el campo pro_nombre sea un campo requerido
        $rules = array(
            'cli_razon_social' => 'required ',
            'cli_cuit' => 'required',
            'cli_domicilio' => 'required',
            'cli_email' => 'required',
            'cli_telefono' => 'required',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "razonsocial" y no "cli_razon_social"
        $attributes = array(
            'cli_razon_social' => 'razonsocial'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('clientes/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $cliente = Cliente::find($id);
        $cliente->cli_razon_social = Input::get('cli_razon_social');
        $cliente->cli_domicilio = Input::get('cli_domicilio');
        $cliente->cli_cuit = Input::get('cli_cuit');
        $cliente->cli_reg_id = Input::get('reg_id');
        $cliente->cli_telefono = Input::get('cli_telefono');
        $cliente->cli_email = Input::get('cli_email');
        $cliente->cli_loc_id = Input::get('loc_id');
        $cliente->cli_pro_id= Input::get('pro_id');
        
        $cliente->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El cliente se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('clientes');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $cliente = Cliente::find($id);
        $cliente->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El cliente se ha eliminado correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('clientes');
    }

}
