<?php

$pdf->AliasNbPages();
$pdf->AddPage();

$companyName = $company['DS_EMPRESA'];
$secretaryName = $company['SECRETARIA_EDUCACAO'];
$state = $company['NOME_UF'];

$ufSchool = 'AL';
$schoolCity = explode("PREFEITURA MUNICIPAL DE ", $company['DS_EMPRESA'])[1];

$cityCoatOfArms = "http://capela.praxisescola.com.br/imagens/brasao_municipio.jpg";
$stateCoatOfArms = "http://capela.praxisescola.com.br/imagens/brasao_estado.jpg";

$pdf->SetFont('Arial','',10);
define('FPDF_FONTPATH','font/');

#PADRONIZANDO O CABEÇALHO DOS RELATÓRIOS#
$pdf->Image($stateCoatOfArms, 280, 15, 40);
$pdf->Image($cityCoatOfArms, 40, 20, 60);
$pdf->Ln(34);
$pdf->Cell(550, 15, utf8_decode($state), 0, 0, 'C');
$pdf->Ln(15);
$pdf->Cell (550, 15, utf8_decode($companyName),0,0, 'C');
$pdf->Ln(15);
$pdf->Cell (550, 15, utf8_decode($secretaryName),0,0, 'C');
$pdf->Ln(15);
$pdf->Cell (550, 15, utf8_decode($school),0,0, 'C');
$pdf->Ln(15);
$pdf->Cell (535, 15, utf8_decode('------------------------------------------------------------------------------------------------------------------------------------------------------------------'),0,0, 'C');
$pdf->Ln(15);

setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );             
$dateNow = strftime( ' %d de %B de %Y', strtotime(date( 'Y-m-d'))); // DATA ATUAL       
$locale = $schoolCity.' - '. $ufSchool .', '.$dateNow.'.';

#NOME DO RELATÓRIO#
$pdf->SetFont('Times','B', 14);
$pdf->Cell(550, 15, utf8_decode('TURMAS - ' . $classes[0]->DS_ANO_LETIVO), 0, 1,'C');
$pdf->Ln(15);
$pdf->SetFont('Times','B', 8);
$pdf->Cell(130, 14, utf8_decode("TURMA"), 1, 0, 'C');
$pdf->Cell(155, 14, utf8_decode("ETAPA"), 1, 0, 'C');
$pdf->Cell(80, 14, utf8_decode("TURNO"), 1, 0, 'C');
$pdf->Cell(90, 14, utf8_decode("PERÍODO LETIVO"), 1, 0, 'C');
$pdf->Cell(85, 14, utf8_decode("SITUAÇÃO"), 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Times','', 8);

foreach ($classes as $class) {
  $pdf->Cell(130, 14, utf8_decode($class->DS_TURMA), 1, 0, 'C');
  $pdf->Cell(155, 14, utf8_decode($class->DS_ETAPA), 1, 0, 'C');
  $pdf->Cell(80, 14, utf8_decode($class->DS_TURNO), 1, 0, 'C');
  $pdf->Cell(90, 14, utf8_decode($class->DS_SUB_PERIODO), 1, 0, 'C');
  $pdf->Cell(85, 14, utf8_decode($class->DS_STATUS), 1, 0, 'C');
  $pdf->Ln();
}

$totalCountClasses = count($classes);

$pdf->Ln();
$pdf->SetFont('Times', 'I', 10);
$pdf->Ln(6);
$pdf->Cell(540, 15, utf8_decode('Total de Turmas da Escola: '. $totalCountClasses), 0, 0, 'R');
$pdf->Ln(20);
$pdf->Cell(540, 15, utf8_decode($locale), 0, 0, 'R');

?>
