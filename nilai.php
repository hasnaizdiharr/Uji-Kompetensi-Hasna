<?php include("kualitass.php"); ?>
<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Penilaian Kinerja Karyawan</title>
<style>
       body {
        font-family: Arial, sans-serif;
        background-color: #e9ecef;
        margin: 0;
        background-image: url('Desktop - 1.jpg'); /* Sesuaikan dengan background */
        background-size: cover;
    }

    .container {
    background: rgba(255, 255, 255, 0.9); /* Transparan sedikit agar menyatu dengan background */
    border-radius: 10px;
    padding: 30px;  /* Menambahkan padding agar konten tidak terlalu rapat */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 1200px;  /* Meningkatkan lebar maksimal container */
    margin: 50px auto;
}

    h2 {
        text-align: center;
        color:rgb(0, 43, 130); /* Warna lebih kontras dengan background */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: rgba(255, 255, 255, 0.85); /* Warna transparan agar menyatu */
    }

    table, th, td {
        border: 1px solid rgb(0, 0, 0); /* Warna biru lembut */
    }

    th, td {
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: rgb(139, 180, 242); /* Warna ungu yang lebih soft */
        color: white;
    }

    td {
        color: #333; /* Warna teks yang lebih gelap untuk kontras */
    }

    tr:nth-child(even) {
        background-color: rgba(90, 112, 202, 0.67); /* Memberi warna striping pada tabel */
    }

    .kualitas-sangat-baik { background-color: #28a745; color: white; }
    .kualitas-baik { background-color: #007bff; color: white; }
    .kualitas-cukup { background-color: #ffc107; color: black; }
    .kualitas-tidak-baik { background-color: #dc3545; color: white; }
</style>
</head>
<body>

<div class="container">
    <table>
        <tr>
            <th>NIK</th>
            <th>Nama</th>
            <th>Kehadiran</th>
            <th>Tanggung Jawab</th>
            <th>Kerjasama Tim</th>
            <th>Ketepatan Waktu</th>
            <th>Karakter</th>
            <th>Kualitas</th>
            <th>Waktu Input</th>
            <th>Sertifikat</th>
        </tr>
        <tr>
            <td><?php echo isset($_SESSION['NIK']) ? $_SESSION['NIK'] : "Data tidak valid."; ?></td>
            <td><?php echo isset($_SESSION['Nama']) ? $_SESSION['Nama'] : "Data tidak valid."; ?></td>
            <td><?php echo isset($_SESSION['Kehadiran']) ? $_SESSION['Kehadiran'] : "Data tidak valid."; ?></td>
            <td><?php echo isset($_SESSION['Tanggung_Jawab']) ? $_SESSION['Tanggung_Jawab'] : "Data tidak valid."; ?></td>
            <td><?php echo isset($_SESSION['Kerjasama_Tim']) ? $_SESSION['Kerjasama_Tim'] : "Data tidak valid."; ?></td>
            <td><?php echo isset($_SESSION['Ketepatan_Waktu']) ? $_SESSION['Ketepatan_Waktu'] : "Data tidak valid."; ?></td>
            <td><?php echo isset($_SESSION['Karakter']) ? $_SESSION['Karakter'] : "Data tidak valid."; ?></td>
            <td>
                <?php 
                    // Menampilkan kolom kualitas jika ada, jika tidak kosongkan
                    echo isset($_SESSION['kualitas']) ? $_SESSION['kualitas'] : "";
                ?>
            </td>
            <td><?php echo isset($_SESSION['waktu_input']) ? $_SESSION['waktu_input'] : "Data tidak valid."; ?></td>
            <td>
                <?php if (isset($_SESSION['NIK']) && isset($_SESSION['Nama']) && isset($_SESSION['kualitas'])): ?>
                    <a class="btn btn-custom" 
                       href="fpdfnilai.php?nik=<?php echo urlencode($_SESSION['NIK']); ?>
                       &nama=<?php echo urlencode($_SESSION['Nama']); ?>
                       &kualitas=<?php echo urlencode($_SESSION['kualitas']); ?>
                       &waktu=<?php echo urlencode($_SESSION['waktu_input']); ?>" 
                       target="_blank">
                       Cetak Sertifikat
                    </a>
                <?php else: ?>
                    <span>Tidak ada data untuk dicetak</span>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
