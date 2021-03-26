const {validarProducto, erroresProducto} = require('./producto.util');


test ('Prueba Producto',()=>{
    let idcategoria = 1;
    let idmarca = 1;
    let nombre = 'LG Stylus';
    let precio_venta = 1;
    let stock = 1;

    if((erroresProducto(idcategoria, idmarca, nombre, precio_venta, stock).length > 0))
    console.log(erroresProducto(idcategoria, idmarca, nombre, precio_venta, stock));

    expect(validarProducto(idcategoria, idmarca, nombre, precio_venta, stock)).toBe(0);
})