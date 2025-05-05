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
        $logoX = $marginLeft + 30 ;
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
        $this->Cell($contentWidth, 7, 'Telp: (021) 34308282| Email: valdoistbekasi@gmail.com ', 0, 1, 'C');
        $this->Ln(10);

        // Garis Header
        $this->SetDrawColor(0, 0, 0);
        $this->Line($marginLeft, 45, $pageWidth - $marginLeft, 45);
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 20);
        $this->Cell($contentWidth, 7, 'LAPORAN REKAPITULASI PENILAIAN KINERJA KARYAWAN DIVISI RECRUITMENT', 0, 1, 'C');
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
$pdf = new PDF('L', 'mm', array(500, 297));
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11);

// Header Tabel di tengah
$tabelWidth = 370;
$tabelX = ($pdf->GetPageWidth() - $tabelWidth) / 2;
$pdf->SetX($tabelX);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(10, 12, 'ID', 1, 0, 'C', true);
$pdf->Cell(25, 12, 'NIK', 1, 0, 'C', true);
$pdf->Cell(50, 12, 'Nama', 1, 0, 'C', true);
$pdf->Cell(43, 12, 'Penilaian Kehadiran', 1, 0, 'C', true);
$pdf->Cell(53, 12, 'Penilaian Tanggung Jawab', 1, 0, 'C', true);
$pdf->Cell(50, 12, 'Penilaian Kerjasama Tim', 1, 0, 'C', true);
$pdf->Cell(50, 12, 'Penilaian Ketepatan waktu', 1, 0, 'C', true);
$pdf->Cell(40, 12, 'Penilaian Karakter', 1, 0, 'C', true);
$pdf->Cell(45, 12, 'kualitas', 1, 0, 'C', true);
$pdf->Cell(50, 12, 'Waktu Input', 1, 1, 'C', true);



$pdf->SetFont('Arial', '', 13);

// Koneksi ke Database
$mysqli = new mysqli("localhost", "root", "", "admin");
if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}

// Ambil Data dari Database
$no = 1;
$tampil = $mysqli->query("SELECT * FROM kualitas_karyawan");
while ($hasil = $tampil->fetch_assoc()) {
    $pdf->SetX($tabelX);
    $pdf->Cell(10, 12, $no++, 1, 0, 'C');
    $pdf->Cell(25, 12, $hasil['NIK'], 1, 0, 'C');
    $pdf->Cell(50, 12, $hasil['Nama'], 1, 0, 'C');
    $pdf->Cell(43, 12, $hasil['Kehadiran'], 1, 0, 'C');
    $pdf->Cell(53, 12, $hasil['Tanggung_Jawab'], 1, 0, 'C');
    $pdf->Cell(50, 12, $hasil['Kerjasama_Tim'], 1, 0, 'C');
    $pdf->Cell(50, 12, $hasil['Ketepatan_Waktu'], 1, 0, 'C');
    $pdf->Cell(40, 12, $hasil['Karakter'], 1, 0, 'C');
    $pdf->Cell(45, 12, $hasil['kualitas'], 1, 0, 'C');
    $pdf->Cell(50, 12, $hasil['waktu_input'], 1, 1, 'C');

    }

// Tanda Tangan
$pdf->Ln(10);
$pdf->SetX(422);
$pdf->Cell(0, 10, 'Bekasi, ' . date('d F Y'), 0, 1, '');

$pdf->Ln(0);
$pdf->SetX(422);
$pdf->Cell(0, 10, 'Kepala Divisi Recruitment,', 0, 1);

$pdf->Ln(15);
$pdf->SetX(432);
$pdf->SetFont('', 'BU');
$pdf->Cell(0, 10, 'Kitri Nasrulloh', 0, 1);

// Output PDF
$pdf->Output();

ob_end_flush();