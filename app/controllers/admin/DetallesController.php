<?php

Class DetallesController extends \BaseController {

    public function getList() {
        //Trae el listado de localidades
        $detalles = Detalle::join('articulos', 'art_id', '=', 'det_art_id')
                ->join('comprobantes', 'com_id', '=', 'det_com_id')
                ->paginate(30);
        $data = [
            'detalles' => $detalles,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/detalles/det_list', $data);
    }
    
    public function getCreate() {
        
        $articulos = Articulo::lists('art_nombre','art_id');
        $comprobantes = Comprobante::lists('com_numero','com_id');
            
        $data = [
            'articulos' => $articulos,
            'comprobantes' => $comprobantes,
        ];
        return View::make('admin/detalles/det_create',$data);
    }

    public function postStore() {
        
        
       
        //Esta regla permite que el campo pro_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            //'emp_id' => 'required',
            'det_descripcion' => 'required',
            'det_cantidad' => 'required ',
            'det_importe' => 'required | numeric',
            'art_id' => 'required',
            'com_id' => 'required ',
           
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            //'emp_id' => 'id',
            'det_descripcion' => 'descripcion',
            'det_cantidad' => 'cantidad',
            'det_importe' => 'importe',
            'art_id' => 'articulo',
            'com_id' => 'comprobante',
            
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('detalles/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $detalle = new Detalle();
        //$empresa->emp_id = Input::get('emp_id');
        $detalle->det_descripcion = Input::get('det_descripcion');
        $detalle->det_cantidad = Input::get('det_cantidad');
        $detalle->det_importe = Input::get('det_importe');
        $detalle->det_art_id = Input::get('art_id');
        $detalle->det_com_id = Input::get('com_id');
        
        
        
        $detalle->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El detalle se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('detalles');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $detalle = Detalle::find($id);
       $articulo = Articulo::lists('art_nombre','art_id');
       $comprobante = Comprobante::lists('com_numero','com_id');
    
        
        $data = [
            'detalle' => $detalle,
            'articulo' => $articulo,
            'comprobante' => $comprobante,
            
         
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/detalles/det_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo emp_nombre sea un campo requerido
        $rules = array(
            'det_descripcion' => 'required',
            'det_cantidad' => 'required ',
            'det_importe' => 'required | numeric',
            'art_id' => 'required',
            'com_id' => 'required ',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'det_descripcion' => 'descripcion'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('detalles/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $detalle = Detalle::find($id);
        $detalle->det_descripcion = Input::get('det_descripcion');
        $detalle->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El detalle se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('detalles');
    }
    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $detalle = Detalle::find($id);
        $detalle->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El detalle se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('detalles');
    }

    
    }