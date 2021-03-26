exports.validarCategoria = function(nombre,descripcion){

    var errorCategoria=0;
    var errorMostrarMsjCategoria = [];

    if(nombre == null){
        errorMostrarMsjCategoria.push("(*)El nombre de la categoria no puede estar vacio");
    }else if (!validInput(nombre)){
        errorMostrarMsjCategoria.push("(*)El nombre de la categoria no tiene el formato correcto");
    }
    if(descripcion == null){
        errorMostrarMsjCategoria.push("(*)La descripcion de la categoria no puede estar vacia");
    }else if (!validInput(descripcion)){
        errorMostrarMsjCategoria.push("(*)La descripcion de la categoria no tiene el formato correcto");
    }    
    if(errorMostrarMsjCategoria.length >= 1){
        errorCategoria = 1;
    }

    return errorCategoria;

}

exports.erroresCategoria = function(nombre,descripcion){

    var errorCategoria=0;
    var errorMostrarMsjCategoria = [];

    if(nombre == null){
        errorMostrarMsjCategoria.push("(*)El nombre de la categoria no puede estar vacio");
    }else if (!validInput(nombre)){
        errorMostrarMsjCategoria.push("(*)El nombre de la categoria no tiene el formato correcto");
    }
    if(descripcion == null){
        errorMostrarMsjCategoria.push("(*)La descripcion de la categoria no puede estar vacia");
    }else if (!validInput(descripcion)){
        errorMostrarMsjCategoria.push("(*)La descripcion de la categoria no tiene el formato correcto");
    }    

    return errorMostrarMsjCategoria;

}

function validInput(input) {
    var re = /^[a-zA-Z ]{2,50}$/;
    return re.test(input);
}