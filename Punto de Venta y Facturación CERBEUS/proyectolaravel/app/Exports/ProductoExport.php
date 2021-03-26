<?php

namespace App\Exports;

use App\Producto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductoExport implements FromView
{

    public function view(): View
    {
        $productos = Producto::join('categorias','productos.idcategoria','=','categorias.id')
        ->join('marcas','productos.idmarca','=','marcas.id')
        ->select('productos.id','productos.idcategoria','productos.codigo','productos.nombre','categorias.nombre as nombre_categoria','marcas.nombre as nombre_marca','productos.impuesto','productos.precio_venta','productos.stock','productos.condicion')
        ->orderBy('productos.nombre', 'desc')->get(); 

        return view('excel.productosexcel', [
            'productos' => $productos
        ]);
    }
}
