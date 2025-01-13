<?php
require('certificado/fpdf/fpdf.php');

// Dados do certificado
$nomeAluno = "João da Silva"; // Substitua por uma variável dinâmica
$nomeProjeto = "Desenvolvimento Web Full Stack"; // Substitua por uma variável dinâmica
$cargaHoraria = 40; // Substitua pela carga horária total
$dataAtual = date("d/m/Y");

// Criando o PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Cabeçalho
$pdf->SetXY(10, 10);
$pdf->Cell(190, 20, "CERTIFICADO DE PARTICIPAÇÃO", 0, 1, 'C');

// Corpo do certificado
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(20);
$texto = "Certificamos que o(a) aluno(a) $nomeAluno participou do projeto \"$nomeProjeto\", com carga horária total de $cargaHoraria horas, conforme os parâmetros definidos no projeto.";
$pdf->MultiCell(0, 10, $texto, 0, 'J');

$pdf->Ln(20);
$pdf->MultiCell(0, 10, "A sua dedicação e esforço são dignos de reconhecimento. Parabéns pelo desempenho!", 0, 'J');

// Assinatura e data
$pdf->Ln(30);
$pdf->Cell(0, 10, "Emitido em: $dataAtual", 0, 1, 'L');
$pdf->Ln(10);
$pdf->Cell(0, 10, "_________________________", 0, 1, 'L');
$pdf->Cell(0, 10, "Coordenador do Projeto", 0, 1, 'L');

// Rodapé
$pdf->SetY(-30);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, "Certificado gerado automaticamente pelo sistema.", 0, 0, 'C');

// Salvar o PDF
$pdf->Output('I', 'Certificado.pdf');
?>
