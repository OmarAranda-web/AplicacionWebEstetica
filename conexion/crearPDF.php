<?php
 require('../fpdf/fpdf.php');
 require('./conexion.php');

 $cita=$_GET['cita'];




 class PDF extends FPDF
{
// Cabecera de página
function Header()
{
     // Logo
     $this->Image('LogoBlack.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
   
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


$query="
SELECT
	servicio.nombre_servicio, 
	servicio.precio
FROM
	cita
	INNER JOIN
	detalle_cita
	ON 
		cita.id_cita = detalle_cita.id_cita_dcita
	INNER JOIN
	servicio
	ON 
		detalle_cita.id_servicio_dcita = servicio.id_servicio
	
WHERE
	cita.id_cita='$cita'
";

$resultado=mysqli_query($db,$query);

$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

$uqeryData="
SELECT upper(alias),total_cita from cita where
cita.id_cita='$cita'
";

$res=mysqli_query($db,$uqeryData);
$data=mysqli_fetch_array($res);


 // Título
 $pdf->Cell(70,10,'DETALLE DE LA CITA '.$data[0],0,0,'C');
 // Salto de línea
 $pdf->Ln(40);

 $pdf->Cell(80,10,'SERVICIO',1,0,'C',0);
 $pdf->Cell(80,10,'PRECIO',1,1,'C',0);


while ($servicio=mysqli_fetch_array($resultado)) {
    $pdf->Cell(80,10,$servicio[0],1,0,'C',0);
    $pdf->Cell(80,10,$servicio[1],1,1,'C',0);
}

// Salto de línea
$pdf->Ln(20);



// Título
$pdf->Cell(230,10,'Total$:'.$data[1],0,0,'C');

$pdf->Output();
?>