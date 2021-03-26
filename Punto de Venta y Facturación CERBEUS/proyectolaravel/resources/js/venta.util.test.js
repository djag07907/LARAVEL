const {CalcularTotal, CalcularImpuesto15, CalcularImpuesto18, erroresVentade, validarVentade} = require('./venta.util');

test ('Prueba Total',()=>{
    let detalle = [
        {
            precio: 500, 
            cantidad: 10,
            descuento: 600 
        },
        {
            precio: 100, 
            cantidad: 3,
            descuento: 0 
        },
    ];
    expect(CalcularTotal(detalle)).toBe(4700);
})

test ('Prueba ISV 18', ()=>{
    let detalle = [
    {
        precio: 500,
        cantidad: 1,
        impuesto: 18
    },
    {
        precio: 1000,
        cantidad: 2,
        impuesto: 18
    },
];
    expect(CalcularImpuesto18(detalle)).toBe(450);
})

test ('Prueba ISV 15', ()=>{
    let detalle = [
    {
        precio: 500,
        cantidad: 1,
        impuesto: 15
    },
    {
        precio: 1000,
        cantidad: 2,
        impuesto: 15
    },
];
    expect(CalcularImpuesto15(detalle)).toBe(375);
})

test ('Prueba Venta',()=>{
    let idproveedor = 1;
    let idtipo_documentacion = 1;
    let num_compra = 'CMP001';

    if((erroresVentade(idproveedor, idtipo_documentacion, num_compra).length > 0))
    console.log(erroresVentade(idproveedor, idtipo_documentacion, num_compra));
    
    expect(validarVentade(idproveedor, idtipo_documentacion, num_compra)).toBe(0);
})


