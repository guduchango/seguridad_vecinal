<?php

Class EmpresasController extends \BaseController {

    public function getList() {
        //Trae el listado de localidades
        $empresas = Empresa::join('localidades', 'loc_id', '=', 'emp_loc_id')
                ->join('regimenes', 'reg_id', '=', 'emp_reg_id')->paginate(30);
        $data = [
            'empresas' => $empresas,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/empresas/emp_list', $data);
    }
    
    public function getCreate() {
      $regimenes = Regimen::lists('reg_nombre','reg_id');
      $localidades = Localidad::lists('loc_nombre','loc_id');
     
      
      $data =[
          'regimenes' => $regimenes,
          'localidades' => $localidades,
      ];
        
        return View::make('admin/empresas/emp_create',$data);
    }

    public function postStore() {
        
        
       
        //Esta regla permite que el campo pro_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            //'emp_id' => 'required',
            'emp_nombre' => 'required',
            'emp_direccion' => 'required',
            'emp_telefono' => 'required | numeric',
            'emp_email' => 'required | email',
            'emp_cuit' => 'required | numeric | unique:empresas,emp_cuit ',
            'reg_id' => 'required ',
            'loc_id' => 'required ',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            //'emp_id' => 'id',
            'emp_nombre' => 'nombre',
            'emp_direccion' => 'direccion',
            'emp_telefono' => 'telefono',
            'emp_email' => 'email',
            'emp_cuit' => 'cuit',
            'emp_reg_id' => 'regimen',
            'emp_loc_id' => 'localidad'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('empresas/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $empresa = new Empresa();
        //$empresa->emp_id = Input::get('emp_id');
        $empresa->emp_nombre = Input::get('emp_nombre');
        $empresa->emp_direccion = Input::get('emp_direccion');
        $empresa->emp_telefono = Input::get('emp_telefono');
        $empresa->emp_email = Input::get('emp_email');
        $empresa->emp_cuit = Input::get('emp_cuit');
        $empresa->emp_reg_id = Input::get('reg_id');
        $empresa->emp_loc_id = Input::get('loc_id');
        
        $empresa->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','La empresa se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('empresas');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $empresa = Empresa::find($id);
        $regimenes = Regimen::lists('reg_nombre','reg_id');
        $localidades = Localidad::lists('loc_nombre','loc_id');
        
        $data = [
            'empresa' => $empresa,
            'regimenes' => $regimenes,
            'localidades' => $localidades,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/empresas/emp_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo emp_nombre sea un campo requerido
        $rules = array(
            'emp_nombre' => 'required',
            'emp_telefono' => 'required | numeric',
            //'emp_cuit' => 'required |numeric | unique:empresas,emp_cuit',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'emp_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('empresas/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $empresa = Empresa::find($id);
        $empresa->emp_nombre = Input::get('emp_nombre');
        $empresa->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'La empresa se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('empresas');
    }
    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $empresa = Empresa::find($id);
        $empresa->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','La empresa se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('empresas');
    }

    
    }

