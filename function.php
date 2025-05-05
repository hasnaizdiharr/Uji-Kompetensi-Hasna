<?php
$conn = mysqli_connect("localhost","root","","admin");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
       $row[] = $row;
    }
    return $rows;
}
function cari($NIK) {
    $query = "select * from kualitas_karyawan where NIK = '$NIK'";
    return query($query);
}
