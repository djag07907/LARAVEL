exports.CalcularTotal = function(arrayDetalle){
    var resultado=0.0;
    for(var i=0;i<arrayDetalle.length;i++){
        resultado=resultado+(arrayDetalle[i].precio*arrayDetalle[i].cantidad - arrayDetalle[i].descuento)
    }
    return resultado;
}

exports.CalcularImpuesto18 = function(arrayDetalle){
    var resultado=0.0;
    for(var i=0;i<arrayDetalle.length;i++){
        if(arrayDetalle[i].impuesto==18){
            resultado=resultado+((arrayDetalle[i].precio*0.18)*arrayDetalle[i].cantidad)
        }
    }
    return resultado;
}

exports.CalcularImpuesto15 = function(arrayDetalle){
    var resultado=0.0;
    for(var i=0;i<arrayDetalle.length;i++){
        if(arrayDetalle[i].impuesto==15){
            resultado=resultado+((arrayDetalle[i].precio*0.15)*arrayDetalle[i].cantidad)
        }
    }
    return resultado;
}

exports.validarVentade = function(idcliente, idtipo_documentacion, num_venta){

    var errorVenta=0;
    var errorMostrarMsjVenta=[];
                 
    if(idcliente == 0){
        errorMostrarMsjVenta.push("(*)Seleccione un proveedor");
    }
    if(idtipo_documentacion == 0){
        errorMostrarMsjVenta.push("(*)Selecciona una documentacion");
    }
    if(num_venta == null){
        errorMostrarMsjVenta.push("(*)El numero de venta de la venta no puede estar vacio");
    }else if (!validInputNumVenta(num_venta)){
        errorMostrarMsjVenta.push("(*)El numero de venta de la venta no tiene el formato correcto");
    }
    
    if(errorMostrarMsjVenta.length >= 1){
        errorCompra = 1;
    }

    return errorVenta;
}

exports.erroresVentade = function(idcliente, idtipo_documentacion, num_venta){

    var errorVenta=0;
    var errorMostrarMsjVenta=[];
                 
    if(idcliente == 0){
        errorMostrarMsjVenta.push("(*)Seleccione un proveedor");
    }
    if(idtipo_documentacion == 0){
        errorMostrarMsjVenta.push("(*)Selecciona una documentacion");
    }
    if(num_venta == null){
        errorMostrarMsjVenta.push("(*)El numero de venta de la venta no puede estar vacio");
    }else if (!validInputNumVenta(num_venta)){
        errorMostrarMsjVenta.push("(*)El numero de venta de la venta no tiene el formato correcto");
    }

    return errorMostrarMsjVenta;
}

function validInputNumVenta (input){
    var re = /^[A-Za-z0-9]*$/;
    return re.test(input);
}


