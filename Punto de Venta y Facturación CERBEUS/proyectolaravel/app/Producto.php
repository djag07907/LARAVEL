<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'productos';
    
    protected $fillable = ['idcategoria','idmarca','codigo','nombre','precio_venta','impuesto','stock','condicion','imagen'];
    
    public function categoria(){

        return $this->belongsTo("App\Categoria");
    }

    public function marca(){

        return $this->belongsTo("App\Marca");
    }
}