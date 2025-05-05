<?php
require 'config.php'; 
session_start();

$NIK = $_POST["NIK"];
$Password = $_POST["Password"];

$query_sql = "SELECT * FROM user_register WHERE NIK = '$NIK' AND Password = '$Password'";
$result = mysqli_query($db, $query_sql);

if (mysqli_num_rows($result) > 0) {
    // Jika login berhasil, simpan NIK ke dalam session
    $_SESSION['NIK'] = $NIK;
    header("Location: homeuser.php");
    exit();
} else {
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
                window.location.href = "userlogin.php";
            });
        </script>
    </body>
    </html>';
}
?>
