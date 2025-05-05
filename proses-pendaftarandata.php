<?php
include("config.php");
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){
// ambil data dari formulir
$NIK = $_POST['NIK'];
$Nama = $_POST['Nama'];
$Alamat = $_POST['Alamat'];
$Norek = $_POST['No_Rek'];
// buat query
$sql = "INSERT INTO data_karyawan (NIK, Nama, Alamat, No_Rek) VALUE ('$NIK', '$Nama', '$Alamat', '$Norek')";
$query = mysqli_query($db, $sql);
// apakah query simpan berhasil?
if( $query ) {
// kalau berhasil alihkan ke halaman index.php dengan status=sukses
header('Location: Data-pribadi.php?status=sukses');
} else {
// kalau gagal alihkan ke halaman indek.php dengan status=gagal
header('Location: Data-pribadi.php?status=gagal');
}
} else {
die("Akses dilarang...");
}
?>