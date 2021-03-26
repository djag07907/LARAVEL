<?php

namespace App\Exports;

use App\Marca;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MarcaExport implements FromView
{

    public function view(): View
    {
       
        $marcas = Marca::select('marcas.id','marcas.nombre','marcas.descripcion','marcas.condicion')
        ->orderBy('marcas.nombre', 'desc')->get(); 

            return view('excel.marcasexcel', [
                'marcas' => $marcas
            
            
                ]);
    }
}
