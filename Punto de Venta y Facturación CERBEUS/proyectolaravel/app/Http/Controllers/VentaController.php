<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Venta;
use App\DetalleVenta;
use App\User;

class VentaController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $ventas = Venta::join('clientes','ventas.idcliente','=','clientes.id')
            ->join('users','ventas.idusuario','=','users.id')
            ->select('ventas.id','ventas.tipo_identificacion',
            'ventas.num_venta','ventas.fecha_venta','ventas.impuesto','ventas.total',
            'ventas.estado','clientes.nombre','users.usuario')
            ->orderBy('ventas.id', 'desc')->paginate(3);
        }
        else{
            $ventas = Venta::join('clientes','ventas.idcliente','=','clientes.id')
            ->join('users','ventas.idusuario','=','users.id')
            ->select('ventas.id','ventas.tipo_identificacion',
            'ventas.num_venta','ventas.fecha_venta','ventas.impuesto','ventas.total',
            'ventas.estado','clientes.nombre','users.usuario')
            ->where('ventas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ventas.id', 'desc')->paginate(3);
        }
         
        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
        ];
    }

    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
        $venta = Venta::join('clientes','ventas.idcliente','=','clientes.id')
        ->join('users','ventas.idusuario','=','users.id')
        ->select('ventas.id','ventas.tipo_identificacion',
        'ventas.num_venta','ventas.fecha_venta','ventas.impuesto','ventas.total',
        'ventas.estado','clientes.nombre','users.usuario')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id', 'desc')->take(1)->get();
         
        return ['venta' => $venta];
    }

    public function obtenerDetalles(Request $request){
        if (!$request->ajax()) return redirect('/');
 
        $id = $request->id;
        $detalles = DetalleVenta::join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('detalle_ventas.cantidad','detalle_ventas.precio','detalle_ventas.descuento',
        'productos.nombre as producto')
        ->where('detalle_ventas.idventa','=',$id)
        ->orderBy('detalle_ventas.id', 'desc')->get();
         
        return ['detalles' => $detalles];
    }

    public function pdf(Request $request,$id){
      
        $venta = Venta::join('clientes','ventas.idcliente','=','clientes.id')
        ->join('users','ventas.idusuario','=','users.id')
        ->select('ventas.id','ventas.tipo_identificacion',
        'ventas.num_venta','ventas.created_at','ventas.impuesto','ventas.total',
        'ventas.estado','clientes.nombre','clientes.tipo_documento','clientes.num_documento',
        'clientes.direccion','clientes.email','clientes.telefono','users.usuario')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id', 'desc')->take(1)->get();

        $detalles = DetalleVenta::join('productos','detalle_ventas.idproducto','=','productos.id')
        ->select('detalle_ventas.cantidad','detalle_ventas.precio','detalle_ventas.descuento',
        'productos.nombre as producto')
        ->where('detalle_ventas.idventa','=',$id)
        ->orderBy('detalle_ventas.id', 'desc')->get();

        $numventa=Venta::select('num_venta')->where('id',$id)->get();
        
        $pdf= \PDF::loadView('pdf.venta',['venta'=>$venta,'detalles'=>$detalles]);
        return $pdf->download('venta-'.$numventa[0]->num_venta.'.pdf');
    }

    
 
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        try{
            DB::beginTransaction();
 
            $mytime= Carbon::now('America/Costa_Rica');
 
            $venta = new Venta();
            $venta->idcliente = $request->idcliente;
            $venta->idusuario = \Auth::user()->id;
            $venta->tipo_identificacion = $request->tipo_identificacion;
            $venta->num_venta = $request->num_venta;
            $venta->fecha_venta = $mytime->toDateString();
            $venta->impuesto = $request->impuesto;
            $venta->total = $request->total;
            $venta->estado = 'Registrado';
            $venta->save();
 
            $detalles = $request->data;//Array de detalles
            //Recorro todos los elementos
 
            foreach($detalles as $ep=>$det)
            {
                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->id;
                $detalle->idproducto = $det['idproducto'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->precio = $det['precio'];
                $detalle->descuento = $det['descuento'];         
                $detalle->save();
            } 
            
 
            DB::commit();
            

        } catch (Exception $e){
            DB::rollBack();
        }
    }
 
    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($request->id);
        $venta->estado = 'Anulado';
        $venta->save();
    }
}
