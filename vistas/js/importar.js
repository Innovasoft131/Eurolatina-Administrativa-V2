$(document).on("click", ".btnImportPedidos", function(){
    console.log("hola");
    window.open("importarPedido");
});

$(document).on("click", ".btnimportaPedidoExc", function(){
    var datos = new FormData();
    datos.append("excel",$("#flImportPedido")[0]);

    
    $.ajax({

		url:"ajax/importarPedidos.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            alert(respuesta);
          
		}

	});
});