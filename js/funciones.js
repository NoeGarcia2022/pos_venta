// Esta función valida si hay campos vacíos en un formulario
function validarFormVacio(formulario) {
    // Serializamos los datos del formulario
    datos = $('#' + formulario).serialize();
    // Dividimos los datos en pares clave-valor
    d = datos.split('&');
    // Variable para contar los campos vacíos
    vacios = 0;
    // Iteramos a través de los datos
    for (i = 0; i < d.length; i++) {
        // Dividimos el par clave-valor
        controles = d[i].split("=");
        // Verificamos si el valor es "A" o está vacío
        if (controles[1] == "A" || controles[1] == "") {
            // Incrementamos el contador de campos vacíos
            vacios++;
        }
    }
    // Devolvemos la cantidad de campos vacíos
    return vacios;
}
