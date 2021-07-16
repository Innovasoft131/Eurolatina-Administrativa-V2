<?php
require_once "../controladores/problemas.controlador.php";
require_once "../modelos/problemas.modelo.php";
require "../vistas/plugins/fpdf/fpdf.php";

class generarReporte extends FPDF{
    public function header(){
      $hoy = date("Y-m-d H:i:s");
      if(isset($_GET["idPedido"])){
          if($_GET["idPedido"] >= 1){
            $idPedido = $_GET["idPedido"];
          }
        
      }
      
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
      if(isset($_GET["idPedido"])){
          if($_GET["idPedido"] >= 1){
            $this->Cell(155,15, utf8_decode("No. Pedido: "),0,0,'R');
            $this->SetFont('Arial','B',12);
            $this->Cell(0,15, $idPedido,0,0,'L');
          }

      }

    }

    public function body(){
      $id = $_GET["id"];


      $reporteProblemas = problemasControlador::ctrreporteProblemaspdf($id);
        
      if(count($reporteProblemas) == 0){
        $reporteProblemas = problemasControlador::ctrreporteProblemaspdfs($id);
        
      }
      
      
      

      $dir = '../vistas/img/plantilla/Logo_euroLatina.png';
      $this->Image($dir,30,60,30,0,'PNG');

      $this->SetY(60);
      $this->SetX(60);
      $this->SetFont('Arial','B',12);
      $this->Cell(90,15, utf8_decode("Empleado: "),0,0,'R');
      $this->SetFont('Arial','I',12);
      $this->Cell(45,15, $reporteProblemas[0]["empleado"],0,0,'R');
      $this->Ln(4);
      $this->SetX(52);  
      $this->SetFont('Arial','B',12);
      $this->Cell(90,15, utf8_decode("Turno: "),0,0,'R');
      $this->SetFont('Arial','I',12);
      $this->SetX(113); 
      $this->Cell(45,15, $reporteProblemas[0]["turno"],0,0,'R');

      

  
      $this->SetY(100);
      $this->SetX(20);
  
      $this->SetTextColor(255, 255, 255);  
      $this->SetFillColor(79,78,77);

      $this->Cell(20,10, 'Linea', 0, 0, 'C', 1);
      $this->Cell(20,10, 'Maquina', 0, 0, 'C', 1);
      $this->Cell(70,10, 'Problema', 0, 0, 'C', 1);
      $this->Cell(80,10, utf8_decode('Descripción'), 0, 0, 'C', 1);


      $this->Ln();
      $this->SetLineWidth(0.5); 
      $this->SetTextColor(0, 0, 0);  
      $this->SetFillColor(255,255,255);
      $this->SetFont('Arial','I',12);
      $this->SetDrawColor(80,80, 80); 
      $this->SetX(20);
     
      foreach ($reporteProblemas as $key => $value) {

        $this->Cell(20,10, $value["linea"], 'B', 0, 'C', 1);
        $this->Cell(20,10, $value["maquina"], 'B', 0, 'C', 1);
        $this->Cell(70,10, $value["nombre"], 'B', 0, 'C', 1);
        $this->Cell(80,10, $value["problema"], 'B', 0, 'C', 1);

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