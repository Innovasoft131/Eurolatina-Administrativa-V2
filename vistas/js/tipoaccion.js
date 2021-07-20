$(document).on("click", ".btnEditaridUnidad", function(){
    var idUnidad = $(this).attr('idAccion');
    var datos = new FormData();
	datos.append("idAccion", idUnidad);

    $.ajax({
		url:"ajax/tipoaccion.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#editarAccion").val(respuesta["accion"]);
            $("#idAccion").val(respuesta["id"]);
		}

	});
});


$(document).on("click", ".btnEliminaridUnidad", function(){
    var idUnidad = $(this).attr('idUnidad');


    Swal.fire({
        title: '¿Está seguro de borrar la unidad?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar unidad!'
      }).then(function(result){
    
        if(result.value){
    
          window.location = "index.php?ruta=unidad&idUnidad="+idUnidad;
    
        }
    
      });
});


/*=============================================
REVISAR SI LA UNIDAD YA ESTÁ REGISTRADO DURANTA EL INSERT
=============================================*/

$(document).on("keyup", "#nuevaUnidad", function(){
	$(".alert").remove();
	
	var unidad = $(this).val();

	var datos = new FormData();
	datos.append("validarUnidad", unidad);

	 $.ajax({
	    url:"ajax/unidad.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevaUnidad").parent().after('<div class="alert alert-warning">Esta unidad ya existe en la base de datos</div>');

	    		$("#nuevaUnidad").val("");

	    	}

	    }

	});
});

/*=============================================
REVISAR SI LA UNIDAD YA ESTÁ REGISTRADO DURANTA EL UPDATE
=============================================*/

$(document).on("keyup", "#editarUnidad", function(){
	$(".alert").remove();
	
	var unidad = $(this).val();

	var datos = new FormData();
	datos.append("validarUnidad", unidad);

	 $.ajax({
	    url:"ajax/unidad.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#editarUnidad").parent().after('<div class="alert alert-warning">Esta unidad ya existe en la base de datos</div>');

	    		$("#editarUnidad").val("");

	    	}

	    }

	});
});