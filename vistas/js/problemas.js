
$(document).on("click", ".btnEditarProblema", function(){
    var idProblema = $(this).attr('idproblema');
    var datos = new FormData();
	datos.append("idProblema", idProblema);

    $.ajax({

		url:"ajax/problemas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#editarProblema").val(respuesta["nombre"]);
            $("#idProblema").val(respuesta["id"]);

		}

	});
});

$(document).on("click", ".btnEliminarProblema", function(){
    var idProblema = $(this).attr('idproblema');


    Swal.fire({
        title: '¿Está seguro de borrar el problema?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar problema!'
      }).then(function(result){
    
        if(result.value){
    
          window.location = "index.php?ruta=problemas&idproblema="+idProblema;
    
        }
    
      });
});


$(document).on("click", ".btnMostrarReporteProblemas", function(){


  var idPedido = $(this).attr("idPedido");
  var id = $(this).attr("id");

  $("#mostrarReporteProblemasPdf").attr("data","ajax/reporteProblemas.pdf.php?idPedido="+idPedido+"&id="+id);
});


$(document).on("click", ".cerrarPdftablaProblemas", function(){
	window.location = "reporteErrores";
});
