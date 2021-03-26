<!DOCTYPE html>
<html>

        <table>
            <thead>
                <tr> 
                    <th>Fecha de Compra</th>
                    <th>Numero de Compra</th>
                    <th>Proveedor</th>
                    <th>Tipo</th>
                    <th>Comprador</th>
                    <th>Total</th>
                    <th>Estado de la Compra</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $a)
                <tr>
                    <td>{{$a->fecha_compra}}</td>
                    <td>{{$a->num_compra}}</td>
                    <td>{{$a->nombre_proveedor}}</td>
                    <td>{{$a->tipo_identificacion}}</td>
                    <td>{{$a->nombre_users}}</td>
                    <td>{{$a->total}}</td>
                    <td>{{$a->estado}}</td>
                    
                </tr>
                @endforeach                               
            </tbody>
        </table>
     
</body>
</html>