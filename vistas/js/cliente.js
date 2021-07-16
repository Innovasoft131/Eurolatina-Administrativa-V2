/*=============================================
SUBIENDO LA FOTO DEL USUARIO
=============================================*/

$("#nuevaFoto").change(function() {
    var imagen = this.files[0];

    /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

        $("#nuevaFoto").val("");

        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else if (imagen["size"] > 2000000) {

        $("#nuevaFoto").val("");

        Swal.fire({
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!",
            icon: "error",
            confirmButtonText: "¡Cerrar!"
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event) {

            var rutaImagen = event.target.result;

            $("#previsualizar").attr("src", rutaImagen);

        });

    }
});


/*=============================================
EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarCliente", function() {

    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#id").val(respuesta["id"]);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPassword").html(respuesta["password"]);
            $("#fotoActual").val(respuesta["foto"]);
            $("#editarCorreo").val(respuesta["correo"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").html(respuesta["direccion"]);

            if (respuesta["foto"] != "") {

                $(".previsualizar").attr("src", respuesta["foto"]);

            }

        }

    });

});
/*=============================================
ELIMINAR USUARIO
=============================================*/
$(document).on("click", ".btnEliminarCliente", function() {

    var idCliente = $(this).attr("idCliente");
    var fotoCliente = $(this).attr("fotoCliente");
    var usuario = $(this).attr("usuario");

    Swal.fire({
        title: '¿Está seguro de borrar el cliente?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
    }).then(function(result) {

        if (result.value) {

            window.location = "index.php?ruta=clientes&idCliente=" + idCliente + "&usuario=" + usuario + "&fotoCliente=" + fotoCliente;

        }

    });

});