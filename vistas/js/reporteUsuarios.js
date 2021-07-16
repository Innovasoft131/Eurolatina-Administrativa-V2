$(document).on("click", ".btnMostrarReporteUsuario", function(){

    var fechaInicial = $(this).attr("fechaInicial");
    var fechaFinal = $(this).attr("fechaFinal");
    var idUsuario = $(this).attr("idUsuario");
    window.open('ajax/reporteUsuarios.pdf.php?idUsuario='+idUsuario+'&fechaInicial='+fechaInicial+'&fechaFinal='+fechaFinal, '_blank');
 //   $("#mostrarReporteDesglose").attr("data","ajax/reporteUsuarios.pdf.php?fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal);
});

$(document).on("click","#btngenerarReporteDeUsuario",function(){
    var fechaInicial = $("#fechaInicialDeUsuario").val();
    var fechaFinal = $("#fechaFinalDeUsuario").val();
    if(fechaInicial == "" || fechaFinal == ""){
        Swal.fire('Selecciona una fecha');
    }else{
  
      window.location = "index.php?ruta=reportesUsuario&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
    }
  
});