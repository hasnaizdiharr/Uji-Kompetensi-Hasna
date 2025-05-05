<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config.php");

// Inisialisasi variabel
$nik = isset($_POST['NIK']) ? $_POST['NIK'] : '';
$employee = null;
$hasil_kualitas = '';
$average = null;

// Ambil data karyawan jika NIK dipilih
if ($nik) {
    $query = "SELECT * FROM data_karyawan WHERE NIK = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $nik);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $employee = mysqli_fetch_assoc($result);
}
if (isset($_POST['daftar'])) {
    // Ambil data dari formulir
    $Nama = $_POST['Nama'];
    $Kehadiran = filter_var($_POST['Kehadiran'], FILTER_VALIDATE_INT);
    $Tanggung_Jawab = filter_var($_POST['Tanggung_Jawab'], FILTER_VALIDATE_INT);
    $Kerjasama_Tim = filter_var($_POST['Kerjasama_Tim'], FILTER_VALIDATE_INT);
    $Ketepatan_Waktu = filter_var($_POST['Ketepatan_Waktu'], FILTER_VALIDATE_INT);
    $Karakter = filter_var($_POST['Karakter'], FILTER_VALIDATE_INT);

  
    $nilai = [$Kehadiran, $Tanggung_Jawab, $Kerjasama_Tim, $Ketepatan_Waktu, $Karakter];
    foreach ($nilai as $n) {
        if ($n === false || $n < 0 || $n > 100) {
            die("Input tidak valid. Nilai harus antara 0 dan 100.");
        }
    }

    $check_sql = "SELECT COUNT(*) FROM kualitas_karyawan WHERE NIK = ? AND MONTH(waktu_input) = MONTH(CURRENT_DATE()) AND YEAR(waktu_input) = YEAR(CURRENT_DATE())";
    $check_stmt = mysqli_prepare($db, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $nik);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_bind_result($check_stmt, $count);
    mysqli_stmt_fetch($check_stmt);
    mysqli_stmt_close($check_stmt);

    if ($count > 0) {
        echo "<script>alert('Penilaian untuk NIK ini sudah dilakukan bulan ini.'); window.location.href='kualitas-karyawan.php';</script>";
        exit();
    }

    // Hitung rata-rata dan kualitas
    $average = array_sum($nilai) / count($nilai);
    if ($average >= 90) {
        $hasil_kualitas = "Sangat Baik";
    } elseif ($average >= 85) {
        $hasil_kualitas = "Baik";
    } elseif ($average >= 75) {
        $hasil_kualitas = "Cukup Baik";
    } elseif ($average >= 65) {
        $hasil_kualitas = "Kurang Baik";
    } else {
        $hasil_kualitas = "Tidak Baik";
    }

    // Simpan ke database
    $sql = "INSERT INTO kualitas_karyawan (NIK, Nama, Kehadiran, Tanggung_Jawab, Kerjasama_Tim, Ketepatan_Waktu, Karakter, Kualitas, waktu_input) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "ssiiiiis", $nik, $Nama, $Kehadiran, $Tanggung_Jawab, $Kerjasama_Tim, $Ketepatan_Waktu, $Karakter, $hasil_kualitas);
    $query = mysqli_stmt_execute($stmt);

    if ($query) {
        echo "<script>alert('Data berhasil disimpan!'); window.location.href='kualitas-karyawan.php';</script>";
        exit();
    } else {
        die("Query gagal: " . mysqli_error($db));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Kinerja Karyawan</title>
  <link rel="stylesheet" href="daftarkualitass.css">
</head>
<body>

<header>
  <h3>Tambah Hasil Kinerja Karyawan</h3>
</header>

<form action="" method="POST" id="myForm">
  <fieldset>
    <p>
      <label for="NIK">NIK: </label>
      <select name="NIK" id="NIK" onchange="document.getElementById('myForm').submit()">
        <option value="">Pilih NIK</option>
        <?php
        $query = "SELECT NIK FROM data_karyawan";
        $result = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $selected = $row['NIK'] == $nik ? 'selected' : '';
            echo "<option value='".htmlspecialchars($row['NIK'])."' $selected>".htmlspecialchars($row['NIK'])."</option>";
        }
        ?>
      </select>
    </p>

    <?php if ($nik && $employee): ?>
    <p>
      <label for="Nama">Nama: </label>
      <input type="text" name="Nama" value="<?php echo htmlspecialchars($employee['Nama']); ?>" readonly />
    </p>
    <p>
      <label for="Alamat">Alamat: </label>
      <input type="text" name="Alamat" value="<?php echo htmlspecialchars($employee['Alamat']); ?>" readonly />
    </p>
    <p>
      <label for="No_Rek">No Rekening: </label>
      <input type="text" name="No_Rek" value="<?php echo htmlspecialchars($employee['No_Rek']); ?>" readonly />
    </p>
    <?php endif; ?>

    <p>
      <label for="Kehadiran">Kehadiran: </label>
      <input type="text" name="Kehadiran" placeholder="Masukkan nilai Kehadiran" min="0" max="100" required />
    </p>
    <p>
      <label for="Tanggung_Jawab">Tanggung Jawab: </label>
      <input type="text" name="Tanggung_Jawab" placeholder="Masukkan nilai Tanggung Jawab" min="0" max="100" required />
    </p>
    <p>
      <label for="Kerjasama_Tim">Kerjasama Tim: </label>
      <input type="text" name="Kerjasama_Tim"  placeholder="Masukkan nilai Kerjasama Tim" min="0" max="100" required />
    </p>
    <p>
      <label for="Ketepatan_Waktu">Ketepatan Waktu: </label>
      <input type="text" name="Ketepatan_Waktu" placeholder="Masukkan nilai Ketepatan Waktu" min="0" max="100" required />
    </p>
    <p>
      <label for="Karakter">Karakter: </label>
      <input type="text" name="Karakter" placeholder="Masukkan nilai Karakter" min="0" max="100" required />
    </p>

    <p>
      <input type="submit" name="daftar" value="Daftar" />
    </p>

    <?php if (!empty($hasil_kualitas)): ?>
    <p>
      <strong>Rata-rata:</strong> <?php echo number_format($average, 2); ?><br>
      <strong>Kualitas:</strong> <?php echo htmlspecialchars($hasil_kualitas); ?>
    </p>
    <?php endif; ?>
    
  </fieldset>
</form>

</body>
</html>
