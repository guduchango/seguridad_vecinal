<?php

Class TabsController extends \BaseController {

    public function getForm() {
        //Llama a la vista y le pasa los parametros de $data

        $css_array = array('assets/css/admin/tabs/form.css');
        $js_array = array('assets/js/admin/tabs/form.js');
        $data=[
            'css_array'=>$css_array,
            'js_array' => $js_array
        ];

        return View::make('admin/tabs/tab_form',$data);
    }

    public function getCreate() {
        $provincias = Provincia::lists('pro_nombre','pro_id');
        //Llama a la vista para el formulario crear

        $data =[
            'provincias' => $provincias
        ];
        return View::make('admin/localidades/loc_create',$data);
    }

    public function postStore() {

        //Esta regla permite que el campo pro_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'loc_nombre' => 'required | unique:localidades,loc_nombre',
            //'pro_id' => 'required | unique:localidades,pro_id',

        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'loc_nombre' => 'nombre',
            //'loc_pro_id' => 'id',

        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('localidades/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $localidad = new Localidad();
        $localidad->loc_nombre = Input::get('loc_nombre');
        $localidad->loc_pro_id = Input::get('pro_id');
        $localidad->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','La localidad se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('localidades');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $localidad = Localidad::find($id);
        $provincias = Provincia::lists('pro_nombre','pro_id');

        $data = [
            'localidad' => $localidad,
            'provincias' => $provincias,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/localidades/loc_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo pro_nombre sea un campo requerido
        $rules = array(
            'loc_nombre' => 'required',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'loc_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('localidades/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $localidad = Localidad::find($id);
        $localidad->loc_nombre = Input::get('loc_nombre');
        $localidad->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'La localidad se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('localidades');
    }
    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $localidad = Localidad::find($id);
        $localidad->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','La localidad se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('localidades');
    }


}
