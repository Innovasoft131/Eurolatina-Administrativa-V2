<?php
require "../vistas/plugins/phpqrcode/qrlib.php";
require "../vistas/plugins/fpdf/fpdf.php";

    $idMaquina = $_GET["idMaquina"];
    $nombreMaquina = $_GET["nombreMaquina"];

    $dir = '../vistas/img/maquinas/';

    if(!file_exists($dir)){
        mkdir($dir);
    }
    $nombreArchivo = $dir.$nombreMaquina.'.png';
    $tamanio = 10;
    $level = 'M';
    $frameSize = 3;
    $contenido = $idMaquina;

    QRcode::png($contenido, $nombreArchivo, $level, $tamanio, $frameSize);

    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial','I',25);
    $pdf->SetY(2);

    $dir = '../vistas/img/plantilla/Logo_euroLatina.png';
    $pdf->Image($dir,20,10,20,0,'PNG');
    $pdf->SetX(40);
    $pdf->Cell(0,40, utf8_decode("Euro"),0,0,'L');
    $pdf->SetFont('Arial','B',25);
    $pdf->SetX(59);
    $pdf->SetTextColor(255, 136, 2);
    $pdf->Cell(0,40, utf8_decode("Latina"),0,0,'L');
    $pdf->SetFillColor(253,135, 39);
    $pdf->Rect(20, 32 ,170 , 0, 'F');
    $pdf->SetY(40);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Image($nombreArchivo,60,60,90,0,'PNG');
    $pdf->SetFont('Arial','B',40);
    $pdf->Cell(0,40, utf8_decode($nombreMaquina),0,0,'C');
    $pdf->Output();
