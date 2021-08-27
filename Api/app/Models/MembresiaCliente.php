<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembresiaCliente extends Model{
    protected $table="membresia_cliente";
    //para saber si en la tabla usamos created_at y update_at
    public $timestamp=true;
    //lista blanca cmapos publicos
    protected $fillable=[
        "tipo",
        "fechaCompra",
        "fechaExpiracion",
        "idCliente",
        "totalCancelar",
        "precioUnitario",
        "tipoPago",
    ];
    //lista negra campos que no queren que se encuentren facilmente
    public function cliente(){
        return $this->hasMany('App\Models\Cliente','idCliente');
    }
}
