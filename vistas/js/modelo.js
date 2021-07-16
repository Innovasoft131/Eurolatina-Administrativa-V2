/*=============================================
EDITAR MODELO
=============================================*/
$(document).on("click", ".btnEditarModelo", function() {

    var idModelo = $(this).attr("idModelo");

    var datos = new FormData();
    datos.append("idModelo", idModelo);

    $.ajax({

        url: "ajax/modelos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
        //    console.log(idModelo);
            $("#id").val(idModelo);
            $("#editarNombre").val(respuesta[0]);
            $("#editarDescripcion").val(respuesta[1]);
        }
    });
});


/*=============================================
ELIMINAR Maquina
=============================================*/
$(document).on("click", ".btnEliminarModelo", function() {

    var idModelo = $(this).attr("idModelo");

    Swal.fire({
        title: '¿Está seguro de borrar la maquina?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Modelo!'
    }).then(function(result) {

        if (result.value) {

            window.location = "index.php?ruta=modelo&idModelo=" + idModelo;

        }

    });

});