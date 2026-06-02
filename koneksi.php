<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "gudang_db";

try {

    // Koneksi Database
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );

    // Menampilkan error PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

} catch (PDOException $e) {

    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>

        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>

        <title>Koneksi Gagal</title>

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
                background: linear-gradient(135deg,#fee2e2,#fecaca);
            }

            .error-box{
                background:white;
                width:450px;
                padding:40px;
                border-radius:20px;
                text-align:center;
                box-shadow:0 10px 25px rgba(0,0,0,0.1);
            }

            .icon{
                font-size:70px;
                margin-bottom:20px;
            }

            h1{
                color:#dc2626;
                margin-bottom:15px;
            }

            p{
                color:#444;
                line-height:1.6;
            }

            .small{
                margin-top:20px;
                font-size:14px;
                color:#64748b;
            }

        </style>

    </head>

    <body>

        <div class='error-box'>

            <div class='icon'>❌</div>

            <h1>Koneksi Database Gagal</h1>

            <p>
                ".$e->getMessage()."
            </p>

            <div class='small'>
                Pastikan MySQL di XAMPP sudah aktif.
            </div>

        </div>

    </body>
    </html>
    ";

    exit;
}

?>