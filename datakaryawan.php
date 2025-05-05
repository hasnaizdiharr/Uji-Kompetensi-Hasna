<?php include("config.php"); 
 include("navbaradmin2.php");

 // Pagination setup
$per_page = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

$searchNIK = isset($_GET['searchNIK']) ? mysqli_real_escape_string($db, $_GET['searchNIK']) : '';
if (!empty($searchNIK)) {
    $sql = "SELECT * FROM data_karyawan WHERE NIK LIKE ? LIMIT ?,?";
    $stmt = mysqli_prepare($db, $sql);
    $searchNIK = "%$searchNIK%";
    mysqli_stmt_bind_param($stmt, "sii", $searchNIKLike, $start, $per_page);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);

    $countSql = "SELECT COUNT(*) as total FROM data_karyawan WHERE NIK LIKE ?";
    $countStmt = mysqli_prepare($db, $countSql);
    mysqli_stmt_bind_param($countStmt, "s", $searchNIKLike);
    mysqli_stmt_execute($countStmt);
    $resultCount = mysqli_stmt_get_result($countStmt);
    $totalRows = mysqli_fetch_assoc($resultCount)['total'];
} else {
    $query = mysqli_query($db, "SELECT * FROM data_karyawan LIMIT $start, $per_page");
    $resultCount = mysqli_query($db, "SELECT COUNT(*) as total FROM data_karyawan");
    $totalRows = mysqli_fetch_assoc($resultCount)['total'];
}
$total_pages = ceil($totalRows / $per_page);
if (!$query) {
    die("Error pada query: " . mysqli_error($db));
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="responsive.css">
<link rel="stylesheet" href="typography.css">
    <title>Data Karyawan Divisi Recruitment</title>
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
<h3>Data Karyawan Divisi Recruitment</h3>
</header>
<div class="d-md-flex justify-content-md-start p-2 ms-auto">
    <form method="GET" action="" style="display: inline;">
        <input type="text" name="searchNIK" placeholder="Cari NIK" style="padding: 5px; width: 200px;">
        <button type="submit" class="btn btn-custom">Cari</button>
    </form>
</div>

<br>
<div class="float-right">
    <a href="fpdfkaryawan.php" target="_blank" class="btn btn-custom">PRINT</a>
    <br><br>
</div>
<table class="table table-bordered table-responsive-md table-striped text-center">
<thead>
<tr>
<th>NO</th>
<th>NIK</th>
<th>Nama</th>
<th>Alamat</th>
<th>Nomor Rekening</th>

</tr>
</thead>
<tbody>
<?php
while($karyawan = mysqli_fetch_array($query)){
    echo "<tr>";
    echo "<td>". htmlspecialchars($karyawan['ID'])."</td>";
    echo "<td>". htmlspecialchars($karyawan['NIK'])."</td>";
    echo "<td>". htmlspecialchars($karyawan['Nama'])."</td>";
    echo "<td>". htmlspecialchars($karyawan['Alamat'])."</td>";
    echo "<td>". htmlspecialchars($karyawan['No_Rek'])."</td>";
    echo "<td>";
    echo "</tr>";
    }
    ?>
    </tbody>
    </table>
    <p>Menampilkan <?php echo mysqli_num_rows($query); ?> dari total <?php echo $totalRows; ?> data</p>

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