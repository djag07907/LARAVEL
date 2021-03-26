<?php

namespace App\Exports;

use App\Venta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class VentaReporteExport implements FromView
{

    public function view(): View
    {
        $ventas = Venta::join('clientes','ventas.idcliente','=','clientes.id')
        ->join('users','ventas.idusuario','=','users.id')
        ->select('ventas.fecha_venta','ventas.num_venta','ventas.idcliente','clientes.nombre as nombre_cliente','ventas.tipo_identificacion','ventas.idusuario','users.nombre as nombre_user','ventas.total','ventas.impuesto15','ventas.impuesto18')
        ->orderBy('ventas.fecha_venta', 'desc')->get(); 

        return view('excel.ventareporteexcel', [
            'ventas' => $ventas
        ]);
    }
}



   

        


