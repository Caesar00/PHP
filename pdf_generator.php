<?php
session_start();
if(isset($_SESSION['report_generator']))
{
	$report=$_SESSION['report_generator'];
}
else
{
	header("Location: gro_index.php?cont=APR&act=report");
}
session_commit();
require_once('tcpdf/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);  
$pdf->SetCreator('Murdoch HDR'); 
$pdf->SetHeaderData('',0,'','Murdoch Higher Degree by Research System',array(0,0,0),array(0,0,0)); 
$pdf->setFooterData(array(0,0,0), array(0,0,0)); 
$pdf->setHeaderFont(Array('dejavusans', '', '16')); 
$pdf->setFooterFont(Array('dejavusans', '', '10')); 
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
$pdf->SetMargins(10,25,10); 
$pdf->SetHeaderMargin(0); 
$pdf->SetFooterMargin(10); 
$pdf->SetAutoPageBreak(TRUE, 25);  
$pdf->setFontSubsetting(true); 
$pdf->SetFont('dejavusans', '', 10);
$pdf->AddPage();
$html=$report['content'];
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
$pdf->Output($report['filename'], 'I');
?>
