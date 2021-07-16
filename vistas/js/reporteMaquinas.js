
  // reporte Maquinas

  /* variable local storage */
/*
  if(localStorage.getItem("capturarRangoMaquinas") != null){
    $("#btndaterangeMaquinas span").html(localStorage.getItem("capturarRangoMaquinas"));
  
  }else{
    $("#btndaterangeMaquinas span").html('<i class="fas fa-calendar"></i> Rango de fecha');
  }
  
  
  /*=============================================
  RANGO DE FECHAS
  =============================================*/
  /*
  $('#btndaterangeMaquinas').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment(),
      endDate  : moment()
    },
    function (start, end) {
      $('#btndaterangeMaquinas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  
      var fechaInicial = start.format('YYYY-MM-DD');
  
      var fechaFinal = end.format('YYYY-MM-DD');
  
      var capturarRango = $("#btndaterangeMaquinas span").html();
     
         localStorage.setItem("capturarRangoMaquinas", capturarRango);
  
         window.location = "index.php?ruta=reporteMaquinas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
    }
  
  );
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  /*
  $(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){
  
      localStorage.removeItem("capturarRangoMaquinas");
      localStorage.clear();
      window.location = "reportes";
  })
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  /*
  $(".daterangepicker.opensright .ranges li").on("click", function(){
  
      var textoHoy = $(this).attr("data-range-key");
  
      if(textoHoy == "Hoy"){
  
      var d = new Date();
      
      var dia = d.getDate();
      var mes = d.getMonth()+1;
      var año = d.getFullYear();
  
      if(mes < 10){
  
        var fechaInicial = año+"-0"+mes+"-"+dia;
        var fechaFinal = año+"-0"+mes+"-"+dia;
  
      }else if(dia < 10){
  
        var fechaInicial = año+"-"+mes+"-0"+dia;
        var fechaFinal = año+"-"+mes+"-0"+dia;
  
      }else if(mes < 10 && dia < 10){
  
        var fechaInicial = año+"-0"+mes+"-0"+dia;
        var fechaFinal = año+"-0"+mes+"-0"+dia;
  
      }else{
  
        var fechaInicial = año+"-"+mes+"-"+dia;
          var fechaFinal = año+"-"+mes+"-"+dia;
  
      } 
  
          localStorage.setItem("capturarRangoMaquinas", "Hoy");
  
          window.location = "index.php?ruta=reporteMaquinas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  
      }
  
  });

*/
$(document).on("click", ".btnMostrarReporteMaquina", function(){


    var idPedido = $(this).attr("idpedido");
	  var hoy = $(this).attr("hoy");

    $("#mostrarReporteMaquinasPdf").attr("data","ajax/reporteMaquinas.pdf.php?idPedido="+idPedido+"&hoy="+hoy);
});

$(document).on("click","#btngenerarReporteDeMaquinas",function(){
  var fechaInicial = $("#fechaInicialDeMaquinas").val();
  var fechaFinal = $("#fechaFinalDeMaquinas").val();
  if(fechaInicial == "" || fechaFinal == ""){
      Swal.fire('Selecciona una fecha');
  }else{

    window.location = "index.php?ruta=reporteMaquinas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
  }

});

$(document).on("click", ".cerrarPdftablaMaquinas", function(){
	window.location = "reporteMaquinas";
});