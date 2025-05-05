<?php
include("config.php");
// kalau tidak ada id di query string
if( !isset($_GET['NIK']) ){
    header('Location: Data-pribadi.php');
    exit();
    }
    //ambil id dari query string
    $NIK = $_GET['NIK'];
    // buat query untuk ambil data dari database
    $sql = "SELECT * FROM data_karyawan WHERE NIK=$NIK";
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
    <link rel="stylesheet" href="formedit.css" media="screen" title="no title">
    <title>Formulir Edit Data Karyawan</title>
    </head>
    <body>
    <header>
    <h3>Formulir Edit Data Karyawan</h3>
    </header>
    <form action="proses-editdata.php" method="POST">
    <fieldset>
    <input type="hidden" name="NIK" value="<?php echo $karyawan['NIK']
    ?>" />
    <p>
    <label for="Nama">Nama: </label>
    <input type="text" name="Nama" placeholder="Nama lengkap"
    value="<?php echo $karyawan['Nama'] ?>" />
    </p>
    <p>
    <label for="Alamat">Alamat: </label>
    <input type="text" name="Alamat" placeholder="Alamat" value="<?php echo $karyawan ['Alamat'] ?>" />
    </p>
    <p>
    <label for="No_Rek">Nomor Rekening: </label>
    <input type="text" name="No_Rek" placeholder="Nomor rekening" value="<?php echo $karyawan['No_Rek']?>"/>
</p>
<p>
    <input type="submit" value="Simpan" name="simpan" class="btn btn-dark" />
</p>
</fieldset>
</form>
</body>
</html>