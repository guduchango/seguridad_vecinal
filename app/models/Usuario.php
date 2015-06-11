<?php

class Usuario extends Eloquent{

    protected $table = 'usuarios';
    protected $primaryKey = 'usu_id';

    public $timestamps = false;




   public static function find_all($valor)
    {

       
       $rows = Usuario::where('usu_nombre', 'LIKE', "%$valor%")->where('usu_username', 'LIKE', "%$valor%")->where('usu_email', 'LIKE', "%$valor%")->paginate();
                
        return $rows;
    }
}
