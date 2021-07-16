$(document).on("click", ".guardarLinea", function(){
    var linea = $("#nuevaLinea").val();
	
	var datos = new FormData();
    datos.append("guardarLinea", "");
	datos.append("linea", linea);

	$.ajax({

		url:"ajax/lineas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            if(respuesta == "ok"){
                Swal.fire({
                    title: '¡La Línea ha sido guardada correctamente!',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    //  cancelButtonColor: '#d33',
                    //  cancelButtonText: 'Cancelar',
                    //  confirmButtonText: 'Si, borrar Categoría!'
                  }).then(function(result){
                    if(result.value){
                        window.location = "lineas";
                    }
                  });
            }else if(respuesta == "encontrada"){
                Swal.fire('Línea ya se encuentra registrada','', 'success');
                $("#nuevaLinea").val();
            }else if(respuesta == "datosIncorrectos"){
                Swal.fire('La Línea no puede ir vacía o llevar caracteres especiales');
            }
		}

	});
});

$(document).on("click", ".btnEliminarLinea", function(){

    var id = $(this).attr("id");
  
    Swal.fire({
      title: '¿Está seguro de borrar la Línea?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Línea!'
    }).then(function(result){
  
      if(result.value){
        var datos = new FormData();
        datos.append("eliminarLinea", "");
        datos.append("idLinea", id);
    
        $.ajax({
    
            url:"ajax/lineas.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta == "ok"){
                    Swal.fire({
                        title: '¡La Línea ha sido eliminada correctamente!',
                        text: "",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        //  cancelButtonColor: '#d33',
                        //  cancelButtonText: 'Línea',
                        //  confirmButtonText: 'Si, borrar Línea!'
                      }).then(function(result){
                        if(result.value){
                            window.location = "lineas";
                        }
                      });
   

                    
                }else if(respuesta == "error"){
                    Swal.fire('Error interno al eliminar Línea');
                }
            }
    
        });
        
  
      }
  
    });
  
});

$(document).on("click", ".btnCodigoQRLinea", function(){
    var id = $(this).attr('id');
    var nombre = $(this).attr('nombreLinea');

    $("#codigosQrLinea").attr("data","ajax/codigoQRLinea.php?id="+id+"&nombre="+nombre);
});

$(document).on("click", ".cerrarQRLinea", function(){
    window.location = "lineas";
});

$(document).on("click", ".btnEditarLinea", function(){
    var id = $(this).attr('id');
    var nombre = $(this).attr('nombre');

    $("#idLinea").val(id);
    $("#editarLinea").val(nombre);
});


$(document).on("click", ".editarLinea", function(){
    var id = $("#idLinea").val();
    var linea = $("#editarLinea").val();
	
	var datos = new FormData();
    datos.append("editarLinea", "");
	datos.append("linea", linea);
    datos.append("id", id);

	$.ajax({

		url:"ajax/lineas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            if(respuesta == "ok"){
                Swal.fire({
                    title: '¡La Línea ha sido editada correctamente!',
                    text: "",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    //  cancelButtonColor: '#d33',
                    //  cancelButtonText: 'Línea',
                    //  confirmButtonText: 'Si, borrar Línea!'
                  }).then(function(result){
                    if(result.value){
                        window.location = "lineas";
                    }
                  });
            }else if(respuesta == "encontrada"){
                Swal.fire('Línea ya se encuentra registrada','', 'success');
                $("#nuevaLinea").val();
            }else if(respuesta == "datosIncorrectos"){
                Swal.fire('La Línea no puede ir vacía o llevar caracteres especiales');
            }
		}

	});
});