<?php
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";
require "../vistas/plugins/fpdf/fpdf.php";

class generarPedido extends FPDF{
    private $pdf;
    public $idPedido;
    public $idCliente;
    public $cliente;
    public $fechaPedido;
    public $fechaTermino;
    public function __construct(){
        $pdf = new FPDF();
        $pdf->AddPage();
        $this -> pdf = $pdf;
        
    }
    public function header(){
        $this->pdf->SetFillColor(253,135, 39);
        $this->pdf->Rect(0, 0 ,220 , 50, 'F');
        
        $fecha = substr($this->fechaPedido,0,10);
        $fechaTermino = substr($this->fechaTermino,0,10);
        $this->pdf->SetTextColor(255, 255, 255);
        $this->pdf->SetFont('Arial','I',25);
        $this->pdf->SetY(20);
        $this->pdf->Cell(10,15, utf8_decode("Euro"),0,0,'L');
        $this->pdf->SetFont('Arial','B',25);
        $this->pdf->SetX(22);
        $this->pdf->Cell(10,15, utf8_decode("Latina "),0,0,'L');
        $this->pdf->SetFont('Arial','I',12);
        $this->pdf->Cell(147,15, utf8_decode("No. Pedido: "),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
    //    $this->pdf->SetTextColor(23, 162, 184);
        $this->pdf->Cell(2,15, $this->idPedido,0,0,'R');
        
        $this->pdf->SetFont('Arial','I',12);
        $this->pdf->ln(4);
        $this->pdf->Cell(168,15, utf8_decode("Fecha del Inicio: "),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Cell(0,15, $fecha,0,0,'R');
        $this->pdf->SetFont('Arial','I',12);
        $this->pdf->ln(4);
        $this->pdf->Cell(168,15, utf8_decode("Fecha del Termino: "),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Cell(0,15, $fechaTermino,0,0,'R');
        $this->pdf->SetFont('Arial','I',12);

        
        
    }

    public function footer(){
        
    }

    public function body(){
        $pedidos = ControladorPedidos::ctrMostrarPedidoDesglosado($this->idPedido);
        $Cliente = ControladorPedidos::ctrMostrarCliente($this->idCliente);

 

        $dir = '../vistas/img/plantilla/Logo_euroLatina.png';
        $this->pdf->Image($dir,30,60,30,0,'PNG');
        $this->pdf->SetY(60);
        $this->pdf->SetX(128);
        $this->pdf->SetFont('Arial','I',12);
        $this->pdf->SetTextColor(0, 0, 0); 
        $this->pdf->Cell(15,15, utf8_decode("Cliente:  "),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->SetX(145);
        $this->pdf->Cell(10,15, $Cliente[0]["nombre"], 0, 0, 'R');
        $this->pdf->SetY(65);
        $this->pdf->SetX(125);
        $this->pdf->SetFont('Arial','I',12);
        $this->pdf->Cell(20,15, utf8_decode("Telefono:  "),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->SetX(160);
        $this->pdf->Cell(10,15, $Cliente[0]["telefono"], 0, 0, 'R');
        $this->pdf->SetY(70);
        $this->pdf->SetX(125);
        $this->pdf->SetFont('Arial','I',12);
        $this->pdf->Cell(20,15, utf8_decode("Direccion: "),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->SetX(189);
        $this->pdf->Cell(10,15, $Cliente[0]["direccion"], 0, 0, 'R');


        $this->pdf->SetY(100);
        $this->pdf->SetX(20);

        $this->pdf->SetTextColor(255, 255, 255);  
        $this->pdf->SetFillColor(79,78,77);
        $this->pdf->Cell(40,10, 'Modelo', 0, 0, 'C', 1);
       // $this->pdf->Cell(40,10, 'Modelo', 0, 0, 'C', 1);
        $this->pdf->Cell(40,10, 'Color', 0, 0, 'C', 1);
        $this->pdf->Cell(30,10, 'Talla', 0, 0, 'C', 1);
        $this->pdf->Cell(30,10, 'Cantidad', 0, 0, 'C', 1);
        $this->pdf->Ln();
        $this->pdf->SetLineWidth(0.5); 
        $this->pdf->SetTextColor(0, 0, 0);  
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->SetFont('Arial','I',12);
        $this->pdf->SetDrawColor(80,80, 80); 
        $this->pdf->SetX(20);
        $total = 0;
        foreach ($pedidos as $key => $value) {
            $total += $value["cantidad"];
            $this->pdf->Cell(40,10, $value["nombrePieza"], 'B', 0, 'C', 1);
        //    $this->pdf->Cell(40,10, $value["modelo"], 'B', 0, 'C', 1);
            $this->pdf->Cell(40,10, $value["color"], 'B', 0, 'C', 1);
            $this->pdf->Cell(30,10, $value["talla"], 'B', 0, 'C', 1);
            $this->pdf->Cell(30,10, $value["cantidad"], 'B', 0, 'C', 1);
            $this->pdf->Ln();
            $this->pdf->SetX(20);
        }
        $this->pdf->SetX(50);
        $this->pdf->SetFont('Arial','B',12);

        $this->pdf->Cell(140,6, 'Total:', 0, 0, 'C', 1);
        $this->pdf->SetX(130);
        $this->pdf->SetTextColor(0, 0, 0);  
        $this->pdf->SetFillColor(255,255,255);
        $this->pdf->Cell(30,6, $total, 0, 0, 'C', 1);
        $this->pdf->Output();
    }
}

if(isset($_GET["idPedido"])){
    $generarPdf = new generarPedido();
    $generarPdf -> idPedido = $_GET["idPedido"];
    $generarPdf -> idCliente = $_GET["idCliente"];
    $generarPdf -> cliente = $_GET["cliente"];
    $generarPdf -> fechaPedido = $_GET["fechaPedido"];
    $generarPdf -> fechaTermino = $_GET["fechaTermino"];
    $generarPdf -> header();
    $generarPdf -> body();
}



?>