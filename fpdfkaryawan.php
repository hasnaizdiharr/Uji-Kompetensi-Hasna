<?php
ob_start(); // Mulai output buffering

include "fpdf.php";

class PDF extends FPDF {
    // Header untuk kop surat
    function Header() {
        $pageWidth = $this->GetPageWidth();
        $marginLeft = 10;
        $contentWidth = $pageWidth - ($marginLeft * 2);

        // Logo
        $logoWidth = 60;
        $logoX = $marginLeft + 30;
        $logoY = 7;
        if (file_exists('valdoo.png')) {
            $this->Image('valdoo.png', $logoX, $logoY, $logoWidth);
        } else {
            $this->SetFont('Arial', 'I', 10);
            $this->Cell(0, 10, 'Logo tidak ditemukan', 0, 1, 'L');
        }

        // Nama Perusahaan dan Alamat di tengah
        $this->SetXY($marginLeft, 15);
        $this->SetFont('Arial', 'B', 30);
        $this->Cell($contentWidth, 7, 'PT Valdo Sumber Daya Mandiri', 0, 1, 'C');
        $this->Ln(5); // Tambahkan jarak antara nama perusahaan dan alamat
        $this->SetFont('Arial', '', 13);
        $this->Cell($contentWidth, 7, 'Jl. Cut Mutia Blk. C No.3, RT.001/RW.009, Margahayu, Kec. Bekasi Tim., Kota Bks, Jawa Barat 17113', 0, 1, 'C');
        $this->Cell($contentWidth, 7, 'Telp: (021) 34308282| Email: info@dci.co.id', 0, 1, 'C');
        $this->Ln(10);

        // Garis Header
        $this->SetDrawColor(0, 0, 0);
        $this->Line($marginLeft, 45, $pageWidth - $marginLeft, 45);
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 20);
        $this->Cell($contentWidth, 7, 'LAPORAN DATA KARYAWAN DIVISI RECRUITMENT', 0, 1, 'C');
        $this->Ln(10);
    }

    // Footer
    function Footer() {
        $this->SetY(-15);
        $this->SetDrawColor(0, 0, 0);
        $this->Line(10, $this->GetY(), $this->GetPageWidth() - 10, $this->GetY());
        $this->SetFont('Arial', 'I', 8);

        // Tambahkan divisi di kiri bawah
        $this->SetX(10);
        $this->Cell(0, 10, 'Divisi: Recruitment', 0, 0, 'L');

        // Pindahkan nomor halaman ke kanan bawah
        $this->SetX(-40);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'R');
    }
}

// Membuat PDF baru
$pdf = new PDF('L', 'mm', 'A3');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Header Tabel di tengah
$tabelWidth = 250;
$tabelX = ($pdf->GetPageWidth() - $tabelWidth) / 2;
$pdf->SetX($tabelX);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(15, 12, 'ID', 1, 0, 'C', true);
$pdf->Cell(60, 12, 'NIK', 1, 0, 'C', true);
$pdf->Cell(60, 12, 'Nama', 1, 0, 'C', true);
$pdf->Cell(60, 12, 'Alamat', 1, 0, 'C', true);
$pdf->Cell(45, 12, 'Nomor Rekening', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 11);

// Koneksi ke Database
$mysqli = new mysqli("localhost", "root", "", "admin");
if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}

// Ambil Data dari Database
$no = 1;
$tampil = $mysqli->query("SELECT * FROM data_karyawan");
while ($hasil = $tampil->fetch_assoc()) {
    $pdf->SetX($tabelX);
    $pdf->Cell(15, 12, $no++, 1, 0, 'C');
    $pdf->Cell(60, 12, $hasil['NIK'], 1, 0, 'C');
    $pdf->Cell(60, 12, $hasil['Nama'], 1, 0, 'C');
   
    $pdf->Cell(60, 12, $hasil['Alamat'], 1, 0, 'C');
    $pdf->Cell(45, 12, $hasil['No_Rek'], 1, 1, 'C');
}

// Tanda Tangan
$pdf->Ln(10);
$pdf->SetX(280);
$pdf->Cell(0, 10, 'Bekasi, ' . date('d F Y'), 0, 1, '');

$pdf->Ln(0);
$pdf->SetX(280);
$pdf->Cell(0, 10, 'Kepala Divisi Recruitment,', 0, 1);

$pdf->Ln(20);
$pdf->SetX(290);
$pdf->SetFont('', 'BU');
$pdf->Cell(0, 10, 'Kitri Nasrulloh', 0, 1);

// Output PDF
$pdf->Output();

ob_end_flush();