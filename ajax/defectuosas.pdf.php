<?php
require_once "../controladores/piezas.controlador.php";
require_once "../modelos/pieza.modelo.php";
require "../vistas/plugins/fpdf/fpdf.php";

class generarReporte extends FPDF{
    public function header(){
      $hoy = date("y/m/d");
      $idDefectuosas = $_GET["idDefectuosas"];
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
      $this->Cell(147,15, utf8_decode("Fecha: "),0,0,'R');
      $this->SetFont('Arial','B',12);
      $this->SetX(155);
      $this->Cell(0,15, $hoy,0,0,'L');
      $this->SetFont('Arial','I',12);
      $this->ln(4);
      $this->SetX(7);
      $this->Cell(155,15, utf8_decode("No. Folio: "),0,0,'R');
      $this->SetFont('Arial','B',12);
      $this->Cell(0,15, $idDefectuosas,0,0,'L');
    }

    public function body(){
      $idDefectuosas = $_GET["idDefectuosas"];
      $total = 0;


      $reporteDefectuosas = ControladorPiezas::reportePiezasDefectuosas($idDefectuosas);
      $reporteDefectuosasUsuarios = ControladorPiezas::reportePiezasDefectuosasUsuario($idDefectuosas);
      

      $dir = '../vistas/img/plantilla/Logo_euroLatina.png';
      $this->Image($dir,30,60,30,0,'PNG');
      $this->SetY(60);
      $this->SetX(120);
      $this->Cell(0,15, 'Empleado: ',0,0,'L');
      $this->SetX(145);
      $this->Cell(0,15, $reporteDefectuosasUsuarios[0]['empleados'],0,0,'L');
      $this->ln(4);
      $this->SetX(120);
      $this->Cell(0,15, 'Turno: ',0,0,'L');
      $this->SetX(145);
      $this->Cell(0,15, $reporteDefectuosasUsuarios[0]['turno'],0,0,'L');
      $this->ln(4);
      if($reporteDefectuosasUsuarios[0]['idtercerModulo'] != "" || $reporteDefectuosasUsuarios[0]['idtercerModulo'] != null ){
        $this->SetX(120);
        $this->Cell(0,15, utf8_decode('Estación: '),0,0,'L');
        $this->SetX(145);
        $this->Cell(0,15, "Planchado",0,0,'L');
      }else if($reporteDefectuosasUsuarios[0]['idsegundoModulo'] != "" || $reporteDefectuosasUsuarios[0]['idsegundoModulo'] != null ){
        $this->SetX(120);
        $this->Cell(0,15, utf8_decode('Estación: '),0,0,'L');
        $this->SetX(145);
        $this->Cell(0,15, "Maquinas",0,0,'L');
      }

  
      $this->SetY(100);
      $this->SetX(20);
  
      $this->SetTextColor(255, 255, 255);  
      $this->SetFillColor(79,78,77);

      $this->Cell(50,10, 'Fecha', 0, 0, 'C', 1);
      $this->Cell(70,10, utf8_decode('Descripción'), 0, 0, 'C', 1); 
      $this->Cell(30,10, 'Cantidad', 0, 0, 'C', 1);

      $this->Ln();
      $this->SetLineWidth(0.5); 
      $this->SetTextColor(0, 0, 0);  
      $this->SetFillColor(255,255,255);
      $this->SetFont('Arial','I',12);
      $this->SetDrawColor(80,80, 80); 
      $this->SetX(20);

      $fechaReporte = "";
     
      foreach ($reporteDefectuosas as $key => $value) {
        $fechaReporte = substr($value['fecha'], 0, -8);
        $this->Cell(50,10, $fechaReporte, 'B', 0, 'C', 1);
        $this->Cell(70,10, utf8_decode($value['descripcion']), 'B', 0, 'C', 1);
        $this->Cell(30,10, $value['cantidad'], 'B', 0, 'C', 1);
        
        $total += $value['cantidad'];
        
        $this->Ln();
        $this->SetX(20);
      }
  
      $this->SetX(80);
      $this->SetFont('Arial','B',12);
  
      $this->Cell(110,6, 'Total:', 0, 0, 'C', 1);
      $this->SetX(140);
      $this->SetTextColor(0, 0, 0);  
      $this->SetFillColor(255,255,255);
      $this->Cell(30,6, $total, 0, 0, 'C', 1);
      
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