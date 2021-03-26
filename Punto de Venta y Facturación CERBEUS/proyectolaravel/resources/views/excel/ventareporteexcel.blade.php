<!DOCTYPE html>
<html>

        <table >
            <thead>
                <tr> 
                    <th>Fecha</th>
                    <th>Numero de Venta</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Vendedor</th>
                    <th>Total</th>
                    <th>ISV 15%</th>
                    <th>ISV 18%</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $a)
                <tr>
                    <td>{{$a->fecha_venta}}</td>
                    <td>{{$a->num_venta}}</td>
                    <td>{{$a->nombre_cliente}}</td>
                    <td>{{$a->tipo_identificacion}}</td>
                    <td>{{$a->nombre_user}}</td>
                    <td>{{$a->total}}</td>
                    <td>{{$a->impuesto15}}</td>
                    <td>{{$a->impuesto18}}</td>
                    
                </tr>
                @endforeach                               
            </tbody>
        </table>
    
</body>
</html>