<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="formdaftar.css" media="screen" title="no title">
<title>Data Pribadi karyawan</title>
</head>
<body>
<header>
<h3>Daftar Data Karyawan</h3>
</header>
<form action="proses-pendaftarandata.php" method="POST">
<fieldset>
<p>
<label for="NIK">NIK: </label>
<input type="text" name="NIK" placeholder="NIK" />
</p>
<p>
<label for="Nama">Nama: </label>
<input type="text" name="Nama" placeholder="Nama" />
</p>
<p>
<label for="Alamat">Alamat: </label>
<input type="text" name="Alamat" placeholder="Alamat" />
</p>
<p>
<label for="No_Rek">Nomor Rekening: </label>
<input type="text" name="No_Rek" placeholder="Nomor Rekening" />
</p>
<p>
<input type="submit" value="Daftar" name="daftar" />
</p>
</fieldset>
</form>
</body>
</html>