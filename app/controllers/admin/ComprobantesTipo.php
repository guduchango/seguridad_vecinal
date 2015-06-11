<?php

Class ComprobantesTipoController extends \BaseController {

    public function getList() {
        //Trae el listado de provincias
        $comprobantest = Comprobantet::paginate(30);
        $data = [
            'comprobantest' => $comprobantest,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/comprobantest/comt_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/comprobantest/comt_create');
    }

    public function postStore() {
        //Esta regla permite que el campo pro_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'ct_nombre' => 'required | unique:comprobantes_tipo,ct_nombre',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'ct_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('comprobantest/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $comprobantet = new Comprobantet();
        $comprobantet->ct_nombre = Input::get('ct_nombre');
        $comprobantet->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El comprobante  se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('comprobantest');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $comprobantet = Comprobantet::find($id);

        $data = [
            'comprobantet' => $comprobantet,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/comprobantest/comt_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo pro_nombre sea un campo requerido
        $rules = array(
            'ct_nombre' => 'required',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'ct_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('comprobantest/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $comprobantet = Comprobantet::find($id);
        $comprobantet->ct_nombre = Input::get('ct_nombre');
        $comprobantet->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El comprobante tipo se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('comprobantest');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $comprobantet = Comprobantet::find($id);
        $comprobantet->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El comprobante se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('comprobantest');
    }

}

