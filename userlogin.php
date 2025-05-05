<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userlogin.css" media="screen" title="no title">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Login Page</title>
    <style>
        body {
            background-image:url('Desktop - 1.jpg') ;
            font-family: Poppins, sans-serif;
            background-color: #e9ecef;
            margin: 0;
            padding: 20px;
            background-size:cover;
        }
        .profile-container {
            background: #fef3d8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: auto;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .edit-button {
            background-color: #fef3d8;
            color: #fef3d8;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            text-align: center;
        }
        .input img {
    max-width: 230px;
    margin-bottom: 20px;
}
    </style>
</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #E1D7B7;
        }
    </style>
</head>
<body>

<body>
<div class="input" style="text-align: center;">
            <!-- Logo di atas form -->
            <img src="valdooo.png" alt="Logo" width="230" style="margin-bottom: 20px;">
        <h1>LOGIN</h1>
        <form action="loginuser.php" method="POST">
            <div class="box-input">
                <i class="fas fa-envelope-open-text"></i>
                <input type="text" name="NIK" placeholder="NIK">
            </div>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="Password" name="Password" placeholder="Password">
            </div>
            <a href="homeuser.php">
                <button type="submit" name="login" class="btn-input">Login</button>
            </a>
            <div class="bottom">
                <p>Belum punya akun?
                    <a href="register.php">Register disini</a>
                </p>
            </div>
            <div class="bottom">
                <p>Admin
                    <a href="adminlogin.html">Login as Admin</a>
                </p>
            </div>
        </form> 
        </div>
    </div>
</body>
</html>