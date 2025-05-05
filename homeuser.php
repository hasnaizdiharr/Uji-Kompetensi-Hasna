<?php
session_start();
require 'config.php';

// Ambil data user dan kualitas dari DB
if (isset($_SESSION['NIK'])) {
    $admin = $_SESSION['NIK'];

    // Ambil data user
    $query = "SELECT NIK, Username, Email, Divisi, profilee FROM user_register WHERE NIK = '$admin'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $_SESSION['Username'] = $user_data['Username'];
        $_SESSION['Email'] = $user_data['Email'];
        $_SESSION['Divisi'] = $user_data['Divisi'];
        $_SESSION['profilee'] = $user_data['profilee'];
    }

    // Ambil data kualitas
    $query_kualitas = "SELECT kualitas FROM kualitas_karyawan WHERE NIK = '$admin'";
    $result_kualitas = mysqli_query($db, $query_kualitas);

    if ($result_kualitas && mysqli_num_rows($result_kualitas) > 0) {
        $kualitas_data = mysqli_fetch_assoc($result_kualitas);
        $_SESSION['kualitas'] = $kualitas_data['kualitas'];
    }
}

// Proses upload foto profil
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $nik = $_SESSION['NIK'];
    $foto = $_FILES['foto'];
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $filename = $foto['name'];
    $tmp_name = $foto['tmp_name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($ext, $allowed)) {
        if ($foto['size'] <= 2 * 1024 * 1024) {
            $new_filename = uniqid() . '.' . $ext;
            $destination = __DIR__ . '/' . $new_filename;

            if (move_uploaded_file($tmp_name, $destination)) {
                $query = "UPDATE user_register SET profilee='$new_filename' WHERE NIK='$nik'";
                if (mysqli_query($db, $query)) {
                    $_SESSION['profilee'] = $new_filename;
                    header("Location: homeuser.php");
                    exit();
                } else {
                    $upload_error = "Gagal update ke database.";
                }
            } else {
                $upload_error = "Gagal upload file.";
            }
        } else {
            $upload_error = "Ukuran gambar maksimal 2MB.";
        }
    } else {
        $upload_error = "Format file tidak didukung.";
    }
}
?>

<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e9ecef;
        margin: 0;
        background-image: url('Desktop - 1.jpg');
        background-size: cover;
        background-repeat: no-repeat;
    }

    .profile-container {
        background: #ffffff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        margin-top: 120px;
        margin-left: 500px;
    }

    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .profile-header img {
        border-radius: 50%;
        width: 120px;
        height: 120px;
        margin-left: 20px;
    }

    .profile-info {
        border-top: 1px solid #dee2e6;
        padding-top: 10px;
    }

    .profile-info p {
        margin: 5px 0;
    }

    .edit-button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        text-align: center;
    }

    .logout-button {
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
        color: white;
        background-color: #484C7F;
    }

    .upload-form {
        margin-top: 15px;
    }

    .upload-form input[type="file"] {
        margin-top: 10px;
    }

    .error-message {
        color: red;
        margin-top: 10px;
    }
    </style>
</head>

<body>

<?php
// Warna dinamis untuk kualitas
$kualitas = strtolower(trim($_SESSION['kualitas'] ?? ''));
$warna = '';

switch ($kualitas) {
    case 'sangat baik':
        $warna = 'background-color: #28a745; color: white; padding: 5px 10px; border-radius: 5px;';
        break;
    case 'baik':
        $warna = 'background-color: #007bff; color: white; padding: 5px 10px; border-radius: 5px;';
        break;
    case 'cukup':
    case 'cukup baik':
        $warna = 'background-color: #ffc107; color: black; padding: 5px 10px; border-radius: 5px;';
        break;
    case 'kurang':
    case 'tidak baik':
        $warna = 'background-color:rgb(234, 10, 32); color: white; padding: 5px 10px; border-radius: 5px;';
        break;
    default:
        $warna = 'background-color:rgb(10, 0, 1); color: white; padding: 5px 10px; border-radius: 5px;';
        break;
}
?>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-info" style="flex: 1;">
                <h2><?php echo $_SESSION['Username'] ?? "Data tidak valid."; ?></h2>
            </div>
            <div class="profile-picture">
                <img src="uploads/<?php echo $_SESSION['profilee']; ?>" alt="Foto Profil">
            </div>
        </div>

        <div class="profile-info">
            <h3>Informasi Pengguna</h3>
            <p>NIK: <?php echo $_SESSION['NIK'] ?? "Data tidak valid."; ?></p>
            <p>Email: <?php echo $_SESSION['Email'] ?? "Data tidak valid."; ?></p>
            <p>Divisi: <?php echo $_SESSION['Divisi'] ?? "Data tidak valid."; ?></p>
            <p>Kualitas Kinerja anda: <span style="<?php echo $warna; ?>"><?php echo $_SESSION['kualitas'] ?? "Data tidak valid."; ?></span></p>
        </div>
    </div>

</body>
</html>
