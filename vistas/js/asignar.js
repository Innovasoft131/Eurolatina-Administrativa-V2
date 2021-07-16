var idPrimerModulo;
var idPedido;
$(document).on("click", ".btnAsignar", function(){
    idPrimerModulo = $(this).attr("idPrimerModulo");
    var nombreCliente = $(this).attr("nombreCliente");
    var idCliente = $(this).attr("idCliente");
    idPedido = $(this).attr("idPedido");
    $("#piezaAsignar").html("");
    $("#slMaquinaAsignar").html("");
    $("#tbAsignar tbody").html("");
//    mostrarMaquinas();
    mostrarLineas();
    $("#NombreClienteAsignar").val(nombreCliente);
    $("#idPedidoAsignar").val(idPedido);
    $("#idPrimerModulo").val(idPrimerModulo);
    mostrartbAsignarMaquina(idPedido,idPrimerModulo);


    var datos = new FormData();
	datos.append("idPedidoSeleccion", idPedido);
    datos.append("idPrimerModulo", idPrimerModulo);

	$.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#piezaAsignar").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#piezaAsignar").append('<option value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
                

                
            }
		}

	});
});

$(document).on("change", "#piezaAsignar", function(){
    var idPedido = $("#idPedidoAsignar").val();
    var idPieza = $(this).val();
   // tabla = document.getElementById('tbodyAsignar');


   var numero;
   var color;
   var talla;
   var modelo;
   var cantidad;
   var fila;
   var radio;
    var datos = new FormData();
	datos.append("idPedido", idPedido);
    datos.append("idPiezaSeleccionada", idPieza);

	$.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#tbAsignar tbody").html("");
            for (let i = 0; i < respuesta.length; i++) {

              //  $("#tbAsignar").append('<tr><td>'+i+'</td><td>'+respuesta[i]["color"]+'</td><td>'+respuesta[i]["talla"]+'</td> <td>'+respuesta[i]["modelo"]+'</td></tr>');

                numero = '<td>'+i+'</td>'; 
                radio = '<td><input type="radio" idPrimerModuloDesglose="'+respuesta[i]["id"]+'" cantidad="'+respuesta[i]["cantidad"]+'" class="seleccionado" name="seleccionado" id="rd'+i+'"></td>'; 
                color = '<td>'+respuesta[i]["color"]+'</td>';
                talla = '<td>'+respuesta[i]["talla"]+'</td>';
            //    modelo = '<td>'+respuesta[i]["modelo"]+'</td>';
                cantidad = '<td>'+respuesta[i]["cantidad"]+'</td>';
                
                fila += '<tr>';
                
                fila += numero;
                fila += radio;
                fila += color;
                fila += talla;
            //    fila += modelo;
                fila += cantidad;
                fila += '</tr>';

             
               
                
            }
            $("#tbAsignar tbody").html(fila);

     //     $("#tb").append(fila);

           
            

		}
    

	});

    
});

/*
$(document).on("click","#tbAsignar tr input[type=radio]", function(){
    $("#tbAsignar tr input[type=radio]").css("background-color","#4682B4");
    $(this).css("color","white");

    
});
*/



$(document).on("click",".seleccionado",function(){
    var valor = $(this).attr("idprimermodulodesglose");
    var cantidad = $(this).attr("cantidad");
    $("#idprimermodulodesglose").val(valor);
    $("#cantidadAsignarMaquina").val(cantidad);
    $("#cantidadPedido").val(cantidad);
    
    // verificar
    var cantidadAsignada = $("#cantidadAsignarMaquina").val();
    var cantidadPedido = $("#cantidadPedido").val();
    var idPrimerModulo = $("#idPrimerModulo").val();
    var idPrimerModuloDesglose = $("#idprimermodulodesglose").val();
    verificar(idPrimerModuloDesglose, idPrimerModulo, cantidadPedido, cantidadAsignada);
});

function mostrarLineas(){
    var datos = new FormData();
	datos.append("mostrarLineas", "");

   

	$.ajax({

		url:"ajax/maquina.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#LineaAsignar").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#LineaAsignar").append('<option value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
                
            }
            
        

		}

	});
}
function mostrarMaquinas(){
    var datos = new FormData();
	datos.append("maquinas", "");
    $.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            $("#slMaquinaAsignar").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#slMaquinaAsignar").append('<option value="'+respuesta[i]["id"]+'">'+respuesta[i]["nombre"]+'</option>');
                

                
            }
            
		}

	});
}

$(document).on("click","#btnAsignarMaquina", function(){
    var idMaquina = $("#slMaquinaAsignar").val();
    var idLinea = $("#LineaAsignar").val();
    var cantidadAsignada = $("#cantidadAsignarMaquina").val();
    var cantidadPedido = $("#cantidadPedido").val();
    var idPrimerModulo = $("#idPrimerModulo").val();
    var idPrimerModuloDesglose = $("#idprimermodulodesglose").val();
    var idPedido = $("#idPedidoAsignar").val();

    var datos = new FormData();
    datos.append("accion","insertar");
    datos.append("idMaquina",idMaquina);
    datos.append("idLinea",idLinea);
    datos.append("cantidadAsignada",cantidadAsignada);
    datos.append("cantidadPedido",cantidadPedido);
    datos.append("idPrimerModulo",idPrimerModulo);
    datos.append("idPrimerModuloDesglose",idPrimerModuloDesglose);



    $.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            if(respuesta == "ok"){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se  asignó  el pedido a la maquina',
                    showConfirmButton: false,
                    timer: 1800
                  });
                $("#piezaAsignar").val("");
                $("#slMaquinaAsignar").val("");
                $("#cantidadAsignarMaquina").val("");;
                $("#tbAsignar tbody").html("");
                mostrartbAsignarMaquina(idPedido,idPrimerModulo);
                cantidadPrimerModulo(idPrimerModulo);
                cantidadMaquinasProceso(idPrimerModulo);
                editarEstatus(idPrimerModulo);
            }else if(respuesta == "error"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ya ha sido guardado anteriormente.!',
                    footer: ''
                });
                $("#piezaAsignar").val("");
                $("#slMaquinaAsignar").val("");
                $("#cantidadAsignarMaquina").val("");;
                $("#tbAsignar tbody").html("");
            }else if(respuesta == "errorCantidad"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La cantidad asignada no puede ser mayor a la cantidad del pedido.!',
                    footer: ''
                });
            }else if(respuesta == "cantidadAsignanaNull"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La cantidad a maquina no puede ir vacía o llevar caracteres especiales.!',
                    footer: ''
                });
            }else if(respuesta == "idMaquinaNull"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La maquina no puede ir vacía.!',
                    footer: ''
                });
            }else if(respuesta == "cantidadcero"){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La cantidad a maquina tiene que ser mayor a cero.!',
                    footer: ''
                });
            }
            
		}

	});
});

function verificar(idPrimerModuloDesglose, idPrimerModulo,  cantidadPedido, cantidadAsignada){
    var datos = new FormData();
	datos.append("verificar", "");
    datos.append("idPrimerModuloDesglose", idPrimerModuloDesglose);
    datos.append("idPrimerModulo", idPrimerModulo);
    datos.append("cantidadPedido", cantidadPedido);
    datos.append("cantidadAsignada", cantidadAsignada);
    $.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            if(parseInt(respuesta[0]["cantidad"]) <= parseInt(cantidadPedido) ){

                $("#cantidadAsignarMaquina").val((cantidadPedido - respuesta[0]["cantidad"]));
            }
		}

	});
}


function mostrartbAsignarMaquina(idPedido,idPrimerModulo){
    var piezaMaquina;
    var numeroMaquina;
    var pedidoMaquina;
    var colorMaquina;
    var tallaMaquina;
    var modeloMaquina;
    var cantidadMaquina;
    var mauinaMaquina;
    var filaMaquina;
    var botonMaquina;

    var datos = new FormData();
	datos.append("mostrarMaquina", "");
    datos.append("idPedido", idPedido);
    datos.append("idPrimerModulo", idPrimerModulo);

    $.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
          
            $("#tbAsignarMaquina tbody").html("");
            for (let i = 0; i < respuesta.length; i++) {

              //  $("#tbAsignar").append('<tr><td>'+i+'</td><td>'+respuesta[i]["color"]+'</td><td>'+respuesta[i]["talla"]+'</td> <td>'+respuesta[i]["modelo"]+'</td></tr>');
                
                numeroMaquina = '<td>'+i+'</td>'; 
                piezaMaquina = '<td>'+respuesta[i]["pieza"]+'</td>'
                pedidoMaquina = '<td>'+respuesta[i]["pedido"]+'</td>';
                colorMaquina = '<td>'+respuesta[i]["color"]+'</td>';
                tallaMaquina = '<td>'+respuesta[i]["talla"]+'</td>';
            //    modeloMaquina = '<td>'+respuesta[i]["modelo"]+'</td>';
                cantidadMaquina = '<td>'+respuesta[i]["cantidad"]+'</td>';
                mauinaMaquina = '<td>'+respuesta[i]["maquina"]+'</td>';
                botonMaquina = '<td><button type="button" idPedido="'+idPedido+'" idPrimerModulo="'+idPrimerModulo+'" class="btn btn-info btnQuitarAsignar" idMaquinasProceso="'+respuesta[i]["idMaquinasProceso"]+'"><i class="fas fa-trash"></i></button></td>';
                
                filaMaquina += '<tr>';
                
                filaMaquina += numeroMaquina;
                
                filaMaquina += pedidoMaquina;
                filaMaquina += piezaMaquina;
                filaMaquina += colorMaquina;
                filaMaquina += tallaMaquina;
            //    filaMaquina += modeloMaquina;
                filaMaquina += cantidadMaquina;
                filaMaquina += mauinaMaquina;
                filaMaquina += botonMaquina;
                filaMaquina += '</tr>';

             
               
                
            }
            $("#tbAsignarMaquina tbody").html(filaMaquina);
            
		}

	});
}


$(document).on("click", ".btnQuitarAsignar", function(){
    var idmaquinasproceso = $(this).attr("idmaquinasproceso");
    var idPedido = $(this).attr("idPedido");
    var idPrimerModulo = $(this).attr("idPrimerModulo");
    var datos = new FormData();
	datos.append("idmaquinasproceso", idmaquinasproceso);

    Swal.fire({
      title: '¿Está seguro de borrar la asignación?',
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar asignación!'
    }).then(function(result){  
      if(result.value){
        $.ajax({

            url:"ajax/asignar.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
                if(respuesta == "ok"){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'asignación  eliminada',
                        showConfirmButton: false,
                        timer: 1800
                      });
                      $("#piezaAsignar").val("");
                      $("#slMaquinaAsignar").val("");
                      $("#cantidadAsignarMaquina").val("");;
                      $("#tbAsignar tbody").html("");
                      mostrartbAsignarMaquina(idPedido,idPrimerModulo);
                      cantidadPrimerModulo(idPrimerModulo);
                      cantidadMaquinasProceso(idPrimerModulo);
                      editarEstado(idPrimerModulo);
                }else if(respuesta == "error"){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No es posible eliminar asignación ya que se inició la producción.!',
                        footer: ''
                    });
                }
            }
    
        });

      }
  
    });
});

function cantidadPrimerModulo(idPrimerModulo){
    var datos = new FormData();
	datos.append("cantidadPrimerModulo", "");
    datos.append("idPrimerModulo", idPrimerModulo);

    $.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){

            $("#cantidadPrimerModulo").val(respuesta[0]["cantidad"]);
		}

	});
}

function cantidadMaquinasProceso(idPrimerModulo){
    var datos = new FormData();
	datos.append("cantidadMaquinasProceso", "");
    datos.append("idPrimerModulo", idPrimerModulo);

    $.ajax({

		url:"ajax/asignar.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
            
            $("#cantidadMaquinasProceso").val(respuesta[0]["cantidad"]);
		}

	});
}


function editarEstatus(idPrimerModulo){


    var cantidadPrimerModuloD = $("#cantidadPrimerModulo").val();
    var cantidadMaquinasProcesod = $("#cantidadMaquinasProceso").val();

    if(cantidadPrimerModuloD == cantidadMaquinasProcesod || cantidadMaquinasProcesod >= cantidadPrimerModuloD){
        var datos = new FormData();
        datos.append("editarPrimerModulo", "");
        datos.append("idPrimerModulo", idPrimerModulo);
    
        $.ajax({
    
            url:"ajax/asignar.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

            }
    
        });
    }

}

function editarEstado(idPrimerModulo){
    var cantidadPrimerModuloD = $("#cantidadPrimerModulo").val();
    var cantidadMaquinasProcesod = $("#cantidadMaquinasProceso").val();
    
    if(cantidadPrimerModuloD != cantidadMaquinasProcesod && cantidadMaquinasProcesod <= cantidadPrimerModuloD || cantidadMaquinasProcesod == null || cantidadMaquinasProcesod == ""){
        var datos = new FormData();
        datos.append("editarPrimerModuloAcero", "");
        datos.append("idPrimerModulo", idPrimerModulo);
        
        $.ajax({
    
            url:"ajax/asignar.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){
            }
    
        });
    }
}

$(document).on("click", ".cerrarAsignar", function(){
    window.location = "asignar";
});


$(document).on("change", "#LineaAsignar", function(){
    var idlinea = $(this).val();
    var fila = "";
    var maquina = "";
    var radio = "";
    $("#slMaquinaAsignar").html("");
    var datos = new FormData();
    datos.append("mostrarMaquinas", "");
    datos.append("idlinea", idlinea);
    
    $.ajax({

        url:"ajax/asignar.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            $("#slMaquinaAsignar").append('<option value=""></option>');
            for (let i = 0; i < respuesta.length; i++) {
                $("#slMaquinaAsignar").append('<option value="'+respuesta[i]["idMaquina"]+'">'+respuesta[i]["maquina"]+'</option>');
            }
        }

    });
});

