<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model{
    //nombre de la tabla
    protected $table="cupon";
    //para saber si en la tabla usamos created_at y update_at
    public $timestamp=true;
    //lista blanca cmapos publicos
    protected $fillable=[
        "nombreCupon",
        "consumo",
        "descuento",
        "fechaExpiracion"
    ];
}
