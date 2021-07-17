$(document).on("click", ".btnEditaridEstado", function(){
    var idEstado = $(this).attr('idEstado');
    var datos = new FormData();
	datos.append("idEstado", idEstado);

    $.ajax({

		url:"ajax/estado.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#editarEstado").val(respuesta["estado"]);
            $("#idEstado").val(respuesta["id"]);

		}

	});
});


$(document).on("click", ".btnEliminaridEstado", function(){
    var idEstado = $(this).attr('idEstado');


    Swal.fire({
        title: '¿Está seguro de borrar el estado?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar estado!'
      }).then(function(result){
    
        if(result.value){
    
          window.location = "index.php?ruta=estado&idEstado="+idEstado;
    
        }
    
      });
});


/*=============================================
REVISAR SI EL ESTADO YA ESTÁ REGISTRADO DURANTA EL INSERT
=============================================*/

$(document).on("keyup", "#nuevoEstado", function(){
	$(".alert").remove();
	
	var estado = $(this).val();

	var datos = new FormData();
	datos.append("validarEstado", estado);

	 $.ajax({
	    url:"ajax/estado.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoEstado").parent().after('<div class="alert alert-warning">Este estado ya existe en la base de datos</div>');

	    		$("#nuevoEstado").val("");

	    	}

	    }

	});
});

/*=============================================
REVISAR SI EL ESTADO YA ESTÁ REGISTRADO DURANTA EL UPDATE
=============================================*/

$(document).on("keyup", "#editarEstado", function(){
	$(".alert").remove();
	
	var estado = $(this).val();

	var datos = new FormData();
	datos.append("validarEstado", estado);

	 $.ajax({
	    url:"ajax/estado.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#editarEstado").parent().after('<div class="alert alert-warning">Este estado ya existe en la base de datos</div>');

	    		$("#editarEstado").val("");

	    	}

	    }

	});
});