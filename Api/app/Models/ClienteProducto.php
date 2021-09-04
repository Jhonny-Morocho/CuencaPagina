<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteProducto extends Model{
    protected $table="cliente_producto";
    //para saber si en la tabla usamos created_at y update_at
    public $timestamp=true;
    //lista blanca cmapos publicos
    protected $fillable=[
        "idCliente",
        "idFactura",
        "idProducto",
        "fechaCompra",
        "metodoCompra",
        "precioCompra",
        "estadoPagoProveedor",
    ];
    //lista negra campos que no queren que se encuentren facilmente
    public function producto(){
        return $this->hasMany('App\Models\Producto','idCliente');
    }
    public function detallaFactura(){
        return $this->hasMany('App\Models\DetallaFactura','idFactura');
    }
    public function cliente(){
        return $this->hasMany('App\Models\Cliente','idCliente');
    }


}
