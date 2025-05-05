<?php
session_start();
require 'config.php';

$admin = isset($_SESSION['NIK']) ? $_SESSION['NIK'] : ''; 

if ($admin) {
    $query = "SELECT NIK, Username, Email, Divisi, profilee FROM user_register WHERE NIK = '$admin'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['Username'] = $user_data['Username'];
        $_SESSION['Email'] = $user_data['Email'];
        $_SESSION['Divisi'] = $user_data['Divisi'];
        $_SESSION['profilee'] = $user_data['profilee'];
    } 
    $query_kualitas = "SELECT kualitas FROM kualitas_karyawan WHERE NIK = '$admin'";
    $result_kualitas = mysqli_query($db, $query_kualitas);

    if ($result_kualitas && mysqli_num_rows($result_kualitas) > 0) {
        $kualitas_data = mysqli_fetch_assoc($result_kualitas);
        $_SESSION['kualitas'] = $kualitas_data['kualitas'];
    } 
    else {
        echo "Data tidak ditemukann";
    }
} else {
    echo "Session NIK tidak ditemukan.";
}
?>
