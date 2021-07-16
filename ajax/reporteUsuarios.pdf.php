<?php
require_once "../controladores/piezas.controlador.php";
require_once "../modelos/pieza.modelo.php";
require "../vistas/plugins/fpdf/fpdf.php";

class generarReporte extends FPDF{
  public function header(){
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
    $this->SetFillColor(253,135, 39);
    $this->Rect(0, 0 ,220 , 50, 'F');
    $hoy = date("Y-m-d"); 
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
    $this->Cell(168,15, utf8_decode("Fecha Inicial: "),0,0,'R');
    $this->SetFont('Arial','B',12);
    $this->Cell(0,15, $fechaInicial,0,0,'R');
    $this->SetFont('Arial','I',12);
    $this->ln(4);
    $this->Cell(168,15, utf8_decode("Fecha Final: "),0,0,'R');
    $this->SetFont('Arial','B',12);
    $this->Cell(0,15, $fechaFinal,0,0,'R');
  }

  public function body(){
    $valor = $_GET["idUsuario"];
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
    $empleados = ControladorPiezas::usuarios($valor);
    $reportePiezas = ControladorPiezas::reportePiezasUsuario($fechaInicial, $fechaFinal, $valor);
    $total = 0;
    
    $dir = '../vistas/img/plantilla/Logo_euroLatina.png';
    $this->Image($dir,30,60,30,0,'PNG');
    $this->SetY(60);
    $this->SetX(128);
    $this->SetFont('Arial','I',12);
    $this->SetTextColor(0, 0, 0); 
    $this->Cell(15,15, utf8_decode("Empleado:  "),0,0,'R');
    $this->SetFont('Arial','B',12);
    $this->SetX(180);
    $this->Cell(10,15, $empleados["nombre"], 0, 0, 'R');
    $this->SetY(65);
    $this->SetX(113);
    $this->SetFont('Arial','I',12);
    $this->Cell(20,15, utf8_decode("Perfil:  "),0,0,'R');
    $this->SetFont('Arial','B',12);
    $this->SetX(150);
    $this->Cell(10,15, $empleados["perfil"], 0, 0, 'R');
    $this->SetY(70);
    $this->SetX(112);
    $this->SetFont('Arial','I',12);
    $this->Cell(20,15, utf8_decode("Turno: "),0,0,'R');
    $this->SetFont('Arial','B',12);
    $this->SetX(150);
    $this->Cell(10,15, $empleados["turno"], 0, 0, 'R');

    $this->SetY(100);
    $this->SetX(20);

    $this->SetTextColor(255, 255, 255);  
    $this->SetFillColor(79,78,77);
    $this->Cell(25,10, 'No. pedido', 0, 0, 'C', 1);
    $this->Cell(30,10, 'Modelo', 0, 0, 'C', 1);
    $this->Cell(30,10, 'Color', 0, 0, 'C', 1);
    $this->Cell(20,10, 'Talla', 0, 0, 'C', 1);
    $this->Cell(20,10, 'Cantidad', 0, 0, 'C', 1);
    $this->Cell(30,10, 'Maquina', 0, 0, 'C', 1);
    $this->Ln();
    $this->SetLineWidth(0.5); 
    $this->SetTextColor(0, 0, 0);  
    $this->SetFillColor(255,255,255);
    $this->SetFont('Arial','I',12);
    $this->SetDrawColor(80,80, 80); 
    $this->SetX(20);
   
    foreach ($reportePiezas as $key => $value) {
      $total += $value["cantidadDePiezas"];
      $this->Cell(25,10, $value["idPedido"], 'B', 0, 'C', 1);
      $this->Cell(30,10, $value["pieza"], 'B', 0, 'C', 1);
      $this->Cell(30,10, $value["color"], 'B', 0, 'C', 1);
      $this->Cell(20,10, $value["talla"], 'B', 0, 'C', 1);
      $this->Cell(20,10, $value["cantidadDePiezas"], 'B', 0, 'C', 1);
      $this->Cell(30,10, $value["maquina"], 'B', 0, 'C', 1);
      $this->Ln(13);
      $this->SetX(20);
    }

    $this->SetX(92);
    $this->SetFont('Arial','B',12);

    $this->Cell(45,6, 'Total:', 0, 0, 'C', 1);
    $this->SetX(120);
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