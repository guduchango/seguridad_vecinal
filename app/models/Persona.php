<?php

class Persona extends Eloquent{
    protected $table = 'personas';
    protected $primaryKey = 'per_id';
    public $timestamps = false;

}
