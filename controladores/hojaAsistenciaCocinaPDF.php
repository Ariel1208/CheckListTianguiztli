<?php
require_once('../lib/fpdf/fpdf.php');
require_once "../clases/conexion.php";

$fechaInicial = $_POST['fechaInicial'];
$fechaFinal = $_POST['fechaFinal'];
$sql="";

$c = new conectar();
$conexion = $c->conexion();

$fpdf = new FPDF('P','mm','A4');
$fpdf ->AddPage();

class pdf extends FPDF{
    
    public function header(){
        $this->Image('../img/up.jpeg',-1,0,210);
        $this->SetFont('Arial','B',18);
        $this->Ln(20);
        $this->Cell(0,10,'COMERCIALIZADORA TIANGUIZTLI',0,0,'C');
        $this->SetX(-15);
        $this->Cell(80);
        $this->Cell(30,10,'Title',1,0,'C');
        $this->Ln(23);
    }
    // Page footer
    function Footer()
    {
        $this->Image('../img/down.jpeg',0,245,210);
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','',10);
        // Page number and text in the center
        //$this->Cell(0,10,'CONTROL CTI ',0,0,'C');
        //$this->Cell(0,10,iconv('UTF-8', 'ISO-8859-2', 'P谩gina').$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF('P','mm','A4');
$pdf->SetAutoPageBreak(true,60); 

$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->SetFillColor(236,165,24);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',15);

$pdf ->Cell(0,9,iconv('UTF-8', 'ISO-8859-2', 'REPORTE DE PAGOS PARA EL SEVICIO DE COMEDOR'),1,0,'C',1);
$pdf ->Ln(15);

$pdf->SetFont('Arial','',10);
$pdf ->Cell(60,6,'USUARIO',1,0,'C',1);
$pdf ->Cell(50,6,'FECHA Y HORA DE PAGO',1,0,'C',1);
$pdf ->Cell(30,6,'DE',1,0,'C',1);
$pdf ->Cell(30,6,'A',1,0,'C',1);
$pdf ->Cell(20,6,'TOTAL',1,0,'C',1);

$pdf ->Ln(5);

$pdf->SetFillColor(255,255,255);

$totales=0;

if($fechaInicial==$fechaFinal){
    mysqli_query($conexion, "SET NAMES 'utf8'");
    $sql="SELECT nombre,fecha_pago,fecha_inicial,fecha_final,total FROM `historial_pagos_cocina` a INNER JOIN lista_servicio_cocina b ON a.id_usuario = b.id_usuario WHERE fecha_pago LIKE '$fechaInicial%'";
    $consulta=mysqli_query($conexion,$sql);
   
    while($fila = mysqli_fetch_array($consulta)){
        $totales+=$fila['total'];
        $pdf->SetFont('Arial','',12);
        $pdf ->Cell(60,6,iconv('UTF-8', 'ISO-8859-2',$fila['nombre']),1,0,'C',1);
        $pdf ->Cell(50,6,$fila['fecha_pago'],1,0,'C',1);
        $pdf ->Cell(30,6,$fila['fecha_inicial'],1,0,'C',1);
        $pdf ->Cell(30,6,$fila['fecha_final'],1,0,'C',1);
        $pdf ->Cell(20,6,"$".$fila['total'],1,0,'C',1);
        $pdf ->Ln(6);

    }

}else{
    $sql="SELECT nombre,fecha_pago,fecha_inicial,fecha_final,total FROM `historial_pagos_cocina` a INNER JOIN lista_servicio_cocina b ON a.id_usuario = b.id_usuario WHERE fecha_pago BETWEEN '$fechaInicial' AND '$fechaFinal'";
    $consulta=mysqli_query($conexion,$sql);
    while($fila = mysqli_fetch_array($consulta)){
        $totales+=$fila['total'];
        $nombre = $fila['nombre'];
        $pdf->SetFont('Arial','',12);
        $pdf ->Cell(60,6,iconv('UTF-8', 'ISO-8859-2',$nombre),1,0,'C',1);
        $pdf ->Cell(50,6,$fila['fecha_pago'],1,0,'C',1);
        $pdf ->Cell(30,6,$fila['fecha_inicial'],1,0,'C',1);
        $pdf ->Cell(30,6,$fila['fecha_final'],1,0,'C',1);
        $pdf ->Cell(20,6,"$".$fila['total'],1,0,'C',1);
        $pdf ->Ln(6);

    }
}
$pdf ->Ln(10);

        $pdf->SetFont('Arial','',12);
        $pdf ->Cell(20,6,"Total: ",1,0,'C',1);
        $pdf ->Cell(30,6,"$".$totales,1,0,'C',1);
        $pdf ->Ln(6);


$pdf ->Ln(20);

$pdf ->Cell(190,5,'___________________________________',0,0,'C',false);
$pdf ->Ln(5);

$pdf ->Cell(190,5,'NOMBRE Y FIRMA'  ,0,0,'C',false);


$pdf->Output("reporte.pdf","F");
?>