<?php
include("config.php");
if (isset($_GET['NIK'])) {
    // ambil id dari query string
    $NIK = $_GET['NIK'];
    // buat query hapus
    $sql = "DELETE FROM data_karyawan WHERE NIK=$NIK";
    $query = mysqli_query($db, $sql);
    // apakah query hapus berhasil?
    if ($query) {
        header('Location: Data-pribadi.php');
    } else {
        die("gagal menghapus...");
    }
} else {
    die("akses dilarang...");
}
?>