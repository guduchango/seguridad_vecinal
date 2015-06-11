<?php

Class ArticulosController extends \BaseController {

    public function getList() {
        //Trae el listado de los articulos
        $articulos = Articulo::paginate(30);
        $data = [
            'articulos' => $articulos,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/articulos/art_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/articulos/art_create');
    }

    public function postStore() {
        //Esta regla permite que el campo art_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'art_nombre' => 'required | unique:articulos,art_nombre',
            'art_tipo' => 'required',
            'art_precio' => 'required',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "art_nombre"
        $attributes = array(
            'art_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('articulos/create')
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $articulo = new Articulo();
        $articulo->art_nombre = Input::get('art_nombre');
        $articulo->art_tipo = Input::get('art_tipo');
        $articulo->art_precio = Input::get('art_precio');
        $articulo->art_detalle = Input::get('art_detalle');
        
        $articulo->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El articulo se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('articulos');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $articulo = Articulo::find($id);

        $data = [
            'articulo' => $articulo,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/articulos/art_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo pro_nombre sea un campo requerido
        $rules = array(
            
            'art_nombre' => 'required',
            'art_tipo' => 'required',
            'art_precio' => 'required',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "art_nombre"
        $attributes = array(
            'art_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('articulos/edit/'.$id)
                ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $articulo = Articulo::find($id);
        $articulo->art_nombre = Input::get('art_nombre');
        $articulo->art_tipo = Input::get('art_tipo');
        $articulo->art_precio = Input::get('art_precio');
        $articulo->art_detalle = Input::get('art_detalle');
        $articulo->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El articulo se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('articulos');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $articulo = Articulo::find($id);
        $articulo->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message','El articulo se elimino correctamente' );
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('articulos');
    }

}
