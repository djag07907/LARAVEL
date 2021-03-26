exports.validarUser = function(nombre,usuario,password,idrol){
    var errorUsuario=0;
    var errorMostrarMsjUsuario =[];

    if (nombre == null){
        errorMostrarMsjUsuario.push("(*)El nombre no puede estar vacío.");
    }else if (!validInput(nombre)){
        errorMostrarMsjUsuario.push("(*)El nombre de la categoria no tiene el formato correcto");
    }
    if (usuario == null) {
        errorMostrarMsjUsuario.push("(*)El nombre del usuario no puede estar vacío.");
    }else if (!validInput(usuario)){
        errorMostrarMsjUsuario.push("(*)El nombre de la categoria no tiene el formato correcto");
    }
    if (password == null){
        errorMostrarMsjUsuario.push("(*)El password no puede estar vacío.");
    }else if (!validInputPassword(password)){
        errorMostrarMsjUsuario.push("(*)El nombre de la categoria no tiene el formato correcto");
    }
    if (idrol== null){
        errorMostrarMsjUsuario.push("(*)Debes seleccionar un rol para el usuario.");
    }else if (!validInputInteger(idrol)){
        errorMostrarMsjUsuario.push("(*)El nombre de la categoria no tiene el formato correcto");
    }
    if(errorMostrarMsjUsuario.length >= 1){
        errorUsuario = 1;
    }

    return errorUsuario;
}

exports.erroresUser = function(nombre,usuario,password,idrol){
    var errorUsuario=0;
    var errorMostrarMsjUsuario =[];

    if (nombre == null){errorMostrarMsjUsuario.push("(*)El nombre no puede estar vacío.");
    }else if (!validInput(nombre)){
        errorMostrarMsjUsuario.push("(*)El nombre del usuario no tiene el formato correcto");

    }
    if (usuario == null) {errorMostrarMsjUsuario.push("(*)El usuario no puede estar vacío.");
    }else if (!validInput(usuario)){
        errorMostrarMsjUsuario.push("(*)El usuario no tiene el formato correcto");

    }
    if (password == null){errorMostrarMsjUsuario.push("(*)El password no puede estar vacío.");
    }else if (!validInputPassword(password)){
        errorMostrarMsjUsuario.push("(*)El password no tiene el formato correcto");
    }
    if (idrol== null){
        errorMostrarMsjUsuario.push("(*)Debes seleccionar un rol para el usuario.");
    }

    return errorMostrarMsjUsuario;
}

function validInput(input) {
    var re = /^[a-zA-Z ]{2,50}$/;
    return re.test(input);
}

function validInputInteger(input) {
    var re = /^[1-3][0-3]*$/;
    return re.test(input);

}
function validInputPassword (input){
    var re = /^[A-Za-z0-9]*$/;
    return re.test(input);
}