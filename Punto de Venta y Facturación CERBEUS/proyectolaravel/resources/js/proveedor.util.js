exports.validarProveedor = function(nombre,tipo_documento, num_documento, telefono, email, direccion){

    var errorProveedor=0;
    var errorMostrarMsjProveedor =[];

    if (nombre == null){ errorMostrarMsjProveedor.push("(*)El nombre del proveedor no puede estar vacío.");
    }else if  (!validInputAlpha(nombre)){
        errorMostrarMsjProveedor.push("(*)El nombre del proveedor no tiene el formato correcto");

    }
    
    if (tipo_documento == 'RTN'){
        if  (num_documento ==null){
        errorMostrarMsjProveedor.push("(*)El numero del documento del proveedor no puede estar vacío.");
        }else if(!validarInputRTN(num_documento)){
            errorMostrarMsjProveedor.push("(*)El numero del rtn del proveedor no tiene el formato correcto");
        }
    
    }if (tipo_documento == 'IDENTIDAD'){
        if  (num_documento ==null){
            errorMostrarMsjProveedor.push("(*)El numero del documento del proveedor no puede estar vacío.");
        }else if(!validarInputIDENTIDAD(num_documento)){
            errorMostrarMsjProveedor.push("(*)El numero de la identidad del proveedor no tiene el formato correcto");
        }
    }
    if (tipo_documento == 'PASAPORTE'){
        if  (num_documento ==null){
            errorMostrarMsjProveedor.push("(*)El numero del documento del proveedor no puede estar vacío.");
        }
    }

    if (telefono == null){errorMostrarMsjProveedor.push("(*)El telefono del proveedor no puede estar vacío.");
    }else if  (!validarInputTelefono(telefono)){
        errorMostrarMsjProveedor.push("(*)El numero de telefono del proveedor no tiene el formato correcto");
    }
    if (email == null){errorMostrarMsjProveedor.push("(*)El email del proveedor no puede estar vacío.");
    }else if  (!validarInputEmail(email)){
        errorMostrarMsjProveedor.push("(*)El email del proveedor no tiene el formato correcto");

    }
    if (direccion == null){errorMostrarMsjProveedor.push("(*)La dirección del proveedor no puede estar vacío.");
    }
    if(errorMostrarMsjProveedor.length >= 1){
        errorProveedor = 1;
    }

    return errorProveedor;
    }

    exports.erroresProveedor = function(nombre,tipo_documento, num_documento, telefono, email, direccion){

        var errorProveedor=0;
        var errorMostrarMsjProveedor =[];
    
        if (nombre == null){ errorMostrarMsjProveedor.push("(*)El nombre del proveedor no puede estar vacío.");
        }else if  (!validInputAlpha(nombre)){
            errorMostrarMsjProveedor.push("(*)El nombre del proveedor no tiene el formato correcto");
    
        }
        
        if (tipo_documento == 'RTN'){
            if  (num_documento ==null){
            errorMostrarMsjProveedor.push("(*)El numero del documento del proveedor no puede estar vacío.");
            }else if(!validarInputRTN(num_documento)){
                errorMostrarMsjProveedor.push("(*)El numero del rtn del proveedor no tiene el formato correcto");
            }
        
        }if (tipo_documento == 'IDENTIDAD'){
            if  (num_documento ==null){
                errorMostrarMsjProveedor.push("(*)El numero del documento del proveedor no puede estar vacío.");
            }else if(!validarInputIDENTIDAD(num_documento)){
                errorMostrarMsjProveedor.push("(*)El numero de la identidad del proveedor no tiene el formato correcto");
            }
        }
        if (tipo_documento == 'PASAPORTE'){
            if  (num_documento ==null){
                errorMostrarMsjProveedor.push("(*)El numero del documento del proveedor no puede estar vacío.");
            }
        }
        if (telefono == null){errorMostrarMsjProveedor.push("(*)El telefono del proveedor no puede estar vacío.");
        }else if  (!validarInputTelefono(telefono)){
            errorMostrarMsjProveedor.push("(*)El numero de telefono del proveedor no tiene el formato correcto");
        }
        if (email == null){errorMostrarMsjProveedor.push("(*)El email del proveedor no puede estar vacío.");
        }else if  (!validarInputEmail(email)){
            errorMostrarMsjProveedor.push("(*)El email del proveedor no tiene el formato correcto");
    
        }
        if (direccion == null){errorMostrarMsjProveedor.push("(*)La dirección del proveedor no puede estar vacío.");
        }
    
        return errorMostrarMsjProveedor;
        }

    function validInputAlpha(input) {
    var re = /^[a-zA-Z ]{2,50}$/;
    return re.test(input);
    }

    function validInputInteger(input) {
    var re = /^[1-9][0-9]*$/;
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
