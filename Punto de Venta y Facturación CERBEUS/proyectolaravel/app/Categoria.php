<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table = 'categorias';

    protected $fillable = ['nombre','descripcion','condicion'];

    public function productos(){

        return $this->hasMany("App\Producto");
   }
}
