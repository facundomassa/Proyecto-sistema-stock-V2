$(document).ready(function () {
    const agregarBtn = $("#agregarMat");
    const agregarlosBtn = $("#agregarlosMat");
    const ayudaBtn = $("#ayuda");
    const todosMateriales = $("#todosMateriales");

    agregarBtn.click(function(e){
        e.preventDefault();
        ayudaBtn.removeClass("hidden");
    });

    function getParameterByName(name, url=window.location.href) {
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    agregarlosBtn.click(function(e){
        e.preventDefault();
        ayudaBtn.addClass("hidden");
        
        $("input:checkbox:checked").each(function(){
            const checks = this.value;
            $.ajax({
                type: "get",
                url: "/Materiales/buscar",
                data: {id: checks},
                success: function (response) {
                    let respuesta = response;
                    respuesta = JSON.parse(respuesta);
                    $("#tablaMateriales").append(`
                    <tr>
                        <td class="valor">${respuesta.Materiales.id_materiales}</td>
                        <td>${respuesta.Materiales.codigo}</td>
                        <td>${respuesta.Materiales.descripcion}</td>
                        <td>${respuesta.Unidades.unidad}</td>
                        <td>${respuesta.TipoMaterial.tipo}</td>
                        <td><input type="number" name="MovimientoMateriales[cantidad]" id="cantidad" min="0"></td>
                    </tr>
                    `);
                }
            });
        });
    })

    $("#enviarMateriales").click(function(e){
        e.preventDefault();
        let totalCantidad = 0;
        let cantidadCorrecta = 0;
        $("#tablaMateriales").find("tr").each(function(){
            const id = $(this).find(".valor").text();
            const cantidad = $(this).find("#cantidad").val();
            const remito_id = getParameterByName('id');
            const form = {"MovimientoMateriales" : {"remito_id" : remito_id,"material_id": id, "cantidad": cantidad}};
            totalCantidad ++;
            $.ajax({
                type: "post",
                url: "/MovimientoMateriales/Crear",
                data: form,
                async: false,
                success: function (response) {
                    
                    if(response == "CORRECTO"){
                        cantidadCorrecta ++;
                        console.log(cantidadCorrecta);
                    }
                }
            })
        }).promise().done(function () {
            
         });
    })
});