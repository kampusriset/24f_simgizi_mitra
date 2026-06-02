<?php
require 'koneksi.php';
if (!isset($_SESSION['username'])) { 
    header("Location: index.php"); 
    exit; 
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BERASKITA</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            background: linear-gradient(135deg, #dbeafe, #f0fdf4);
            min-height:100vh;
        }

        .navbar{
            background:#2563eb;
            padding:18px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        .logo{
            color:white;
            font-size:24px;
            font-weight:bold;
        }

        .menu a{
            color:white;
            text-decoration:none;
            margin-left:20px;
            padding:10px 18px;
            border-radius:10px;
            transition:0.3s;
            font-weight:500;
        }

        .menu a:hover{
            background:rgba(255,255,255,0.2);
        }

        .logout{
            background:#ef4444;
        }

        .logout:hover{
            background:#dc2626 !important;
        }

        .container{
            max-width:1000px;
            margin:50px auto;
            padding:20px;
        }

        .welcome-card{
            background:white;
            padding:40px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.1);
            text-align:center;
        }

        .welcome-card h1{
            color:#1e293b;
            margin-bottom:15px;
            font-size:38px;
        }

        .welcome-card p{
            color:#64748b;
            font-size:18px;
        }

        .info-box{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
            margin-top:30px;
        }

        .card{
            background:white;
            padding:25px;
            border-radius:18px;
            box-shadow:0 5px 15px rgba(0,0,0,0.08);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card h3{
            margin-bottom:10px;
            color:#2563eb;
        }

        .card p{
            color:#475569;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="logo">
            🌾 BERASKITA
        </div>

        <div class="menu">
            <a href="menu-kiriman.php">📦 Kiriman Barang</a>
            <a href="menu-stok.php">📊 Stok Barang</a>
            <a href="logout.php" 
               class="logout"
               onclick="return confirm('Keluar sistem?')">
               🚪 Log Out
            </a>
        </div>
    </div>

    <div class="container">

        <div class="welcome-card">
            <h1>
                Selamat Datang,
                <?= htmlspecialchars($_SESSION['username']); ?> 👋
            </h1>

            <p>
                Sistem Gudang BERASKITA siap membantu pengelolaan stok dan kiriman barang.
            </p>
        </div>

        <div class="info-box">

            <div class="card">
                <h3>📦 Data Kiriman</h3>
                <p>
                    Kelola semua data pengiriman barang dengan mudah dan cepat.
                </p>
            </div>

            <div class="card">
                <h3>📊 Data Stok</h3>
                <p>
                    Pantau stok barang gudang secara realtime.
                </p>
            </div>

            <div class="card">
                <h3>🔒 Keamanan</h3>
                <p>
                    Sistem login membantu menjaga keamanan data gudang.
                </p>
            </div>

        </div>

    </div>

</body>
</html>