exports.validarMarca = function(nombre,descripcion){

    var errorMarca=0;
    var errorMostrarMsjMarca=[];

    if(nombre == null){
        errorMostrarMsjMarca.push("(*)El nombre de la marca no puede estar vacio");
    }else if (!validInput(nombre)){
        errorMostrarMsjMarca.push("(*)El nombre de la marca no tiene el formato correcto");
    }
    if(descripcion == null){
        errorMostrarMsjMarca.push("(*)La descripcion de la marca no puede estar vacia");
    }else if (!validInput(descripcion)){
        errorMostrarMsjMarca.push("(*)La descripcion de la marca no tiene el formato correcto");
    }
    
    
    if(errorMostrarMsjMarca.length >= 1){
        errorMarca = 1;
    }

    return errorMarca;

}

exports.erroresMarca = function(nombre,descripcion){

    var errorMarca=0;
    var errorMostrarMsjMarca=[];

    if(nombre == null){
        errorMostrarMsjMarca.push("(*)El nombre de la marca no puede estar vacio");
    }else if (!validInput(nombre)){
        errorMostrarMsjMarca.push("(*)El nombre de la marca no tiene el formato correcto");
    }
    if(descripcion == null){
        errorMostrarMsjMarca.push("(*)La descripcion de la marca no puede estar vacia");
    }else if (!validInput(descripcion)){
        errorMostrarMsjMarca.push("(*)La descripcion de la marca no tiene el formato correcto");
    }

    return errorMostrarMsjMarca;

}

function validInput(input) {
    var re = /^[a-zA-Z ]{2,50}$/;
    return re.test(input);
}