<?php
include("config.php");
// kalau tidak ada id di query string
if( !isset($_GET['NIK']) ){
    header('Location: kualitas-karyawan.php');
    exit();
    }
    //ambil id dari query string
    $NIK = $_GET['NIK'];
    // buat query untuk ambil data dari database
    $sql = "SELECT * FROM kualitas_karyawan WHERE NIK=$NIK";
    $query = mysqli_query($db, $sql);
    $karyawan = mysqli_fetch_assoc($query);
// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
    }
    ?>
    
    <!DOCTYPE html>
    <html>
    <head>
    <link rel="stylesheet" href="daftarkualitass.css" media="screen" title="no title">
    <title>Formulir Edit Kinerja Karyawan</title>
    </head>
    <body>
    <header>
    <h3>Formulir Edit Kinerja Karyawan</h3>
    </header>
    <form action="proses-editkualitas.php" method="POST">
    <fieldset>
    <input type="hidden" name="NIK" value="<?php echo $karyawan['NIK']
    ?>" />
    <p>
    <label for="Nama">Nama: </label>
    <input type="text" name="Nama" placeholder="Nama lengkap"
    value="<?php echo $karyawan['Nama'] ?>" />
    </p>
    <p>
    <label for="Kehadiran">Nilai Kehadiran: </label>
    <input type="text" name="Kehadiran" placeholder="Kehadiran" value="<?php echo $karyawan['Kehadiran']?>"/>
</p>
<p>
    <label for="Tanggung_Jawab">Nilai Tanggung Jawab: </label>
    <input type="text" name="Tanggung_Jawab" placeholder="Tanggung Jawab" value="<?php echo $karyawan['Tanggung_Jawab']?>"/>
</p>
<p>
    <label for="Kerjasama_Tim">Nilai Kerjasama Tim: </label>
    <input type="text" name="Kerjasama_Tim" placeholder="Kerjasama Tim" value="<?php echo $karyawan['Kerjasama_Tim']?>"/>
</p>
<p>
    <label for="Ketepatan_Waktu">Nilai Ketepatan Waktu: </label>
    <input type="text" name="Ketepatan_Waktu" placeholder="Ketepatan Waktu" value="<?php echo $karyawan['Ketepatan_Waktu']?>"/>
</p>
<p>
    <label for="Karakter">Nilai Karakter: </label>
    <input type="text" name="Karakter" placeholder="Karakter" value="<?php echo $karyawan['Karakter']?>"/>
</p>
<p>
    <input type="submit" value="Simpan" name="simpan" class="btn btn-dark" />
</p>
</fieldset>
</form>
</body>
</html>