<?php

Class AlertasController extends \BaseController {

    public function getList() {
        //Trae el listado de los alertas
        $alertas = Alerta::paginate(30);
        $data = [
            'alertas' => $alertas,
        ];

        //Llama a la vista y le pasa los parametros de $data
        return View::make('admin/alertas/ale_list', $data);
    }

    public function getCreate() {
        //Llama a la vista para el formulario crear
        return View::make('admin/alertas/ale_create');
    }

    public function postStore() {
        //Esta regla permite que el campo ale_nombre sea un campo requerido
        //Ademas revisa que los nombres sean unicos
        $rules = array(
            'ale_nombre' => '',
        );

        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "ale_nombre"
        $attributes = array(
            'usu_nombre' => 'nombre'
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('alertas/create')
                            ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia de objeto para ingresar los valores
        //y se guarda
        $alerta = new Alerta();
        $alerta->ale_ubicacion = Input::get('ale_ubicacion');
        $alerta->ale_mensaje = Input::get('ale_mensaje');
        $alerta->ale_tipo = Input::get('ale_tipo');
        $alerta->save();
        
        try {

    $user = 'Gabbi_Caceress';
    $apikey = 'd3ebaab7be7e37862a1bf0bd8d428f9d';

    $smsc = new Smsc($user, $apikey);

    // Estado del servicio
    echo 'El estado del servicio es ' . ($smsc->getEstado() ? 'OK' : 'CAIDO') . '. ';

    // Saldo
    echo 'Quedan: ' . $smsc->getSaldo() . ' sms. ';

    // Enviar SMS
    $smsc->addNumero(260,154036357);
    $smsc->addNumero(260,154061093);

    $smsc->setMensaje('Seguridad Vecinal: Desde:'.Input::get('ale_ubicacion').'----Mensaje:'.Input::get('ale_mensaje'));
    if ($smsc->enviar())
        echo 'Mensaje enviado.';
} catch (Exception $e) {
    echo 'Error ' . $e->getCode() . ': ' . $e->getMessage();
}
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El alerta se guardo correctamente');

        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('alertas');
    }

    public function getEdit($id) {
        //Se busca el id y se lo agrega a un objeto
        $alerta = Alerta::find($id);

        $data = [
            'alerta' => $alerta,
        ];
        //Llama a la vista y envia el objeto
        return View::make('admin/alertas/ale_edit', $data);
    }

    public function putUpdate($id) {

        //Esta regla permite que el campo ale_nombre sea un campo requerido
        $rules = array(
            '' => '',
        );
        //En este caso se le atribuye un nombre representativo a la variable
        //En el caso de que exista un error se mostrara "nombre" y no "ale_nombre"
        $attributes = array(
            '' => ''
        );
        $validator = Validator::make(Input::all(), $rules);
        $validator->setAttributeNames($attributes);

        //Si el campo no cumple con las reglas entra a este if
        if ($validator->fails()) {
            //Redirecciona al formulario nuevamente con los errores
            return Redirect::to('alertas/edit/' . $id)
                            ->withErrors($validator)->withInput(Input::all());
        }
        //Se crea una instancia del obejeto para ingresar los valores
        //y se actualiza
        $alerta = Alerta::find($id);
        $alerta->ale_ubicacion = Input::get('ale_ubicacion');
        $alerta->ale_mensaje = Input::get('ale_mensaje');
        $alerta->ale_tipo = Input::get('ale_tipo');
        $alerta->save();

        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El alerta se actualizo correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('alertas');
    }

    public function deleteDestroy($id) {
        //Se crea una instalncia del objeto con el id
        //y se elimina
        $alerta = Alerta::find($id);
        $alerta->delete();
        //Se envia un mensaje de tipo flash solo se muestra una vez redireccionado
        //en el caso de actualizar la pagina desaparece
        Session::flash('message', 'El alerta se elimino correctamente');
        //Si todos se cumplio correctamente redirecciona
        return Redirect::to('alertas');
    }

}

class Smsc {

    /**
     * @var string ApiKey de SMSC
     */
    private $apikey = '';

    /**
     * @var string Alias de SMSC
     */
    private $alias = '';
    private $mensaje = '';
    private $return = '';

    public function __construct($alias = null, $apikey = null) {
        if ($alias !== null)
            $this->setAlias($alias);
        if ($apikey !== null)
            $this->setApikey($apikey);
    }

    public function getApikey() {
        return $this->apikey;
    }

    public function setApikey($apikey) {
        $this->apikey = $apikey;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function setAlias($alias) {
        $this->alias = $alias;
    }

    public function getData() {
        return $this->return['data'];
    }

    public function getStatusCode() {
        return $this->return['code'];
    }

    public function getStatusMessage() {
        return $this->return['message'];
    }

    public function exec($cmd = null, $extradata = null) {
        $this->return = null;

        // construyo la URL de consulta
        $url = 'https://www.smsc.com.ar/api/0.2/?alias=Gabbi_Caceres&apikey=d3ebaab7be7e37862a1bf0bd8d428f9d&cmd=estado';
        $url2 = '';
        if ($cmd !== null)
            $url2 .= '&cmd=' . $cmd;
        if ($extradata !== null)
            $url2 .= $extradata;

        // hago la consulta
        $data = @file_get_contents($url . $url2);
        if ($data === false) {
            throw new Exception('No se pudo conectar al servidor.', 1);
            return false;
        }
        $ret = json_decode($data, true);
        if (!is_array($ret)) {
            throw new Exception('Datos recibidos, pero no han podido ser reconocidos ("' . $data . '") (url2=' . $url2 . ').', 2);
            return false;
        }
        $this->return = $ret;
        return true;
    }

    /**
     * Estado del sistema SMSC.
     * @return bool Devuelve true si no hay demoras en la entrega.
     */
    public function getEstado() {
        $ret = $this->exec('estado');
        if (!$ret)
            return false;
        if ($this->getStatusCode() != 200) {
            throw new Exception($this->getStatusMessage(), $this->getStatusCode());
            return false;
        } else {
            $ret = $this->getData();
            return $ret['estado'];
        }
    }

    /**
     * Validar número
     * @return bool Devuelve true si es un número válido.
     */
    public function evalNumero($prefijo, $fijo = null) {
        $ret = $this->exec('evalnumero', '&num=' . $prefijo . ($fijo === null ? '' : '-' . $fijo));
        if (!$ret)
            return false;
        if ($this->getStatusCode() != 200) {
            throw new Exception($this->getStatusMessage(), $this->getStatusCode());
            return false;
        } else {
            $ret = $this->getData();
            return $ret['estado'];
        }
    }

    /**
     *
     * @return array
     */
    public function getSaldo() {
        $ret = $this->exec('saldo');
        if (!$ret)
            return false;
        if ($this->getStatusCode() != 200) {
            throw new Exception($this->getStatusMessage(), $this->getStatusCode());
            return false;
        } else {
            $ret = $this->getData();
            return $ret['mensajes'];
        }
    }

    /**
     *
     * @param int $prioridad 0:todos 1:baja 2:media 3:alta
     * @return array
     */
    public function getEncolados($prioridad = 0) {
        $ret = $this->exec('encolados', '&prioridad=' . intval($prioridad));
        if (!$ret)
            return false;
        if ($this->getStatusCode() != 200) {
            throw new Exception($this->getStatusMessage(), $this->getStatusCode());
            return false;
        } else {
            $ret = $this->getData();
            return $ret['mensajes'];
        }
    }

    /**
     * *******************************************
     * *******   Metodos para enviar SMS   *******
     * *******************************************
     */

    /**
     * @param integer $prefijo	Prefijo del área, sin 0
     * 					Ej: 2627 ó 2627530000
     * @param integer $fijo Número luego del 15, sin 15
     * 					Si sólo especifica prefijo, se tomará como número completo (no recomendado).
     * 					Ej: 530000
     */
    public function addNumero($prefijo, $fijo = null) {
        if ($fijo === null)
            $this->numeros[] = $prefijo;
        else
            $this->numeros[] = $prefijo . '-' . $fijo;
    }

    public function getMensaje() {
        return $this->mensaje;
    }

    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    public function enviar() {
        $ret = $this->exec('enviar', '&num=' . implode(',', $this->numeros) . '&msj=' . urlencode($this->mensaje));
        if (!$ret)
            return false;
        if ($this->getStatusCode() != 200) {
            throw new Exception($this->getStatusMessage(), $this->getStatusCode());
            return false;
        } else {
            return $this->getData();
        }
    }

    /**
     * ***********************************************
     * *******  Metodos para hacer consultas   *******
     * ***********************************************
     */

    /**
     * Devuelve los últimos 30 SMSC recibidos.
     * 
     * Lo óptimo es usar esta función cuando se recibe la notificación, que puede
     * especificar en https://www.smsc.com.ar/usuario/api/
     * 
     * @param int $ultimoid si se especifica, el sistema sólo devuelve los SMS
     * 						más nuevos al sms con id especificado (acelera la
     * 						consulta y permite un chequeo rápido de nuevos mensajes)
     */
    public function getRecibidos($ultimoid = 0) {
        $ret = $this->exec('recibidos', '&ultimoid=' . (int) $ultimoid);
        if (!$ret)
            return false;
        if ($this->getStatusCode() != 200) {
            throw new Exception($this->getStatusMessage(), $this->getStatusCode());
            return false;
        } else {
            return $this->getData();
        }
    }

}




