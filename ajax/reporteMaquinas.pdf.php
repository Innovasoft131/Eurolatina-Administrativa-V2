<?php
require_once "../controladores/reporteMaquinas.controlador.php";
require_once "../modelos/reporteMaquinas.modelo.php";
require "../vistas/plugins/fpdf/fpdf.php";

class generarReporte extends FPDF{
    public function header(){
      $hoy = $_GET["hoy"];
      $idPedido = $_GET["idPedido"];
      $this->SetFillColor(253,135, 39);
      $this->Rect(0, 0 ,220 , 50, 'F');
      
     // $fecha = substr($this->fechaPedido,0,10);
      $this->SetTextColor(255, 255, 255);
      $this->SetFont('Arial','I',25);
      $this->SetY(20);
      $this->Cell(10,15, utf8_decode("Euro"),0,0,'L');
      $this->SetFont('Arial','B',25);
      $this->SetX(29);
      $this->Cell(10,15, utf8_decode("Latina "),0,0,'L');
      $this->SetFont('Arial','B',12);
  //    $this->SetTextColor(23, 162, 184);
      $this->Cell(2,15, "",0,0,'R');
      
      $this->SetFont('Arial','I',12);
      $this->ln(4);
      $this->Cell(155,15, utf8_decode("Fecha: "),0,0,'R');
      $this->SetFont('Arial','B',12);
      $this->Cell(0,15, $hoy,0,0,'R');
      $this->SetFont('Arial','I',12);
      $this->ln(4);
      $this->Cell(155,15, utf8_decode("No. Pedido: "),0,0,'R');
      $this->SetFont('Arial','B',12);
      $this->Cell(0,15, $idPedido,0,0,'L');
    }

    public function body(){
      $idPedido = $_GET["idPedido"];


      $reporteMaquinas = ControladorReporteMaquinas::ctrreporteMaquinaspdf($idPedido);
      

      $dir = '../vistas/img/plantilla/Logo_euroLatina.png';
      $this->Image($dir,30,60,30,0,'PNG');

  
      $this->SetY(100);
      $this->SetX(20);
  
      $this->SetTextColor(255, 255, 255);  
      $this->SetFillColor(79,78,77);
      $this->Cell(30,10, 'Modelo', 0, 0, 'C', 1);
      $this->Cell(30,10, 'Color', 0, 0, 'C', 1);
      $this->Cell(20,10, 'Talla', 0, 0, 'C', 1);
      $this->Cell(40,10, 'Cantidad Asignada', 0, 0, 'C', 1);
    //  $this->Cell(35,10, 'Cantidad Inicio', 0, 0, 'C', 1);
      $this->Cell(40,10, 'Cantidad Prevista', 0, 0, 'C', 1);
      $this->Cell(30,10, 'Maquina', 0, 0, 'C', 1);
      $this->Ln();
      $this->SetLineWidth(0.5); 
      $this->SetTextColor(0, 0, 0);  
      $this->SetFillColor(255,255,255);
      $this->SetFont('Arial','I',12);
      $this->SetDrawColor(80,80, 80); 
      $this->SetX(20);
     
      foreach ($reporteMaquinas as $key => $value) {
        $horaInicio =  strtotime($value["fechainicio"]); // strtotime("2021-05-20 17:00:00");  

        if($value["estadoPausa"] == 1){
          //  $horaConsulta = strtotime($value["fechaPausa"]); // strtotime("2021-05-20 18:00:00"); 
            $horaConsulta = $value["fechaPausa"];
        }else{
          //  $horaConsulta = strtotime($_GET["hoy"]); // strtotime("2021-05-20 18:00:00");
         //  $horaConsulta = strtotime(date('Y-m-d H:i:s')); 
          $horaConsulta = date('Y-m-d H:i:s');  
        }
        

        /*
        $minTrancurridos = ($horaInicio - $horaConsulta)/60;
        $minTrancurridos = abs($minTrancurridos);
        $minTrancurridos = floor($minTrancurridos);
        */
       
        
        $minTrancurridos = ControladorReporteMaquinas::ctrreporteMinutosTranscuridos($value["fechainicio"], $horaConsulta);
        
        /*
        $horaI = new DateTime($value["fechainicio"]);
        $horaF = new DateTime($horaConsulta);
        $intervalo = $horaI->diff($horaF);
        */
       // $cantidadPrevista = $this->carcularCantidad($minTrancurridos, $value["porMin"]);

        $cantidad = 0;
        for ($i=0; $i < $minTrancurridos[0]["tiempoTrascurrido"] ;) { 
            $cantidad = $cantidad + 1;

            $i = $i + $value["porMin"];
        }

        
        $this->Cell(30,10, $value["pieza"], 'B', 0, 'C', 1);
        $this->Cell(30,10, $value["color"], 'B', 0, 'C', 1);
        $this->Cell(20,10, $value["talla"], 'B', 0, 'C', 1);
        $this->Cell(40,10, $value["cantidadAsignada"], 'B', 0, 'C', 1);
    //    $this->Cell(35,10, $value["cantidadInicio"], 'B', 0, 'C', 1);
        $this->Cell(40,10, $cantidad,'B', 0, 'C', 1);
        $this->Cell(30,10, $value["maquina"], 'B', 0, 'C', 1);
        $this->Ln();
        $this->SetX(20);
      }
  /*
      $this->SetX(90);
      $this->SetFont('Arial','B',12);
  
      $this->Cell(110,6, 'Total:', 0, 0, 'C', 1);
      $this->SetX(150);
      $this->SetTextColor(0, 0, 0);  
      $this->SetFillColor(255,255,255);
      $this->Cell(30,6, $total, 0, 0, 'C', 1);
      */
    }

    function carcularCantidad($minTrancurridos, $porMin){
        $cantidad = 0;
        for ($i=0; $i < $minTrancurridos ; $i+$porMin) { 
            $cantidad = $cantidad + 1;
        }

        return $cantidad;
    }

    public function footer(){
      $this -> SetY(-15);
      
    }
  }
  
  $fpdf = new generarReporte();
  $fpdf ->AddPage('PORTAIT', 'letter');
  $fpdf -> body();
  $fpdf -> OutPUT();
  
  ?>