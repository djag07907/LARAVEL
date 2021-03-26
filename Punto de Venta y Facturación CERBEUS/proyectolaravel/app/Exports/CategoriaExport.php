<?php

namespace App\Exports;

use App\Categoria;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CategoriaExport implements FromView
{

    public function view(): View
    {
       
        $categorias = Categoria::select('categorias.id','categorias.nombre','categorias.descripcion','categorias.condicion')
        ->orderBy('categorias.nombre', 'desc')->get(); 

            return view('excel.categoriasexcel', [
                'categorias' => $categorias
            
            
                ]);
    }
}




