<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PrecioHistorico;
use App\Exports\PrecioHistoricoExport;
use Maatwebsite\Excel\Facades\Excel;


class PrecioHistoricoController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;

        if($buscar==''){

            $precios_historicos= PrecioHistorico::join('productos','precios_historicos.idproducto','=','productos.id')            
            ->select('precios_historicos.id','precios_historicos.idproducto','productos.nombre as nombre_producto','precios_historicos.precio_viejo','precios_historicos.precio_nuevo','precios_historicos.fecha_cambio')
            ->orderBy('precios_historicos.id', 'desc')->paginate(3);

        } else{

            $precios_historicos = PrecioHistorico::join('productos','precios_historicos.idproducto','=','productos.id')            
            ->select('precios_historicos.id','precios_historicos.idproducto','productos.nombre as nombre_producto','precios_historicos.precio_viejo','precios_historicos.precio_nuevo','precios_historicos.fecha_cambio')
            ->where('productos.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('precios_historicos.id', 'desc')->paginate(3);
        }

         
        return[

            'pagination' => [
            'total'            => $precios_historicos->total(),
            'current_page'     => $precios_historicos->currentPage(),
            'per_page'         => $precios_historicos->perPage(),
            'last_page'        => $precios_historicos->lastPage(),
            'from'             => $precios_historicos->firstItem(),
            'to'               => $precios_historicos->lastItem(),
           
            ],

            'precios_historicos' =>$precios_historicos

        ];
       
    }

    public function listarPrecioHistorico(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $precios_historicos = PrecioHistorico::join('productos','precios_historicos.idproducto','=','productos.id')            
            ->select('precios_historicos.id','precios_historicos.idproducto','productos.nombre as nombre_producto','precios_historicos.precio_viejo','precios_historicos.precio_nuevo','precios_historicos.fecha_cambio')
            ->orderBy('precios_historicos.id', 'desc')->paginate(10);
        }
        else{
            $precios_historicos = PrecioHistorico::join('productos','precios_historicos.idproducto','=','productos.id')            
            ->select('precios_historicos.id','precios_historicos.idproducto','productos.nombre as nombre_producto','precios_historicos.precio_viejo','precios_historicos.precio_nuevo','precios_historicos.fecha_cambio')
            ->where('productos.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('precios_historicos.id', 'desc')->paginate(10);
        }
         
 
        return ['precios_historicos' => $precios_historicos];
    }

    

    public function listarPdf(){

        $precios_historicos = PrecioHistorico::join('productos','precios_historicos.idproducto','=','productos.id')            
            ->select('precios_historicos.id','precios_historicos.idproducto','productos.nombre as nombre_producto','precios_historicos.precio_viejo','precios_historicos.precio_nuevo','precios_historicos.fecha_cambio')
            ->orderBy('nombre_producto', 'desc')->get(); 


            $cont=PrecioHistorico::count();

            $pdf= \PDF::loadView('pdf.preciohistoricos',['precioshistoricos'=>$precios_historicos,'cont'=>$cont]);
            return $pdf->stream();
            //return $pdf->download('productos.pdf');
    }


    public function listarExcel(){
        return Excel::download(new PrecioHistoricoExport, 'precioshistoricos.xlsx');
    }



    public function buscarPrecioHistorico(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $filtro = $request->filtro;
        $precios_historicos = PrecioHistorico::where('codigo','=', $filtro)
        ->select('id','nombre')->orderBy('nombre', 'asc')->take(1)->get();
 
        return ['precios_historicos' => $precios_historicos];
    }

    

   


}
