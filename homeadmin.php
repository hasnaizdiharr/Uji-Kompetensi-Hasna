<?php include('navbarr.php'); ?>
<head>
<link rel="stylesheet" href="responsive.css">
<link rel="stylesheet" href="typography.css">
    <title>Penilaian Kinerja Karyawan</title>
    <style>
        header {
            display: flex;             
            justify-content: center;  
            align-items: center;       
            height: 100vh;             
            margin: 0;                 
        }

        
        h3 {
            font-size: 56px;           
            font-weight: bold;        
            margin: 0;                 
        }
        body {
        font-family: Poppins, sans-serif;
        background-color: #e9ecef;
        margin: 0;
        background-image: url('admin..jpg');
        background-size:cover;
        background-repeat: no-repeat;
    
    }
    </style>
</head>
<body>
    <header>
        <h3>Penilaian Kinerja Karyawan Divisi Recruitment</h3>
    </header>

    <div>
        <nav>
            <?php if (isset($_GET['status'])): ?>
                <p>
                    <?php
                    if ($_GET['status'] == 'sukses') {
                        echo "Pendaftaran berhasil!";
                    } else {
                        echo "Pendaftaran gagal!";
                    }
                    ?>
                </p>
            <?php endif; ?>
        </nav>
    </div>
</body>
</html>
