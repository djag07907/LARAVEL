exports.validarProducto = function(idcategoria, idmarca, nombre, precio_venta, stock){

    var errorProducto=0;
    var errorMostrarMsjProducto=[];
                 
    if(idcategoria == 0){
        errorMostrarMsjProducto.push("(*)Selecciona una categoria");
    }
    if(idmarca == 0){
        errorMostrarMsjProducto.push("(*)Selecciona una marca");
    }
    if(nombre == null){
        errorMostrarMsjProducto.push("(*)El nombre del producto no puede estar vacio");
    }else if (!validInputAlpha(nombre)){
        errorMostrarMsjProducto.push("(*)El nombre del producto no tiene el formato correcto");
    }
    if(precio_venta == null){
        errorMostrarMsjProducto.push("(*)El precio venta del producto debe ser un numero y no puede estar vacio");
    }else if (!validInputFloat(precio_venta)){
        errorMostrarMsjProducto.push("(*)El Precio debe ser mayor a 0");
    }
    if(stock == null){
        errorMostrarMsjProducto.push("(*)El stock del producto debe ser un numero y no puede estar vacio");
    }else if (!validInputInteger(stock)){
        errorMostrarMsjProducto.push("(*)El Stock debe ser mayor a 0");
    }
    if(errorMostrarMsjProducto.length >= 1){
        errorProducto = 1;
    }

    return errorProducto;
}

exports.erroresProducto = function(idcategoria, idmarca, nombre, precio_venta, stock){

    var errorProducto=0;
    var errorMostrarMsjProducto=[];
                 
    if(idcategoria == 0){
        errorMostrarMsjProducto.push("(*)Selecciona una categoria");
    }
    if(idmarca == 0){
        errorMostrarMsjProducto.push("(*)Selecciona una marca");
    }
    if(nombre == null){
        errorMostrarMsjProducto.push("(*)El nombre del producto no puede estar vacio");
    }else if (!validInputAlpha(nombre)){
        errorMostrarMsjProducto.push("(*)El nombre del producto no tiene el formato correcto");
    }
    if(precio_venta == null){
        errorMostrarMsjProducto.push("(*)El precio venta del producto debe ser un numero y no puede estar vacio");
    }else if (!validInputFloat(precio_venta)){
        errorMostrarMsjProducto.push("(*)El Precio debe ser mayor a 0");
    }
    if(stock == null){
        errorMostrarMsjProducto.push("(*)El stock del producto debe ser un numero y no puede estar vacio");
    }else if (!validInputInteger(stock)){
        errorMostrarMsjProducto.push("(*)El Stock debe ser mayor a 0");
    }

    return errorMostrarMsjProducto;
}

function validInputAlpha(input) {
    var re = /^[a-zA-Z ]{2,50}$/;
    return re.test(input);
}

function validInputFloat(input) {
    var re = /^(0*[1-9][0-9]*(\.[0-9]+)?|0+\.[0-9]*[1-9][0-9]*)$/;
    return re.test(input);
}

function validInputInteger(input) {
    var re = /^[1-9][0-9]*$/;
    return re.test(input);
}