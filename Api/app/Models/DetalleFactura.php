<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model{
    protected $table="detalle_factura";
    //para saber si en la tabla usamos created_at y update_at
    public $timestamp=true;
    //lista blanca cmapos publicos
    protected $fillable=[
        "idCliente",
        "totalCancelar",
        "estado",
        "formFactura",
        "metodoPago",
        "created_at",
        "updated_at"
    ];
    //lista negra campos que no queren que se encuentren facilmente
    public function cliente(){
        return $this->hasMany('App\Models\Cliente','idCliente');
    }
}
