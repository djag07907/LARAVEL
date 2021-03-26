<?php

namespace App\Exports;

use App\Cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClienteExport implements FromView
{

    public function view(): View
    {
        
        $clientes = Cliente::select('clientes.id','clientes.nombre','clientes.tipo_documento','clientes.num_documento','clientes.direccion','clientes.telefono','clientes.email')
            ->orderBy('clientes.nombre', 'desc')->get(); 

        return view('excel.clientesexcel', [
            'clientes' => $clientes
        ]);
    }
}
