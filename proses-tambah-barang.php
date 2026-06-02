<?php

require 'koneksi.php';

// cek apakah form dikirim
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $nama_barang = $_POST['nama_barang'];
    $stok        = $_POST['stok'];

    // simpan ke database
    $query = $pdo->prepare("
        INSERT INTO barang
        (nama_barang, stok)
        VALUES (?, ?)
    ");

    $query->execute([
        $nama_barang,
        $stok
    ]);

    // halaman sukses
    echo "
    <!DOCTYPE html>
    <html lang='id'>
    <head>

        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>

        <title>Berhasil</title>

        <style>

            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
                font-family:'Segoe UI',sans-serif;
            }

            body{
                background:linear-gradient(135deg,#dbeafe,#f0fdf4);
                height:100vh;
                display:flex;
                justify-content:center;
                align-items:center;
                color:#1e293b;
            }

            .card{
                background:white;
                padding:40px;
                border-radius:20px;
                box-shadow:0 10px 25px rgba(0,0,0,0.08);
                text-align:center;
                width:450px;
            }

            h1{
                color:#16a34a;
                margin-bottom:15px;
            }

            p{
                color:#64748b;
                margin-bottom:25px;
                font-size:16px;
            }

            .btn{
                text-decoration:none;
                background:#2563eb;
                color:white;
                padding:12px 20px;
                border-radius:10px;
                font-weight:bold;
                transition:0.3s;
                display:inline-block;
            }

            .btn:hover{
                background:#1d4ed8;
                transform:translateY(-2px);
            }

        </style>

    </head>

    <body>

        <div class='card'>

            <h1>✅ Barang Berhasil Ditambahkan</h1>

            <p>
                Data barang baru berhasil disimpan ke gudang.
            </p>

            <a href='menu-stok.php' class='btn'>
                ⬅ Kembali ke Menu Stok
            </a>

        </div>

    </body>
    </html>
    ";

    exit;
}

?>