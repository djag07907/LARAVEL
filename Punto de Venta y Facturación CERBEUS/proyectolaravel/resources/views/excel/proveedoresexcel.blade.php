<!DOCTYPE html>
<html >

        <table>
            <thead>
                <tr> 
                    <th>Nombre del Proveedor</th>
                    <th>Tipo de Documento</th>
                    <th>Numero de Documento</th>
                    <th>Dirección</th>
                    <th>Numero de Telefono</th>
                    <th>Correo Electronico</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $a)
                <tr>
                    <td>{{$a->nombre}}</td>
                    <td>{{$a->tipo_documento}}</td>
                    <td>{{$a->num_documento}}</td>
                    <td>{{$a->direccion}}</td>
                    <td>{{$a->telefono}}</td>
                    <td>{{$a->email}}</td>
                    
                </tr>
                @endforeach                               
            </tbody>
        </table>
    
</body>
</html>