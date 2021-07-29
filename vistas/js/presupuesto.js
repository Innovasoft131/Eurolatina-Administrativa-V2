$(document).on("click", ".btnEditaridUnidad", function(){
    var idUnidad = $(this).attr('idUnidad');
    var datos = new FormData();
	datos.append("idUnidad", idUnidad);

    $.ajax({
		url:"ajax/unidad.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#editarUnidad").val(respuesta["unidad"]);
            $("#idUnidad").val(respuesta["id"]);
		}

	});
});
