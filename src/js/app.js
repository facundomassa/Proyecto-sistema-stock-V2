$(document).ready(function () {
    const menu = $("#boton_menu");
    const navegador = $(".navegador");
    const main = $(".main");

    //funcion de las tabla de datos
    $('.table').DataTable();

    //menu derecho
    if(menu.length && navegador.length){
        menu.click(function(){
            menuVer();
        })
        $(window).click(e=>{
            if(navegador.hasClass("show") && e.target.className != "navegador show" && e.target.id != "boton_menu"){
                menuVer();
            }
        })
    }
    function menuVer(){
        navegador.toggleClass("show");
        main.toggleClass("show");
    }

    //remito
    const remitoBtn = $("#remito");
    const materialesBtn = $("#materiales");
    const conteniroRe = $(".contenido-remito")

    remitoBtn.click(function(){
        const idRe = remitoBtn.attr("data-id");
        $.ajax({
            type: "get",
            url: "/Remito/verAjax",
            data: { id: idRe},
            success: function (response) {
                let respuesta = response;
                respuesta = JSON.parse(respuesta);
                conteniroRe.empty().append(`<div class="content">
                <p>Numero de remito: <span>${respuesta.Remito.id_remito}</span></p>
            </div>
            <div class="content">
                <p>Origen: ${respuesta.Origen.nombre_cs}</span></p>
                <p>Direccion: <span>${respuesta.Origen.direccion}</span></p>
            </div>
            <div class="content">
                <p>Destino: ${respuesta.Destino.nombre_cs}</span></p>
                <p>Direccion: <span>${respuesta.Destino.direccion}</span></p>
            </div>
            <div class="content">
                <p>Fecha de creaccion: <span>${respuesta.Remito.fecha_creacion}</span></p>
                <p>Fecha de finalizado: <span>${respuesta.Remito.fecha_finalizado}</span></p>
                <p>Creado por: ${respuesta.Usuarios.nombre}</span></p>
            </div>
            <div class="content">
                <p>Estado del remito: ${respuesta.Estado.estado}</span></p>
            </div>`);
                // console.log(respuesta.Origen.id_centros_stock);
                remitoBtn.addClass("selected");
                materialesBtn.removeClass("selected");
            }
        });
    })

    materialesBtn.click(function(){
        const idRe = remitoBtn.attr("data-id");
        $.ajax({
            type: "get",
            url: "/Remito/verMateriales",
            data: { id: idRe},
            success: function (response) {
                let respuesta = response;
                respuesta = JSON.parse(respuesta);
                conteniroRe.empty().append(`
                <table class="table">
                <thead>
                    <tr>
                        <th>COD. MATERIAL</th>
                        <th>MATERIAL</th>
                        <th>CANTIDAD</th>
                        <th>ACCIONES</th>
                    </tr> 
                </thead>
               
                <tbody class="tabla-cuerpo">
                    `);
                    // $.each(respuesta.MovimientoMateriales, function (e) { console.log(respuesta.Materiales[e])});
                    $.each(respuesta.MovimientoMateriales, function (mo){
                        let MovimientoMateriale = respuesta.MovimientoMateriales[mo]
                        console.log(MovimientoMateriale.material_id);
                        $.each(respuesta.Materiales, function (ma) { 
                            console.log(respuesta.Materiales[ma].id_materiales);
                            console.log(MovimientoMateriale.material_id);
                            // console.log(MovimientoMateriale)
                            if(respuesta.Materiales[ma].id_materiales == MovimientoMateriale.material_id){
                            $(".tabla-cuerpo").append(`
                            <tr>
                                <td>${respuesta.Materiales[ma].codigo}</td>
                                <td>${respuesta.Materiales[ma].descripcion}</td>
                                <td>${MovimientoMateriale.cantidad}</td>
                                <td>
                                </td>
                            </tr>
                            `)};
                        });
                    });
                    conteniroRe.children(".tabla-cuerpo").append(
                    `
                </tbody>
            </table>      
                `);
                materialesBtn.addClass("selected");
                remitoBtn.removeClass("selected");
            }
        });
    })
});