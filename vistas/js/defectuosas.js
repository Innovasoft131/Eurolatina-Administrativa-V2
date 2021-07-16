

$(document).on("click","#generarReporteDefectuosas",function(){
  var fechaInicial = $("#fechaInicialDefectuosas").val();
  var fechaFinal = $("#fechaFinalDefectuosas").val();
  if(fechaInicial == "" || fechaFinal == ""){
      Swal.fire('Selecciona una fecha');
  }else{

    window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }

});

$(document).on("click", ".btnMostrarDefectuosasPdf", function(){
  var idDefectuosas = $(this).attr("idDefectuosas");
  var empleado = $(this).attr("empleado");
  var idsegundoModulo = $(this).attr("idsegundoModulo");
  var idtercerModulo = $(this).attr("idtercerModulo");
  var estacion = $(this).attr("estacion");

  $("#mostrarPiezasDefectuosaspdf").attr("data","ajax/defectuosas.pdf.php?idDefectuosas="+idDefectuosas+"&empleado="+empleado+"&idsegundoModulo="+idsegundoModulo+"&idtercerModulo="+idtercerModulo+"&estacion="+estacion);
});

$(document).on("click",".cerrarPdfDefectuosas", function(){
  window.location = "reportes";
});