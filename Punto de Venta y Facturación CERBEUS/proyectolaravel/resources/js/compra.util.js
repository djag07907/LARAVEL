exports.CalcularTotal = function(arrayDetalle){
    var resultado=0.0;
    for(var i=0;i<arrayDetalle.length;i++){
        resultado=resultado+(arrayDetalle[i].precio*arrayDetalle[i].cantidad)
    }
    return resultado;
}

exports.validarComprade = function(idproveedor, idtipo_documentacion, num_compra){

    var errorCompra=0;
    var errorMostrarMsjCompra=[];
                 
    if(idproveedor == 0){
        errorMostrarMsjCompra.push("(*)Seleccione un proveedor");
    }
    if(idtipo_documentacion == 0){
        errorMostrarMsjCompra.push("(*)Selecciona una documentacion");
    }
    if(num_compra == null){
        errorMostrarMsjCompra.push("(*)El nombre del producto no puede estar vacio");
    }else if (!validInputNumCompra(num_compra)){
        errorMostrarMsjCompra.push("(*)El nombre del producto no tiene el formato correcto");
    }
    
    if(errorMostrarMsjCompra.length >= 1){
        errorCompra = 1;
    }

    return errorCompra;
}

exports.erroresComprade = function(idproveedor, idtipo_documentacion, num_compra){

    var errorCompra=0;
    var errorMostrarMsjCompra=[];
                 
    if(idproveedor == 0){
        errorMostrarMsjCompra.push("(*)Seleccione un proveedor");
    }
    if(idtipo_documentacion == 0){
        errorMostrarMsjCompra.push("(*)Selecciona una documentacion");
    }
    if(num_compra == null){
        errorMostrarMsjCompra.push("(*)El numero de compra de la compra no puede estar vacio");
    }else if (!validInputNumCompra(num_compra)){
        errorMostrarMsjCompra.push("(*)El numero de compra de la compra no tiene el formato correcto");
    }

    return errorMostrarMsjCompra;
}

function validInputNumCompra (input){
    var re = /^[A-Za-z0-9]*$/;
    return re.test(input);
}


