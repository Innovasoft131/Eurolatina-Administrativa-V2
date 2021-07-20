$(document).on("click","#agregarClienteoport", function(){
  var folio = $("#opofolio").val();
  var empleado = $("#opoEmpleado").val();

  /* Para obtener el texto */
var comboEmpleado = document.getElementById("opoEmpleado");
var selectedEmpleado = comboEmpleado.options[comboEmpleado.selectedIndex].text;

  localStorage.setItem("folio", folio);
  localStorage.setItem("Idempleado", empleado);
  localStorage.setItem("empleado", selectedEmpleado);

});

$(document).on("change", "#opoCliente", function(){
    var idCliente = $("#opoCliente").val();
    var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#nuevaEmpresa").val(respuesta["empresa"]);


        }

    });
});

$(document).on("change", "#opoEtapa", function(){
    var idPorcentaje = $("#opoEtapa").val();
    
	
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
            $("#opoExito").val(respuesta["exito"]);

		}

	});
});

function obtener_localStorage(){
    if(localStorage.getItem("folio") && localStorage.getItem("empleado")){
        var folio = localStorage.getItem("folio");
        var Idempleado = localStorage.getItem("Idempleado");
        var empleado = localStorage.getItem("empleado");

        $("#opofolio").val(folio);

        $("#opoEmpleado").append('<option value="'+Idempleado+'" selected>'+empleado+'</option>');
    }
}

obtener_localStorage();