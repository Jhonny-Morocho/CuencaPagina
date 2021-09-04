<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model{
    //nombre de la tabla
    protected $table="proveedor";
    //para saber si en la tabla usamos created_at y update_at
    public $timestamp=true;
    //lista blanca cmapos publicos
    protected $fillable=[
        "nombre",
        "apellido",
        "correo",
        "password",
        "img",
        "rol",
        "fechaRegistro",
        "apodo",
        "estado"
    ];
    //los que se relacionan
    public function producto(){
        return $this->hasMany('App\Models\Producto','idProveedor');
    }
}
