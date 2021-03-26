<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    protected $table = 'detalle_ventas';
    protected $fillable = [
        'idventa', 
        'idproducto',
        'cantidad',
        'impuesto_15',
        'impuesto_18',
        'precio',
        'descuento'
    ];
    public $timestamps = false;
}
