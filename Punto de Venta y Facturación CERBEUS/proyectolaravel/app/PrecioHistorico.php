<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioHistorico extends Model
{
    //
    protected $table = 'precios_historicos';
    
    protected $fillable = ['idproducto','precio_viejo','precio_nuevo','fecha_cambio'];
    
    public function producto(){

        return $this->belongsTo("App\Producto");
    }
}