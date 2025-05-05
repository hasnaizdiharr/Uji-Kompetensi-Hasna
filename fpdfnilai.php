<?php
require('fpdf.php');

// Ambil data dari URL
$NIK     = $_GET['nik'] ?? 'N/A';
$Nama    = $_GET['nama'] ?? 'N/A';
$kualitas = trim($_GET['kualitas'] ?? 'N/A'); // Trim spasi ekstra
$tanggal = $_GET['waktu_input'] ?? date('d-m-Y');

$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();

// Background
if (file_exists('Desktop - 1.jpg')) {
    $pdf->Image('Desktop - 1.jpg', 0, 0, 297, 210);
}

// Logo di kiri atas
if (file_exists('valdooo.png')) {
    $pdf->Image('valdooo.png', 10, 7, 60);
}

$pdf->SetFont('Arial','B',28);
$pdf->SetTextColor(0, 43, 130);
$pdf->Cell(0, 30, 'SERTIFIKAT PENILAIAN', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',24);
$pdf->SetTextColor(0);
$pdf->Cell(0, 15, "Diberikan kepada:", 0, 1, 'C');

$pdf->SetFont('Arial','B',30);
$pdf->Cell(62); // Geser dikit
$pdf->Cell(0, 10, $Nama, 0, 1, 'C');

$pdf->SetFont('Arial','',18);
$pdf->Ln(5);
$pdf->Cell(35);
$pdf->Cell(0, 10, "NIK: $NIK", 0, 1, 'C');

// Kalimat utama
$pdf->SetFont('Arial','',16);
$pdf->Ln(5);
$pdf->MultiCell(0, 10, "Sebagai bentuk apresiasi atas dedikasi dan pencapaian kinerja yang telah ditunjukkan selama periode penilaian.", 0, 'C');

// Keterangan hasil kualitas
$pdf->Ln(2);
$pdf->SetFont('Arial','B',16);
$pdf->MultiCell(0, 10, "Hasil Penilaian: \"$kualitas\"", 0, 'C');

$pdf->Ln(25);
$pdf->SetFont('Arial','',14);
$pdf->Cell(130);
$pdf->Cell(0, 10, "Jakarta, $tanggal", 0, 1, 'C');

$pdf->Ln(20);
$pdf->Cell(130);
$pdf->Cell(0, 10, "(HR Manager)", 0, 1, 'C');

$pdf->Output('I', "Sertifikat_$Nama.pdf");
?>
