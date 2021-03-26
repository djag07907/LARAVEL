<?php

namespace App\Exports;

use App\Proveedor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProveedorExport implements FromView
{

    public function view(): View
    {
        $proveedores = Proveedor::select('proveedores.id','proveedores.nombre','proveedores.tipo_documento','proveedores.num_documento','proveedores.direccion','proveedores.telefono','proveedores.email')
            ->orderBy('proveedores.nombre', 'desc')->get(); 
        
            return view('excel.proveedoresexcel', [
            'proveedores' => $proveedores
        ]);
    }
}
