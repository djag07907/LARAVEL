const {validarMarca, erroresMarca} = require('./marca.util');


test ('Prueba Marca',()=>{
    let nombre = 'LG';
    let descripcion = 'Productos de LG';

    if((erroresMarca(nombre, descripcion).length > 0))
    console.log(erroresMarca(nombre, descripcion));

    expect(validarMarca(nombre,descripcion)).toBe(0);
})