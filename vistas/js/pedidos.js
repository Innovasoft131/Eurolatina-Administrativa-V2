function autocompletarCliente(){
	
    const inputCliente = document.querySelector("#rpCliente");
    let indexFocus = -1;
    if(inputCliente !== undefined && inputCliente !== null ){
        inputCliente.addEventListener('input', function(){
            const cliente = this.value;
            if(!cliente){ return false;}
            cerrarLista();
            // creando lista de sugerencias 
            const divlist = document.createElement('div');
            divlist.setAttribute('id',this.id + '-lista-autocompletar');
            divlist.setAttribute('class', 'lista-autocompletar-items');
    
            this.parentNode.appendChild(divlist);
    
            // conexión a base de datos 
            httpRequest('ajax/clientes.ajax.php?cliente=' + cliente, function(){
               // console.log(this.responseText);
               const arreglo = JSON.parse(this.responseText);
                // avlidar el input contra el arreglo
				$(".alert").remove();
                if(arreglo.length == 0){ 
					
					$("#rpCliente").parent().after('<div class="alert alert-danger" role="alert">Cliente no encontrado</div>');
					return false;
				}else{
					$(".alert").remove();
					$("#rpCliente").attr("idcliente", arreglo[1]);
				}
				;
                arreglo.forEach(item => {
                    if(item.substr(0, cliente.length).toUpperCase() == cliente.toUpperCase()){
                        const elementoLista = document.createElement('div');
                        elementoLista.innerHTML  = `<strong>${item.substr(0, cliente.length)}</strong>${item.substr(cliente.length)}`;
                
                        
                        
                        
                        elementoLista.addEventListener('click',function(){
                            inputCliente.value = this.innerText;
							
                            obtenerTurno(inputCliente.value);
                            
                            cerrarLista();
                            return false;
                        });
    
                        divlist.appendChild(elementoLista);
                        
                    }

					
                });
    
            });
    
           
        });
    
        inputCliente.addEventListener('keydown',function(e){
            const divlist = document.querySelector('#'+this.id +'-lista-autocompletar');
            let items;
            if(divlist){
                items = divlist.querySelectorAll('div');
    
                switch (e.keyCode) {
                    case 40: // tecla de abajo
                        indexFocus++;
                        if(indexFocus > items.length-1){
                            indexFocus = items.length -1;
                        }
                        break;
                    case 38: // tacla de arriba
                        indexFocus--;
                        if(indexFocus < 0){
                            indexFocus = 0;
                        }
                        break;
                    case 13: // presionas enter
                        e.preventDefault();
                        items[indexFocus].click();
                        indexFocus = -1;
                        break;
                
                    default:
                        break;
                }
    
                seleccionar(items, indexFocus);
                return false;
            }
        });
    
        document.addEventListener('click', function(){
            cerrarLista();
        });

    }
    

}

autocompletarCliente();


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
	window.location = "registrarPedido";
	/*
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

	*/
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



/* asignar nombre a input de model del registro del clientes */
$(document).on("click", ".agregarClienteRp", function(){

	var nombreCliente =  $("#rpCliente").val();
	$("#nuevoNombreRp").val(nombreCliente);
});
/* validar Entradas de caracteres especiales */
/* validar caracteres especiales del nombre */
$(document).on("keyup", "#nuevoNombreRp", function(){

	$(".alert").remove();

	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteOrtografia", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoNombreRp").parent().after('<div class="alert alert-warning">¡El nombre del clietne no puede ir vacío o llevar caracteres especiales!</div>');

	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});

/* validar si el cliente ya existe */
$(document).on("keyup", "#nuevoUsuarioRp", function(){

	$(".alert").remove();

	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("validarCliente", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
			console.log(respuesta);
	    	if(respuesta){

	    		$("#nuevoUsuarioRp").parent().after('<div class="alert alert-warning">¡El nombre del clietne no puede ir vacío o llevar caracteres especiales!</div>');

	    		

	    	}else{
				$(".alert").remove();
			}

	    }

	});

});

/* validar caracteres especiales del Usuario */
$(document).on("keyup", "#nuevoUsuarioRp", function(){

	$(".alert").remove();

	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteOrtografia", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoUsuarioRp").parent().after('<div class="alert alert-warning">¡El usuario del clietne no puede ir vacío o llevar caracteres especiales!</div>');

	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});


/* validar caracteres especiales de la contraseña */
$(document).on("keyup", "#nuevoPasswordRp", function(){

	$(".alert").remove();

	var password = $(this).val();

	var datos = new FormData();
	datos.append("validarClientePassword", password);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoPasswordRp").parent().after('<div class="alert alert-warning">¡La contraseña del cliente no puede ir vacía o llevar caracteres especiales!</div>');
				$("#nuevoPasswordRp").parent().after('<div class="alert alert-warning">Caracteres especiales aceptados: *+# </div>');
	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});

/* validar caracteres especiales del la empresa */
$(document).on("keyup", "#nuevoEmpresaRp", function(){

	$(".alert").remove();

	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteOrtografia", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoEmpresaRp").parent().after('<div class="alert alert-warning">¡La empresa del clietne no puede ir vacía o llevar caracteres especiales!</div>');

	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});

/* validar caracteres especiales del correo */
$(document).on("keyup", "#nuevoCorreoRp", function(){

	$(".alert").remove();

	var correo = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteCorreo", correo);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoCorreoRp").parent().after('<div class="alert alert-warning">¡El correo del clietne no puede ir vacío o llevar caracteres especiales!</div>');

	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});

/* validar caracteres especiales del Telefono */
$(document).on("keyup", "#nuevoTelefonoRp", function(){

	$(".alert").remove();

	var correo = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteTelefono", correo);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoTelefonoRp").parent().after('<div class="alert alert-warning">¡El telefono del clietne no puede ir vacío o llevar caracteres especiales!</div>');

	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});

/* validar caracteres especiales del direccion */
$(document).on("keyup", "#nuevoDireccionRp", function(){

	$(".alert").remove();

	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteOrtografia", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoDireccionRp").parent().after('<div class="alert alert-warning">¡La direccion del clietne no puede ir vacío o llevar caracteres especiales!</div>');

	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});


/* validar caracteres especiales del pagina web */
$(document).on("keyup", "#nuevoWebRp", function(){

	$(".alert").remove();

	var cliente = $(this).val();

	var datos = new FormData();
	datos.append("validarClienteWeb", cliente);

	 $.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta == "error"){

	    		$("#nuevoWebRp").parent().after('<div class="alert alert-warning">¡La pagina web del clietne no puede ir vacío o llevar caracteres especiales!</div>');

	    		

	    	}else if(respuesta == "ok"){
				$(".alert").remove();
			}

	    }

	});

});

/* Guardar cliente */
$(document).on("click", ".btnGuardarClienteRp", function(){

	var nombre = $("#nuevoNombreRp").val();
	var usuario = $("#nuevoUsuarioRp").val();
	var password = $("#nuevoPasswordRp").val();
	var empresa = $("#nuevoEmpresaRp").val();
	var tipo = $("#nuevoTipoRp").val();
	var correo = $("#nuevoCorreoRp").val();
	var telefono = $("#nuevoTelefonoRp").val();
	var direccion = $("#nuevoDireccionRp").val();
	var web = $("#nuevoWebRp").val();
	const imagen = document.querySelector("#nuevaFotoRp");


	var datos = new FormData();
	datos.append("registrarCliente", "");
	datos.append("nombre", nombre);
	datos.append("usuario", usuario);
	datos.append("password", password);
	datos.append("empresa", empresa);
	datos.append("tipo", tipo);
	datos.append("correo", correo);
	datos.append("telefono", telefono);
	datos.append("direccion", direccion);
	datos.append("web", web);
	datos.append("imagen", imagen.files[0]);

	$.ajax({
	    url:"ajax/clientes.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
			if(respuesta != "error"){
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: '¡El Cliente ha sido guardado correctamente!',
					showConfirmButton: false,
					timer: 1500
				  });

				$("#rpCliente").attr("idcliente", respuesta);
				$('#agregarClienteRp').modal('toggle');

				$("#nuevoNombreRp").val("");
				$("#nuevoUsuarioRp").val("");
				$("#nuevoPasswordRp").val("");
				$("#nuevoEmpresaRp").val("");
				//$("#nuevoTipoRp").val("");
				$("#nuevoCorreoRp").val("");
				$("#nuevoTelefonoRp").val("");
				$("#nuevoDireccionRp").val("");
				$("#nuevoWebRp").val("");
			}else{
				Swal.fire({
					position: 'top-end',
					icon: 'error',
					title: '¡Error al guardar el cliente!',
					showConfirmButton: false,
					timer: 1500
				  });

				  
			}
			
		}
	});
});