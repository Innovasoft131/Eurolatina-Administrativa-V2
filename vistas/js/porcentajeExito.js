$(document).on("click", ".btnEditaridPorcentaje", function(){
	
    var idPorcentaje = $(this).attr('idporcentaje');
	
    var datos = new FormData();
	datos.append("idporcentaje", idPorcentaje);
	
    $.ajax({
		url:"ajax/porcentajeExito.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#editarexito").val(respuesta["exito"]);
            $("#editaretapa").val(respuesta["etapa"]);
			$("#idporcentaje").val(respuesta["id"]);
		}

	});
});

$(document).on("click", ".btnEliminarPorcentaje", function(){
    var idPorcentaje = $(this).attr('idporcentaje');

    Swal.fire({
        title: '¿Está seguro de borrar el porcentaje de exito?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar porcentaje de exito!'
      }).then(function(result){
        if(result.value){
          window.location = "index.php?ruta=porcentajeExito&idporcentaje="+idPorcentaje;
        }
      });
});

