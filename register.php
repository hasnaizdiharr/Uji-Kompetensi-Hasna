<?php
require 'config.php';

// Ambil data jika NIK dipilih
$selected_nik = isset($_POST['NIK']) ? $_POST['NIK'] : '';
$karyawan_data = null;

if (!empty($selected_nik)) {
    $stmt = mysqli_prepare($db, "SELECT Nama, Alamat FROM data_karyawan WHERE NIK = ?");
    mysqli_stmt_bind_param($stmt, "s", $selected_nik);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $karyawan_data = mysqli_fetch_assoc($result);
}

// Proses saat form register dikirim
if (isset($_POST["register"])) {
    $NIK = $_POST["NIK"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Email = $_POST["Email"];
    $Divisi = $_POST["Divisi"];

    // Ambil nama dari data_karyawan
    $Nama = '';
    if (!empty($NIK)) {
        $stmt = mysqli_prepare($db, "SELECT Nama FROM data_karyawan WHERE NIK = ?");
        mysqli_stmt_bind_param($stmt, "s", $NIK);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $Nama = $row['Nama'];
    }

    // Upload foto
    $profilee = ''; // default kosong

    if (isset($_FILES['profilee']) && $_FILES['profilee']['error'] === 0) {
        $file_name = $_FILES['profilee']['name'];
        $file_tmp = $_FILES['profilee']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = uniqid('IMG_', true) . '.' . $file_ext;
            $upload_path = 'uploads/' . $new_file_name;

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $profilee = $new_file_name;
            } else {
                $upload_error = "Gagal meng-upload file.";
            }
        } else {
            $upload_error = "Format file tidak diizinkan.";
        }
    } else {
        $upload_error = "File tidak dipilih atau terjadi kesalahan upload.";
    }

    if (empty($upload_error)) {
        $query_sql = "INSERT INTO user_register (NIK, Username, Password, Email, Divisi, profilee)
                      VALUES ('$NIK', '$Username', '$Password', '$Email', '$Divisi', '$profilee')";

        if (mysqli_query($db, $query_sql)) {
            header("Location: userlogin.php");
            exit();
        } else {
            $upload_error = "Pendaftaran gagal: " . mysqli_error($db);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="register.css">
    <style>
        body {
            background-image: url('Desktop - 1.jpg');
            font-family: Poppins, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 20px;
            background-size: cover;
        }

        .profile-container {
            background: #fefefee9;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: auto;
        }

        .box-input {
            display: block;
            text-align: left;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .btn-input {
            padding: 10px 20px;
            background-color: #f4bf3d;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .bottom {
            margin-top: 15px;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <h1>REGISTER</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="box-input">
                <select name="NIK" onchange="this.form.submit()" required>
                    <option value="">-- Pilih NIK --</option>
                    <?php
                    $query = "SELECT NIK, Nama FROM data_karyawan";
                    $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $selected = ($row['NIK'] === $selected_nik) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row['NIK']) . "' $selected>"
                            . htmlspecialchars($row['NIK'] . " - " . $row['Nama']) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="box-input">
                <input type="text" name="Username" placeholder="Username" required>
            </div>
            <div class="box-input">
                <input type="password" name="Password" placeholder="Password" required>
            </div>
            <div class="box-input">
                <input type="text" name="Email" placeholder="Email" required>
            </div>
            <div class="box-input">
    <label for="Divisi">Divisi:</label>
    <input type="text" name="Divisi" value="Recruitment" readonly>
</div>
            <div class="box-input">
                <label for="foto">Upload Foto Profil:</label><br>
                <input type="file" name="profilee" id="foto" accept="image/*" required><br><br>
            </div>

            <button type="submit" name="register" class="btn-input">Register</button>

            <div class="bottom">
                <p>Sudah punya akun? <a href="userlogin.php">Login disini</a></p>
            </div>
        </form>

        <?php if (isset($upload_error)) : ?>
            <div class="error-message"><?php echo $upload_error; ?></div>
        <?php endif; ?>
    </div>
</body>

</html>
