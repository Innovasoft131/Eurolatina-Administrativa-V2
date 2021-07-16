
var nombrePieza;
var arrogloPedidos = [];
$(document).on("click", ".btnMostrarPedido", function(){

    var cliente = $(this).attr("cliente");
    var idPedido = $(this).attr("idPedido");
    var idCliente = $(this).attr("idCliente");
    var fechaPedido = $(this).attr("fechaPedido");
    $("#mostrarPedidopdf").attr("data","ajax/pedidos.pdf.php?idPedido="+idPedido+"&cliente="+cliente+"&fechaPedido="+fechaPedido+"&idCliente="+idCliente);
});

$(document).on("click", ".btnMostrarPedidoInicio", function(){

	var cliente = $(this).attr("cliente");
    var idPedido = $(this).attr("idPedido");
	var idCliente = $(this).attr("idCliente");
	var fechaPedido = $(this).attr("fechaPedido");
	var fechaTermino = $(this).attr("fechaTermino");

    $("#mostrarPedidopdfInicio").attr("data","ajax/pedidosInicio.pdf.php?idPedido="+idPedido+"&cliente="+cliente+"&idCliente="+idCliente+"&fechaPedido="+fechaPedido+"&fechaTermino="+fechaTermino);
});



$(document).on("click", ".btngenerarPedido", function(){
    var datos = new FormData();
	datos.append("mostarPiezas", "");
    $("#piezaPedido").html("");
	mostrarClientes();
    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#piezaPedido").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#piezaPedido").append('<option " value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
                
            }
          
		}

	});
});

function mostrarClientes(){
	var datos = new FormData();
	datos.append("mostarClinetes", "");
	$.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

			
            $("#clientePedido").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#clientePedido").append('<option " value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
                
            }
			
          
		}

	});
}


// mostrar modelo
$(document).on("change", "#piezaPedido", function(){
    var idModeloPedido = $(this).val();
	nombrePieza = this.options[this.selectedIndex].text;

    datos = new FormData();
    datos.append("idModeloPedido", idModeloPedido); 
    
    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
    
//            $("#idModeloPedido").val(respuesta[0]["idModelo"]);
//            $("#modeloPedido").val(respuesta[0]["modelo"]);
            
          
		}

	});
    
});
// mostrar Colores
$(document).on("change", "#piezaPedido", function(){
    var idPiezaPedido = $(this).val();

    datos = new FormData();
    datos.append("mostrarColores", ""); 
    datos.append("idPiezaPedido", idPiezaPedido); 
    $("#ColorPedido").html('');
    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#ColorPedido").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#ColorPedido").append('<option  value="'+respuesta[i]["idColorPieza"]+'">'+respuesta[i]["color"]+'</option>');
                
            }
            
          
		}

	});
    
});


// mostrar tallas
$(document).on("change", "#piezaPedido", function(){
    var idPiezaPedido = $(this).val();

    datos = new FormData();
    datos.append("mostrarTalla", ""); 
    datos.append("idPiezaPedido", idPiezaPedido); 
    $("#TallasPedido").html('');
    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            
            $("#TallasPedido").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#TallasPedido").append('<option  value="'+respuesta[i]["idPiezaTalla"]+'">'+respuesta[i]["talla"]+'</option>');
                
            }
            
          
		}

	});
    
});
let index = 0;
var arrogloPedidos2 = [];
$(document).on("click", ".btnagregarPedidos", function(){
	var idPieza = $("#piezaPedido").val();
	var idModelo = $("#idModeloPedido").val();
	var nombreModelo = $("#modeloPedido").val();
	var idColor = $("#ColorPedido").val();
	var nombreColor = document.getElementById("ColorPedido");
	var colorSelect = nombreColor.options[nombreColor.selectedIndex].text;
	var idTalla = $("#TallasPedido").val();
	var nombreTalla = document.getElementById("TallasPedido");
	var tallaSelect = nombreTalla.options[nombreTalla.selectedIndex].text;
	var cantidad = $("#cantidadPedidos").val();

	var pieza;
	var modelo;
	var color;
	var talla;
	var cantidad;
	var accion;
	var fila;

	if(idPieza === "" || idPieza === null){
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Selecciona una pieza, el campo no puede ir vacío.!',
			footer: ''
		});
	}else{

			if(idColor == ""){
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Selecciona un color, el campo no puede ir vacío.!',
					footer: ''
				});
			}else{
				if(idTalla == ""){
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Selecciona una talla, el campo no puede ir vacío.!',
						footer: ''
					});
				}else{
					if(cantidad == ""){
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'El campo de cantidad no puede ir vacío.!',
							footer: ''
						});
					}else{

						arrogloPedidos2.push({
							"idPieza": idPieza,
							"pieza"  : nombrePieza,
							"idModelo": idModelo,
							"modelo" : nombreModelo,
							"idColor": idColor,
							"color" : colorSelect,
							"talla" : tallaSelect,
							"idTalla": idTalla,
							"cantidad": cantidad
						});
						$("#tbGenerarPedido tbody").html("");
						for (let x = 0; x < arrogloPedidos2.length; x++) {
							pieza = '<td>'+arrogloPedidos2[x]["pieza"]+'</td>';
						//	modelo= '<td>'+arrogloPedidos2[x]["modelo"]+'</td>';
							color = '<td>'+arrogloPedidos2[x]["color"]+'</td>';
							talla = '<td>'+arrogloPedidos2[x]["talla"]+'</td>';
							cantidad = '<td>'+arrogloPedidos2[x]["cantidad"]+'</td>';
							accion = '<td><button type="button" objeto = "'+x+'"  class="btn btn-info btnQuitarPedidoGenerado" ><i class="fas fa-trash"></i></button></td>';;

							fila += '<tr>';
							fila += pieza;
						//	fila += modelo;
							fila += color;
							fila += talla;
							fila += cantidad;
							fila += accion;
							fila += '</tr>';
							
						}
						


						$("#tbGenerarPedido tbody").append(fila);
						/*
						$("#cantidadPedidos").val("");
						$("#ColorPedido").html("");
						$("#modeloPedido").val("");
						$("#TallasPedido").html("");
						*/

					}
					
				}
				
				
			}


		
	}
});

$(document).on("click", ".btnQuitarPedidoGenerado", function(){
	var num_pedido =  $(this).closest("tr");
	var index = $(this).attr("objeto");
	Swal.fire({
        title: '¿Está seguro de borrar el pedido?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar pedido!'
      }).then(function(result){
		if(result.value){
			num_pedido.remove();
			eliminarArrayPedido(arrogloPedidos2, index);
		}
	  });
});



function eliminarArrayPedido(array, buscar) {
	array.splice(buscar, 1);
//	console.log(array);
	/*
    for (let i = 0; i < array.length; i++) {
        if(array[i]["index"] == buscar){
			array.splice(i, 6);
   
        }
        
    }
	*/

}

$(document).on("click", ".guardarPedido", function(){
	datosJson =	JSON.stringify(arrogloPedidos2);
	var nombreCliente = document.getElementById("TallasPedido");
	var clienteSelect = nombreCliente.options[nombreCliente.selectedIndex].text;
	var idCliente = $("#clientePedido").val();
	var datos = new FormData();
	datos.append("guardarPedido", "");
	datos.append("datosPedido", datosJson);
	datos.append("cliente", clienteSelect);
	datos.append("idCliente", idCliente);

	if(arrogloPedidos2 == ""){
		Swal.fire(
			'No ha agregado el pedido',
			'',
			'error'
		  );
	}else{
		if(idCliente == ""){
			Swal.fire(
				'Seleccione un cliente',
				'',
				'error'
			  );
		}else{
			$.ajax({

				url:"ajax/pedidos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta){
					if(respuesta == "ok"){
						Swal.fire({
							title: '¡El pedido ha sido guardad0 correctamente!',
							text: "",
							icon: 'success',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							//  cancelButtonColor: '#d33',
							//  cancelButtonText: 'Cancelar',
							//  confirmButtonText: 'Si, borrar pedido!'
						  }).then(function(result){
							if(result.value){
								$("#tbGenerarPedido").html("");
								$("#cantidadPedidos").val("");
								$("#ColorPedido").html("");
								$("#modeloPedido").val("");
								$("#TallasPedido").html("");
								window.location = "pedidos";
							}
						  });


		
					}
		
				}
		
			});

		}
	}


	
	

	
});


$(document).on("click", ".cerrarPdfPedido", function(){
	window.location = "pedidos";
});


$(document).on("click", ".cerrarPdfPedidoInicio", function(){
	window.location = "inicio";
});