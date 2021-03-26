<!DOCTYPE html>
<html>
        <table>
            <thead>
                <tr> 
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Producto</th>
                    <th>Código</th>
                    <th>Precio Venta (LPS)</th>
                    <th>Impuesto</th>
                    <th>Stock</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $a)
                <tr>
                    <td>{{$a->nombre_categoria}}</td>
                    <td>{{$a->nombre_marca}}</td>
                    <td>{{$a->nombre}}</td>
                    <td>{{$a->codigo}}</td>
                    <td>{{$a->precio_venta}}</td>
                    <td>{{$a->impuesto}}</td>
                    <td>{{$a->stock}}</td>
                    <td>{{$a->condicion?'Activo':'Desactivado'}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
</body>
</html>