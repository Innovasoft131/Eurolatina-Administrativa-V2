$(document).on("click", ".btnViewPresupuesto", function(){
	var idOportunidad = $(this).attr('idoportunidad');
	window.location = "index.php?ruta=presupuestoView&oportunidad="+idOportunidad;
	/*
    
    var datos = new FormData();
	datos.append("idOportunidad", idOportunidad);

    $.ajax({
		url:"ajax/presupuesto.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
			
			$("#idOportunidad").val(respuesta["id"]);
            $("#NombreClientePresupuesto").val(respuesta["cliente"]);
			$("#idclientePresupuesto").val(respuesta["idCliente"]);
            $("#empresaPresupuesto").val(respuesta["empresa"]);
			$("#servicioAccionComercial").val(respuesta["accion"]);
			$("#servicioPresupuesto").val(respuesta["servicio"]);
			$("#modeloPresupuesto").val(respuesta["modelo"]);
			$("#cantidadPresupuesto").val(respuesta["cantidad"]);
			$("#importeOportunidad").val(respuesta["importe"]);
			$("#estado").append('<option value="'+respuesta["idPorcentaje"]+'" selected>'+respuesta["etapa"]+'</option>');;
		}

	});

	*/
});

$(document).on("click", ".cerrarPresupueso", function(){
	window.location = "presupuesto";
});

$(document).on("click", ".btnEliminar", function(){
	var idOportunidad = $(this).attr('idOportunidad');
	Swal.fire({
		title: '¿Está seguro de borrar el presupuesto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, borrar presupuesto!'
	  }).then(function(result){
	
		if(result.value){
	
		  window.location = "index.php?ruta=Ppendientes&idOportunidad="+idOportunidad;
	
		}
	
	  });
});

$(document).on("click", ".btnVer", function(){
	var idOportunidad = $(this).attr('idOportunidad');
	window.location = "index.php?ruta=presupuestoInfo&oportunidad="+idOportunidad;
});


