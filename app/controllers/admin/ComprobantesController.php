<?php

Class ComprobantesController extends \BaseController {

    public function getList() {
        //Trae el listado de localidades
        $comprobantes = Comprobante::join('comprobantes_tipo', 'ct_id', '=', 'com_ct_id')
                ->join('clientes', 'cli_id', '=', 'com_cli_id')->paginate(30);
        $data = [
            'comprobantes' => $comprobantes,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/comprobantes/com_list', $data);
    }
    
    public function getCreate() {
            
        $comprobantest = Comprobantet::lists('ct_nombre','ct_id');
        $clientes = Cliente::lists('cli_razonsocial','cli_id');
     
      
      $data =[
          
          'comprobantest' => $comprobantest,
          'clientes' => $clientes,
      ];
        
        return View::make('admin/comprobantes/com_create',$data);
    }

    public function postStore() {
        
        
       
        //Esta regla permite que el campo pro_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            //'emp_id' => 'required',
            'com_numero' => 'required',
            'com_fecha' => 'required | date_format: d/m/y',
            'com_total' => 'required | numeric',
            'com_detalle' => 'required',
            'ct_id' => 'required ',
            'cli_id' => 'required ',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            //'emp_id' => 'id',
            'com_numero' => 'numero',
            'com_fecha' => 'fecha',
            'com_total' => 'total',
            'com_detalle' => 'detalle',
            'ct_id' => 'comprobante',
            'cli_id' => 'cliente',
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('comprobantes/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $comprobante = new Comprobante();
        //$empresa->emp_id = Input::get('emp_id');
        $comprobante->com_numero = Input::get('com_numero');
        $comprobante->com_fecha = Input::get('com_fecha');
        $comprobante->com_total = Input::get('com_total');
        $comprobante->com_detalle = Input::get('com_detalle');
        $comprobante->com_ct_id = Input::get('ct_id');
        $comprobante->com_cli_id = Input::get('cli_id');
        
        
        $comprobante->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El comprobante se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('comprobantes');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $comprobante = Comprobante::find($id);
        $comprobantest = Comprobantet::lists('ct_nombre','ct_id');
        $clientes = Cliente::lists('cli_razonsocial','cli_id');
    
        
        $data = [
            'comprobante' => $comprobante,
            'comprobantest' => $comprobantest,
            'clientes' => $clientes,
         
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/comprobantes/com_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo emp_nombre sea un campo requerido
        $rules = array(
            'com_numero' => 'required',
            'com_fecha' => 'required',
            'com_total' => 'required | numeric',
            'com_detalle' => 'required',
            'ct_id' => 'required ',
            'cli_id' => 'required ',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'com_numero' => 'numero'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('comprobantes/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $comprobante = Comprobante::find($id);
        $comprobante->com_numero = Input::get('com_numero');
        $comprobante->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El comprobante se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('comprobantes');
    }
    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $comprobante = Comprobante::find($id);
        $comprobante->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El comprobante se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('comprobantes');
    }

    
    }