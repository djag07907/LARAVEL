<!DOCTYPE html>
<html>

        <table>
            <thead>
                <tr> 
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Condición</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $a)
                <tr>
                    <td>{{$a->nombre}}</td>
                    <td>{{$a->descripcion}}</td>
                    <td>{{$a->condicion?'Activo':'Desactivado'}}</td>
                </tr>
                @endforeach                               
            </tbody>
        </table>
</body>
</html>