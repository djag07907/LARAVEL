<!DOCTYPE html>
<html>

        <table>
            <thead>
                <tr> 
                    <th>Nombre Producto</th>
                    <th>Precio Anterior</th>
                    <th>Precio Nuevo</th>
                    <th>Fecha Cambio</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($precioshistoricos as $a)
                <tr>
                    <td>{{$a->nombre_producto}}</td>
                    <td>{{$a->precio_viejo}}</td>
                    <td>{{$a->precio_nuevo}}</td>
                    <td>{{$a->fecha_cambio}}</td>
                    
                </tr>
                @endforeach                               
            </tbody>
        </table>
      
</body>
</html>