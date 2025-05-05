<?php
require 'config.php';
$Nama = $_POST["Nama"];
$Password = $_POST["Password"];

$query_sql = "SELECT * FROM admins
             where Nama = '$Nama' AND Password = '$Password'";

 $result = mysqli_query($db, $query_sql);
 
 if (mysqli_num_rows($result) > 0) {
    header("location: kinerjakaryawan.php");
 } else{
   echo '
   <html>
   <head>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   </head>
   <body>
       <script>
           Swal.fire({
               icon: "error",
               title: "Login Gagal",
               text: "Nama atau Password salah!",
               confirmButtonText: "Coba Lagi"
           }).then(function() {
               window.location.href = "admin2login.html";
           });
       </script>
   </body>
   </html>';
 }