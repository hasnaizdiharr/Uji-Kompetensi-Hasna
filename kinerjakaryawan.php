<?php
include("config.php");
include("navbaradmin2.php");

$per_page = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

// Handle search
$searchNIK = isset($_GET['searchNIK']) ? mysqli_real_escape_string($db, $_GET['searchNIK']) : '';

if (!empty($searchNIK)) {
    $sql = "SELECT * FROM kualitas_karyawan WHERE NIK LIKE ? LIMIT ?, ?";
    $stmt = mysqli_prepare($db, $sql);
    $searchNIKLike = "%$searchNIK%";
    mysqli_stmt_bind_param($stmt, "sii", $searchNIKLike, $start, $per_page);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);

    // Get total filtered data
    $count_stmt = mysqli_prepare($db, "SELECT COUNT(*) as total FROM kualitas_karyawan WHERE NIK LIKE ?");
    mysqli_stmt_bind_param($count_stmt, "s", $searchNIKLike);
    mysqli_stmt_execute($count_stmt);
    $count_result = mysqli_stmt_get_result($count_stmt);
    $count_data = mysqli_fetch_assoc($count_result);
    $total_data = $count_data['total'];
} else {
    $query = mysqli_query($db, "SELECT * FROM kualitas_karyawan LIMIT $start, $per_page");

    $total_query = mysqli_query($db, "SELECT COUNT(*) AS total FROM kualitas_karyawan");
    $total_result = mysqli_fetch_assoc($total_query);
    $total_data = $total_result['total'];
}

$total_pages = ceil($total_data / $per_page);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="responsive.css">
<link rel="stylesheet" href="typography.css">
<title>Penilaian Kualitas Karyawan</title>
<style>
    nav { text-align: center; } 
    p { text-align: center; font-size: 15px; font-weight: bold; }
    canvas { display: block; margin: 20px auto; max-width: 600px; }
    .float-right { float: right; margin-right: 35px; }
    .btn-custom {
        display: inline-block;
        background-color: rgb(73, 157, 180);
        color: black;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        text-align: center;
    }
    .btn-custom.active {
        background-color: #4b89a6;
        color: white;
        font-weight: bold;
    }
    .table-container {
        overflow-x: auto;
        width: 100%;
    }
    table {
        min-width: 1000px;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: center;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background-color:rgb(255, 255, 255);">
<header class="text-center py-5">
    <h3>Data Kinerja Karyawan Divisi Recruitment</h3>
</header>

<div class="d-md-flex justify-content-md-start p-2 ms-auto">
    <form method="GET" action="" style="display: inline;">
        <input type="text" name="searchNIK" placeholder="Cari NIK" style="padding: 5px; width: 200px;">
        <button type="submit" class="btn btn-custom">Cari</button>
    </form>
</div>

<br>
<div class="float-right">
    <a href="fpdfkualitas.php" target="_blank" class="btn btn-custom">PRINT</a>
    <br><br>
</div>

<div class="table-container">
<table class="table table-bordered table-responsive-md table-striped text-center">
<thead>
<tr>
    <th>NO</th>
    <th>NIK</th>
    <th>Nama</th>
    <th>Penilaian Kehadiran</th>
    <th>Penilaian Tanggung Jawab</th>
    <th>Penilaian Kerjasama Tim</th>
    <th>Penilaian Ketepatan Waktu</th>
    <th>Penilaian Karakter</th>
    <th>Kualitas karyawan</th>
</tr>
</thead>
<tbody>
<?php
while ($karyawan = mysqli_fetch_array($query)) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($karyawan['ID']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['NIK']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['Nama']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['Kehadiran']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['Tanggung_Jawab']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['Kerjasama_Tim']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['Ketepatan_Waktu']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['Karakter']) . "</td>";
    echo "<td>" . htmlspecialchars($karyawan['kualitas']) . "</td>";
    echo "<td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>

<p>Menampilkan <?php echo mysqli_num_rows($query); ?> dari total <?php echo $total_data; ?> data</p>

<!-- PAGINATION -->
<div style="text-align:center; margin-top: 20px;">
    <?php if ($page > 1): ?>
        <a class="btn btn-custom" href="?page=<?php echo $page - 1; ?>&searchNIK=<?php echo urlencode($searchNIK); ?>">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a class="btn btn-custom <?php if ($i == $page) echo 'active'; ?>" href="?page=<?php echo $i; ?>&searchNIK=<?php echo urlencode($searchNIK); ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a class="btn btn-custom" href="?page=<?php echo $page + 1; ?>&searchNIK=<?php echo urlencode($searchNIK); ?>">Next</a>
    <?php endif; ?>
</div>
</body>
</html>