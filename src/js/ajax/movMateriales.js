function EliminarMaterial(e){
    // e.preventDefault();
    const check = $(e).siblings("#eliminarChek");
    console.log(check.prop("checked"));
    if(check.prop("checked")){
        check.parent().parent().removeClass("a_eliminar");
        check.prop('checked', false);
    } else {
        check.prop('checked', true);
        check.parent().parent().addClass("a_eliminar");
    }
}

$(document).ready(function () {
    const agregarBtn = $("#agregarMat");
    const agregarlosBtn = $("#agregarlosMat");
    const ayudaBtn = $("#ayuda");
    const todosMateriales = $("#todosMateriales");

    agregarBtn.click(function(e){
        e.preventDefault();
        ayudaBtn.removeClass("hidden");
    });

    
    //funciion para obtener los get
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
        todosMateriales.find("input:checkbox:checked").each(function(){
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
                        <td>
                        <input type="button" value="Eliminar" class="eliminarMaterial" onclick="EliminarMaterial(this);">
                            <input type="checkbox" name="MovimientoMateriales[eliminar]" id="eliminarChek" value="">
                        </td>
                    </tr>
                    `);
                }
            }).promise().done(function () {
                todosMateriales.find("input:checkbox:checked").prop('checked', false);
            });
        });
    })

    $("#enviarMateriales").click(function(e){
        e.preventDefault();
        let totalCantidad = 0;
        let cantidadCorrecta = 0;
        const remito_id = getParameterByName('id');
        $("#tablaMateriales").find("tr").each(function(){
            const id_movimiento_materiales = $(this).find("#MovimientoMateriales").val();            
            const material_id = $(this).find(".valor").text();
            const cantidad = $(this).find("#cantidad").val();
            const eliminar = $(this).find("#eliminarChek").prop('checked');
            const form = {"MovimientoMateriales" : {"id_movimiento_materiales" : id_movimiento_materiales, "remito_id" : remito_id,"material_id": material_id, "cantidad": cantidad}};
            totalCantidad ++;
            if(eliminar){
                $.ajax({
                    type: "post",
                    url: "/MovimientoMateriales/eliminar",
                    data: {"id" : id_movimiento_materiales},
                    async: false,
                    success: function (response) {
                        if(response == "CORRECTO"){
                            cantidadCorrecta ++;
                            console.log(cantidadCorrecta);
                        }
                    }
                })
            } else {
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
            }
        }).promise().done(function () {
            window.location = `/MovimientoMateriales/Crear?id=${remito_id}&valC=${cantidadCorrecta}&valT=${cantidadCorrecta}`;
        });
    })
});
