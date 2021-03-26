const {validarCategoria, erroresCategoria} = require('./categoria.util');


test ('Prueba Categoria',()=>{
    let nombre = 'Celulares';
    let descripcion = 'Celulares LG';

    if((erroresCategoria(nombre, descripcion).length > 0))
    console.log(erroresCategoria(nombre, descripcion));

    expect(validarCategoria(nombre, descripcion)).toBe(0);
})