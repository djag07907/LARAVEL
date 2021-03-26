<?php

namespace App\Exports;

use App\Compra;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CompraReporteExport implements FromView
{

    public function view(): View
    {
        $compras = Compra::join('proveedores','compras.idproveedor','=','proveedores.id')
        ->join('users','compras.idusuario','=','users.id')
        ->select('compras.id','compras.tipo_identificacion',
        'compras.num_compra','compras.total','proveedores.nombre','users.usuario','compras.estado')
        ->orderBy('compras.id', 'desc')->get();

        return view('excel.comprareporteexcel', [
            'compras' => $compras
        ]);
    }
}




 