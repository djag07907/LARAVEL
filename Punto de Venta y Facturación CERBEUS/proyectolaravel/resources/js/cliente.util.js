exports.validarCliente = function(nombre,tipo_documento, num_documento, telefono, email, direccion){

    var errorCliente=0;
    var errorMostrarMsjCliente =[];

    if (nombre == null){ errorMostrarMsjCliente.push("(*)El nombre del cliente no puede estar vacío.");
    }else if  (!validInputAlpha(nombre)){
        errorMostrarMsjCliente.push("(*)El nombre del cliente no tiene el formato correcto");

    } 
    if (tipo_documento == 'RTN'){
        if  (num_documento == null){
        errorMostrarMsjProveedor.push("(*)El numero del documento del cliente no puede estar vacío.");
        }else if(!validarInputRTN(num_documento)){
            errorMostrarMsjProveedor.push("(*)El numero del rtn del cliente no tiene el formato correcto");
        }
    
    }if (tipo_documento == 'IDENTIDAD'){
        if  (num_documento == null){
            errorMostrarMsjProveedor.push("(*)El numero del documento del cliente no puede estar vacío.");
        }else if(!validarInputIDENTIDAD(num_documento)){
            errorMostrarMsjProveedor.push("(*)El numero de la identidad del cliente no tiene el formato correcto");
        }
    }
    if (tipo_documento == 'PASAPORTE'){
        if  (num_documento == null){
            errorMostrarMsjProveedor.push("(*)El numero del documento del cliente no puede estar vacío.");
        }
    }

    if (telefono == null){errorMostrarMsjCliente.push("(*)El telefono del cliente no puede estar vacío.");
    }else if  (!validarInputTelefono(telefono)){
        errorMostrarMsjCliente.push("(*)El numero de telefono del cliente no tiene el formato correcto");

    }
    if (email == null){errorMostrarMsjCliente.push("(*)El email del cliente no puede estar vacío.");
    }else if  (!validarInputEmail(email)){
        errorMostrarMsjCliente.push("(*)El email del cliente no tiene el formato correcto");

    }
    if (direccion == null){errorMostrarMsjCliente.push("(*)La dirección del cliente no puede estar vacío.");
    }
    
    if(errorMostrarMsjCliente.length >= 1){
        errorCliente = 1;
    }

    return errorCliente;
}

exports.erroresCliente = function(nombre,tipo_documento, num_documento, telefono, email, direccion){

    var errorCliente=0;
    var errorMostrarMsjCliente =[];

    if (nombre == null){ errorMostrarMsjCliente.push("(*)El nombre del cliente no puede estar vacío.");
    }else if  (!validInputAlpha(nombre)){
        errorMostrarMsjCliente.push("(*)El nombre del cliente no tiene el formato correcto");

    } 
    if (tipo_documento == 'RTN'){
        if  (num_documento == null){
        errorMostrarMsjProveedor.push("(*)El numero del documento del cliente no puede estar vacío.");
        }else if(!validarInputRTN(num_documento)){
            errorMostrarMsjProveedor.push("(*)El numero del rtn del cliente no tiene el formato correcto");
        }
    
    }if (tipo_documento == 'IDENTIDAD'){
        if  (num_documento == null){
            errorMostrarMsjProveedor.push("(*)El numero del documento del cliente no puede estar vacío.");
        }else if(!validarInputIDENTIDAD(num_documento)){
            errorMostrarMsjProveedor.push("(*)El numero de la identidad del cliente no tiene el formato correcto");
        }
    }
    if (tipo_documento == 'PASAPORTE'){
        if  (num_documento == null){
            errorMostrarMsjProveedor.push("(*)El numero del documento del cliente no puede estar vacío.");
        }
    }

    if (telefono == null){errorMostrarMsjCliente.push("(*)El telefono del cliente no puede estar vacío.");
    }else if  (!validarInputTelefono(telefono)){
        errorMostrarMsjCliente.push("(*)El numero de telefono del cliente no tiene el formato correcto");

    }
    if (email == null){errorMostrarMsjCliente.push("(*)El email del cliente no puede estar vacío.");
    }else if  (!validarInputEmail(email)){
        errorMostrarMsjCliente.push("(*)El email del cliente no tiene el formato correcto");

    }
    if (direccion == null){errorMostrarMsjCliente.push("(*)La dirección del cliente no puede estar vacío.");
    }

    return errorMostrarMsjCliente;
}

function validInputAlpha(input) {
    var re = /^[a-zA-Z ]{2,50}$/;
    return re.test(input);
}

function validarInputEmail(input){
    var re = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    return re.test(input);
}
function validarInputTelefono(input){
    var re = /^[2|3|7|8|9]{1}[\d]{7}$/;
    return re.test(input);

}
function validarInputRTN(input){
    var re = /[0|1]{1}[\d]{13}$/;
    return re.test(input);

}
function validarInputIDENTIDAD(input){
    var re = /[0|1]{1}[\d]{12}$/;
    return re.test(input);

}

