<?php
session_start();
require 'config.php';

$admin = isset($_SESSION['NIK']) ? $_SESSION['NIK'] : '';

if($admin) {
    $query= "SELECT NIK, Nama, Divisi, Kehadiran, Tanggung_Jawab, Kerjasama_Tim, Ketepatan_Waktu, Karakter, kualitas, waktu_input FROM kualitas_karyawan WHERE NIK = '$admin'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['NIK'] = $user_data['NIK'];
        $_SESSION['Nama'] = $user_data['Nama'];
        $_SESSION['Divisi'] = $user_data['Divisi'];
        $_SESSION['Kehadiran'] = $user_data['Kehadiran'];
        $_SESSION['Tanggung_Jawab'] = $user_data['Tanggung_Jawab'];
        $_SESSION['Kerjasama_Tim'] = $user_data['Kerjasama_Tim'];
        $_SESSION['Ketepatan_Waktu'] = $user_data['Ketepatan_Waktu'];
        $_SESSION['Karakter'] = $user_data['Karakter'];
        $_SESSION['kualitas'] = $user_data['kualitas'];
        $_SESSION['waktu_input'] = $user_data['waktu_input'];
    } else {
        echo "Data tidak ditemukan";
    }
} else {
    echo "Session NIK tidak ditemukan.";
}




