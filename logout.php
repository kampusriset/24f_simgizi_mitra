<?php

require 'koneksi.php';

// Hapus semua session
session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Logout BERASKITA</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg,#dbeafe,#f0fdf4);
        }

        .logout-box{
            background:white;
            width:420px;
            padding:40px;
            border-radius:20px;
            text-align:center;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
            animation:fadeIn 0.5s ease;
        }

        @keyframes fadeIn{
            from{
                opacity:0;
                transform:translateY(20px);
            }

            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .icon{
            font-size:75px;
            margin-bottom:20px;
        }

        h1{
            color:#2563eb;
            margin-bottom:12px;
        }

        p{
            color:#64748b;
            margin-bottom:25px;
            line-height:1.5;
        }

        .btn{
            display:inline-block;
            text-decoration:none;
            background:#2563eb;
            color:white;
            padding:12px 22px;
            border-radius:12px;
            transition:0.3s;
            font-weight:bold;
        }

        .btn:hover{
            background:#1d4ed8;
            transform:translateY(-2px);
        }

    </style>

    <!-- Auto kembali ke login -->
    <meta http-equiv="refresh" content="2;url=index.php">

</head>

<body>

    <div class="logout-box">

        <div class="icon">
            👋
        </div>

        <h1>Berhasil Logout</h1>

        <p>
            Anda telah keluar dari sistem BERASKITA.
        </p>

        <a href="index.php" class="btn">
            Login Kembali
        </a>

    </div>

</body>
</html>