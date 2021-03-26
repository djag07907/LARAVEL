exports.validarCompra = function(idproveedor, idtipo_documentacion, num_compra){

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

    return errorProducto;
}

// function validInputAlpha(input) {
//     var re = /^[a-zA-Z ]{2,50}$/;
//     return re.test(input);
// }

// function validInputFloat(input) {
//     var re = /^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$/;
//     return re.test(input);
// }

// function validInputInteger(input) {
//     var re = /^[1-9][0-9]*$/;
//     return re.test(input);
// }
function validInputNumCompra (input){
    var re = /^[A-Za-z0-9]*$/;
    return re.test(input);
}