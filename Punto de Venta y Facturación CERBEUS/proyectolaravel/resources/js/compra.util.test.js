const {CalcularTotal, validarComprade, erroresComprade} = require('./compra.util');

test ('Prueba Total',()=>{
    let detalle = [
        {
            precio: 500, 
            cantidad: 10,
           
        },
        {
            precio: 100, 
            cantidad: 3,
            
        },
    ];
    expect(CalcularTotal(detalle)).toBe(5300);
})

test ('Prueba Compra Detalle',()=>{
    let idproveedor = 1;
    let idtipo_documentacion = 1;
    let num_compra = 'CMP001';

    if((erroresComprade(idproveedor, idtipo_documentacion, num_compra).length > 0))
    console.log(erroresComprade(idproveedor, idtipo_documentacion, num_compra));
    

    expect(validarComprade(idproveedor, idtipo_documentacion, num_compra)).toBe(0);
})
