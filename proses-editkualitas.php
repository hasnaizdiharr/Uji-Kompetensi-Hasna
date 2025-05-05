<?php
include("config.php");

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $NIK = $_POST['NIK'];
    $Nama = $_POST['Nama'];
    $Kehadiran = filter_var($_POST['Kehadiran'], FILTER_VALIDATE_INT);
    $Tanggung_Jawab = filter_var($_POST['Tanggung_Jawab'], FILTER_VALIDATE_INT);
    $Kerjasama_Tim = filter_var($_POST['Kerjasama_Tim'], FILTER_VALIDATE_INT);
    $Ketepatan_Waktu = filter_var($_POST['Ketepatan_Waktu'], FILTER_VALIDATE_INT);
    $Karakter = filter_var($_POST['Karakter'], FILTER_VALIDATE_INT);

    // Validasi nilai
    $nilai = [$Kehadiran, $Tanggung_Jawab, $Kerjasama_Tim, $Ketepatan_Waktu, $Karakter];
    foreach ($nilai as $n) {
        if ($n === false || $n < 0 || $n > 100) {
            die("Input tidak valid. Nilai harus antara 0 dan 100.");
        }
    }

    // Hitung rata-rata dan kualitas
    $average = array_sum($nilai) / count($nilai);
    if ($average >= 90) {
        $kualitas = "Sangat Baik";
    } elseif ($average >= 85) {
        $kualitas = "Baik";
    } elseif ($average >= 75) {
        $kualitas = "Cukup Baik";
    } elseif ($average >= 65) {
        $kualitas = "Kurang Baik";
    } else {
        $kualitas = "Tidak Baik";
    }

    // Query UPDATE menggunakan prepared statement
    $sql = "UPDATE kualitas_karyawan 
            SET Nama = ?, Kehadiran = ?, Tanggung_Jawab = ?, Kerjasama_Tim = ?, Ketepatan_Waktu = ?, Karakter = ?, Kualitas = ?
            WHERE NIK = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "siiiiiss", $Nama, $Kehadiran, $Tanggung_Jawab, $Kerjasama_Tim, $Ketepatan_Waktu, $Karakter, $kualitas, $NIK);
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        header('Location: kualitas-karyawan.php');
        exit();
    } else {
        die("Gagal menyimpan perubahan: " . mysqli_error($db));
    }

} else {
    die("Akses dilarang...");
}
?>
