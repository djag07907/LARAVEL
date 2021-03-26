const {validarCliente, erroresCliente} = require('./cliente.util');


test ('Prueba Cliente',()=>{
    let nombre = 'Tercero';
    let tipo_documento = 'RTN'
    let num_documento = 18012258698741;
    let telefono = 96271892;
    let email = 'tercero@gmail.com';
    let direccion = 'sucasa';

    if((erroresCliente(nombre, tipo_documento, num_documento, telefono, email, direccion).length > 0))
    console.log(erroresCliente(nombre, tipo_documento, num_documento, telefono, email, direccion));  
    

    expect(validarCliente(nombre, tipo_documento, num_documento, telefono, email, direccion)).toBe(0);
})