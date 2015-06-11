<?php

Class RegimenesController extends \BaseController {

    public function getList() {
        //Trae el listado de regimenes
        $regimenes = Regimen::paginate(30);
        $data = [
            'regimenes' => $regimenes,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/regimenes/reg_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/regimenes/reg_create');
    }

    public function postStore() {
        //Esta regla permite que el campo pro_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'reg_nombre' => 'required | unique:regimenes,reg_nombre',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'reg_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('regimenes/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $regimen = new Regimen();
        $regimen->reg_nombre = Input::get('reg_nombre');
        $regimen->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El regimen se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('regimenes');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $regimen = Regimen::find($id);

        $data = [
            'regimen' => $regimen,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/regimenes/reg_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo pro_nombre sea un campo requerido
        $rules = array(
            'reg_nombre' => 'required',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "pro_nombre"
        $attributes = array(
            'reg_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('regimenes/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $regimen = Regimen::find($id);
        $regimen->reg_nombre = Input::get('reg_nombre');
        $regimen->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El regimen se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('regimenes');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $regimen = Regimen::find($id);
        $regimen->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El regimen se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('regimenes');
    }

}

