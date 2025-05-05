<?php
include("config.php");
// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan'])){
    // ambil data dari formulir
    $NIK = $_POST['NIK'];
    $Nama = $_POST['Nama'];
    $Alamat = $_POST['Alamat'];
    $Norek = $_POST['No_Rek'];
    
    // buat query update
    $sql = "UPDATE data_karyawan SET Nama='$Nama', Alamat='$Alamat',
    No_Rek='$Norek' WHERE NIK=$NIK";
    $query = mysqli_query($db, $sql);
    // apakah query update berhasil?
    if( $query ) {
    // kalau berhasil alihkan ke halaman list-siswa.php
    header('Location: Data-pribadi.php');
    } else {
    // kalau gagal tampilkan pesan
    die("Gagal menyimpan perubahan...");
    }
    } else {
    die("Akses dilarang...");
    }
    ?>