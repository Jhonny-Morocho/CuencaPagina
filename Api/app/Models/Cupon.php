<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model{
    protected $tabla="oferta";
    public $timestamp=true;
       //lista blanca cmapos publicos
       protected $fillable=[
        "nombreCupon",
        "consumo",
        "descuento",
        "fechaExpiracion"
    ];
}
