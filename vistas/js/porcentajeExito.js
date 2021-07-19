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

/*=============================================
REVISAR SI LA UNIDAD YA ESTÁ REGISTRADO DURANTA EL INSERT
=============================================*/

$(document).on("keyup", "#etapa", function(){
	$(".alert").remove();
	
	var unidad = $(this).val();

	var datos = new FormData();
	datos.append("validarPorcentaje", unidad);

	 $.ajax({
	    url:"ajax/porcentajeExito.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#etapa").parent().after('<div class="alert alert-warning">Esta Etapa ya existe en la base de datos</div>');

	    		$("#etapa").val("");
	    	}
	    }
	});
});

/*=============================================
REVISAR SI LA UNIDAD YA ESTÁ REGISTRADO DURANTA EL UPDATE
=============================================*/

$(document).on("keyup", "#editaretapa", function(){
	$(".alert").remove();
	
	var unidad = $(this).val();

	var datos = new FormData();
	datos.append("validarPorcentaje", unidad);

	 $.ajax({
	    url:"ajax/porcentajeExito.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#editaretapa").parent().after('<div class="alert alert-warning">Esta Etapa ya existe en la base de datos</div>');

	    		$("#editaretapa").val("");

	    	}

	    }

	});
});

