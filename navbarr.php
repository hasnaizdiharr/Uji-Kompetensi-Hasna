<?php $page = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, #7C93C3, #55679C);
            color: white;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            color: #f8f9fa !important;
            text-decoration: underline;
        }

        .nav-link.active {
            font-weight: bold;
            color: #ffffff !important;
            background-color: rgb(78, 95, 150);
            border-radius: 5px;
            padding: 6px 12px;
        }

        .navbar-toggler {
            border: none;
        }

        .sticky-top {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .brand-text {
    font-size: 30px; /* Ganti angka ini sesuai keinginan */
    color:white;
}
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="homeadmin.php">
    <img src="valdooo.png" alt="Logo" width="150" height="95" class="me-2">
    <span class="brand-text">E-Kinerja</span>
</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == 'homeadmin.php') echo 'active'; ?>" href="homeadmin.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == 'kualitas-karyawan.php') echo 'active'; ?>" href="kualitas-karyawan.php">Data Penilaian Kinerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if($page == 'Data-pribadi.php') echo 'active'; ?>" href="Data-pribadi.php">Data Karyawan</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link <?php if($page == 'adminlogin.html') echo 'active'; ?>" href="#" onclick="logout(event)">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
    function logout(event) {
        event.preventDefault(); // cegah link langsung jalan
        if (confirm("Apakah Anda yakin ingin logout?")) {
            window.location.href = 'adminlogin.html';
        }
        // Kalau cancel, tidak terjadi apa-apa
    }
</script>

</body>
</html>
