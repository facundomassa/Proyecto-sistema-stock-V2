$(document).ready(function () {
    const origenBTN = $("#origen_id");
    const destinoBTN = $("#destino_id");

    origenBTN.change(function(){
        obtenerOrigen();
    });

    destinoBTN.change(function(){
        obtenerDestino();
    });

    function obtenerOrigen(){
        if(origenBTN.val()){
            const idRe = origenBTN.val();
            $.ajax({
                type: "get",
                url: "/CentroStock/buscarID",
                data: { id: idRe},
                success: function (response) {
                    let respuesta = response;
                    respuesta = JSON.parse(respuesta);
                    $("#origen_no").text(respuesta.CentrosStock.remitente_nombre + " " + respuesta.CentrosStock.remitente_apellido);
                    $("#origen_te").text(respuesta.CentrosStock.telefono);
                    $("#origen_pr").text(respuesta.CentrosStock.provincia);
                    $("#origen_ci").text(respuesta.CentrosStock.ciudad);
                    $("#origen_di").text(respuesta.CentrosStock.direccion);
                    $("#origen_ti").text(respuesta.TipoCentroStock.tipo);
                }
            });
        }
    }

    function obtenerDestino(){
        if(destinoBTN.val()){
            const idRe = destinoBTN.val();
            $.ajax({
                type: "get",
                url: "/CentroStock/buscarID",
                data: { id: idRe},
                success: function (response) {
                    let respuesta = response;
                    respuesta = JSON.parse(respuesta);
                    $("#destino_no").text(respuesta.CentrosStock.remitente_nombre + " " + respuesta.CentrosStock.remitente_apellido);
                    $("#destino_te").text(respuesta.CentrosStock.telefono);
                    $("#destino_pr").text(respuesta.CentrosStock.provincia);
                    $("#destino_ci").text(respuesta.CentrosStock.ciudad);
                    $("#destino_di").text(respuesta.CentrosStock.direccion);
                    $("#destino_ti").text(respuesta.TipoCentroStock.tipo);
                }
            });
        }
    }

    window.onload = obtenerOrigen();
    window.onload = obtenerDestino();
});