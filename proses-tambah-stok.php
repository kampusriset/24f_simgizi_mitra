<?php

require 'koneksi.php';

// cek apakah tombol submit ditekan
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_barang   = $_POST['id_barang'];
    $stok_tambah = $_POST['stok_tambah'];

    // validasi input
    if($stok_tambah <= 0){

        echo "
        <!DOCTYPE html>
        <html lang='id'>
        <head>
            <meta charset='UTF-8'>
            <title>Error</title>

            <style>

                body{
                    font-family:'Segoe UI',sans-serif;
                    background:linear-gradient(135deg,#fee2e2,#fecaca);
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    height:100vh;
                }

                .box{
                    background:white;
                    padding:35px;
                    border-radius:20px;
                    box-shadow:0 10px 25px rgba(0,0,0,0.1);
                    text-align:center;
                }

                h2{
                    color:#dc2626;
                    margin-bottom:15px;
                }

                a{
                    display:inline-block;
                    margin-top:20px;
                    text-decoration:none;
                    background:#2563eb;
                    color:white;
                    padding:12px 18px;
                    border-radius:10px;
                }

            </style>

        </head>

        <body>

            <div class='box'>

                <h2>❌ Jumlah stok tidak valid</h2>

                <p>
                    Masukkan jumlah stok lebih dari 0
                </p>

                <a href='menu-stok.php'>
                    ⬅ Kembali
                </a>

            </div>

        </body>
        </html>
        ";

        exit;
    }

    // update stok
    $query = $pdo->prepare("
        UPDATE barang
        SET stok = stok + ?
        WHERE id_barang = ?
    ");

    $query->execute([
        $stok_tambah,
        $id_barang
    ]);

    // redirect sukses
    header("Location: menu-stok.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Proses Tambah Stok</title>

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
    width:400px;
}

h1{
    color:#2563eb;
    margin-bottom:20px;
}

p{
    margin-bottom:20px;
    color:#64748b;
}

a{
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border-radius:10px;
    font-weight:bold;
    transition:0.3s;
}

a:hover{
    background:#1d4ed8;
}

</style>

</head>

<body>

<div class="card">

    <h1>📦 Proses Tambah Stok</h1>

    <p>
        Sistem sedang memproses data stok barang.
    </p>

    <a href="menu-stok.php">
        ⬅ Kembali ke Menu Stok
    </a>

</div>

</body>
</html>