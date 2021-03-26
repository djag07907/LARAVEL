const {validarUser,erroresUser} = require('./user.util');


test ('Prueba Categoria',()=>{
    let nombre = 'jefry';
    let usuario = 'jtercero';
    let password = 'tercero1';
    let idrol = '1';

    if((erroresUser(nombre,usuario,password,idrol).length > 0))
    console.log(erroresUser(nombre,usuario,password,idrol));

    expect(validarUser(nombre,usuario,password,idrol)).toBe(0);
})