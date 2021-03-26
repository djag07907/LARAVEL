const {validarProveedor, erroresProveedor} = require('./proveedor.util');


test ('Prueba Proveedor',()=>{
    let nombre = 'Tercero';
    let tipo_documento = 'RTN'
    let num_documento = 180122586987411;
    let telefono = 96271892;
    let email = 'tercero@gmail.com';
    let direccion = 'sucasa';

    if((erroresProveedor(nombre, tipo_documento, num_documento, telefono, email, direccion).length > 0))
    console.log(erroresProveedor(nombre, tipo_documento, num_documento, telefono, email, direccion));   


    expect(validarProveedor(nombre, tipo_documento, num_documento, telefono, email, direccion)).toBe(0);
})