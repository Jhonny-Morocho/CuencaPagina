<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model{
    protected $table="cliente";
    //para saber si en la tabla usamos created_at y update_at
    public $timestamp=true;
    //lista blanca cmapos publicos
    protected $fillable=[
        "nombre",
        "apellido",
        "correo",
        "password",
        "rol",
        "fechaRegistro",
        "saldoActual",
        "estado"
    ];
    //lista negra campos que no queren que se encuentren facilmente
    public function detalleFactura(){
        return $this->hasMany('App\Models\DetallaFactura','idCliente');
    }
}
