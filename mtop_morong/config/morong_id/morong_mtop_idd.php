<?php
require('../../fpdf/fpdf.php');

include_once '../connection.php';
include_once '../class.php';
$object = new myclass;

$object->islogin();

$data = json_decode($object->getPermitDetails($_GET['trcode'], $_GET['app'], "1"));
// $data = json_decode($object->getPermitDetails("2022-00001-F", "NEW", "1"));


if (!$data->result) {
  exit();
  // echo "<script>window.close()</script>";
}

$haha = $data->data;
$dtrel = date_create($haha->franchise_date);
$day = date_format($dtrel, "jS");
$month = date_format($dtrel, "F");
$year = date_format($dtrel, "Y");


#$pdf = new FPDF('P','mm','Letter');
$pdf = new FPDF('P','mm',array(101.6,152.4));
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);
$pdf->AddFont('Garamond','','Garamond.php');

$pdf->Image('idfront.jpg',0,0,101.6,152.4);
$y = $pdf->GetY();
$x = $pdf->GetX();

$pdf->SetMargins(11, 10 , 20);


$pdf->SetXY(55,47);
$pdf->SetFont('Garamond','',14);
//$pdf->cell(40,10,$haha->humanpin,0,0,'C');
//$pdf->cell(80,5,$haha->month,0,0,'C');


$pdf->SetTextColor(255,255,255);
$pdf->SetXY(55,62);
$pdf->SetFont('Arial','B',22.5);
$pdf->cell(33,11,$haha->franchise_no,0,0,'C');
$pdf->SetTextColor(0,0,0);

$pdf->SetY(75);
$pdf->SetFont('Arial','B',13.5);
$pdf->cell(80,5,$haha->toda,0,0,'C');

$pdf->SetY(85);
$pdf->SetFont('Arial','B',12);
$pdf->cell(80,7,$haha->fullname,0,0,'C');

$pdf->SetY(95);
$pdf->SetFont('Arial','B',12);
$pdf->cell(80,8,$haha->drivername,0,0,'C');

$pdf->SetY(106);
$pdf->SetFont('Arial','B',12);
$pdf->cell(80,8,$haha->addr,0,0,'C');
//$pdf->cell(80,8,$haha->addre,0,0,'C');

$pdf->SetY(117);
$pdf->SetFont('Arial','B',12);
$pdf->cell(80,8, date('F d, Y', strtotime($haha->birth_date)),0,0,'C');


$pdf->SetY(134);
$pdf->SetFont('Arial','B',12);
//$pdf->cell(80,5,$haha->app_name,0,0,'C');

$pdf->SetY(139);
$pdf->SetFont('Arial','',8);
//$pdf->cell(80,5,$haha->app_pos,0,0,'C');



$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

$pdf->Image('idback.jpg',0,0,101.6,152.4);

$pdf->SetXY(39,21);
$pdf->SetFont('Arial','B',12);
$pdf->cell(50,6,$haha->make,0,0,'C');
$pdf->SetXY(39,27);
$pdf->SetFont('Arial','B',12);
$pdf->cell(50,8,$haha->yearmodel,0,0,'C');
$pdf->SetXY(39,34);
$pdf->SetFont('Arial','B',12);
$pdf->cell(50,8,$haha->engine,0,0,'C');
$pdf->SetXY(39,41);
$pdf->SetFont('Arial','B',12);
$pdf->cell(57,8,$haha->chassis,0,0,'C');
$pdf->SetXY(39,48);
$pdf->SetFont('Arial','B',12);
$pdf->cell(55,8,$haha->plateno,0,0,'C');

$pdf->SetY(91);
$pdf->SetFont('Arial','B',12);
$pdf->cell(80,3,$haha->conperson,0,0,'C');

$pdf->SetY(102);
$pdf->SetFont('Arial','B',10);
$pdf->cell(80,1,$haha->conaddress,0,0,'C');

$pdf->SetY(112);
$pdf->SetFont('Arial','B',12);
$pdf->cell(80,0,$haha->conconnum,0,0,'C');

$pdf->Output();



?>