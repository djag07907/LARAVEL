<?php

namespace App\Exports;

use App\PrecioHistorico;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PrecioHistoricoExport implements FromView
{
  public function view(): View 
  { $precios_historicos = PrecioHistorico::join('productos','precios_historicos.idproducto','=','productos.id')            
    ->select('precios_historicos.id','precios_historicos.idproducto','productos.nombre as nombre_producto','precios_historicos.precio_viejo','precios_historicos.precio_nuevo','precios_historicos.fecha_cambio')
    ->orderBy('nombre_producto', 'desc')->get(); 

    return view('excel.preciohistoricosexcel', [
        'precioshistoricos' => $precios_historicos
    ]);
  }
}
