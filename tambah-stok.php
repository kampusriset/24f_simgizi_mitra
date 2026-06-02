<?php
require 'koneksi.php';

$id = $_GET['id'];

$data = $pdo->prepare("
    SELECT * FROM barang 
    WHERE id_barang=?
");

$data->execute([$id]);

$barang = $data->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Stok Barang</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:linear-gradient(135deg,#dbeafe,#f0fdf4);
    padding:40px;
    color:#1e293b;
}

.container{
    max-width:600px;
    margin:auto;
}

.card{
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

h1{
    margin-bottom:25px;
    color:#2563eb;
}

.info{
    background:#f8fafc;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
    border:1px solid #e2e8f0;
}

.info p{
    margin-bottom:10px;
}

label{
    display:block;
    margin-bottom:10px;
    font-weight:600;
}

input{
    width:100%;
    padding:14px;
    border:1px solid #cbd5e1;
    border-radius:12px;
    margin-bottom:25px;
    font-size:15px;
}

input:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:0 0 8px rgba(37,99,235,0.2);
}

.btn{
    background:#16a34a;
    color:white;
    border:none;
    padding:14px 20px;
    border-radius:12px;
    cursor:pointer;
    font-size:15px;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover{
    background:#15803d;
    transform:translateY(-2px);
}

.back-btn{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border-radius:10px;
    transition:0.3s;
    font-weight:bold;
}

.back-btn:hover{
    background:#1d4ed8;
}

</style>

</head>

<body>

<div class="container">

    <div class="card">

        <h1>📦 Tambah Stok Barang</h1>

        <div class="info">

            <p>
                <strong>Nama Barang:</strong>
                <?= $barang['nama_barang'] ?>
            </p>

            <p>
                <strong>Stok Saat Ini:</strong>
                <?= $barang['stok'] ?>
            </p>

        </div>

        <form action="proses-tambah-stok.php" method="POST">

            <input 
                type="hidden" 
                name="id_barang"
                value="<?= $barang['id_barang'] ?>"
            >

            <label>Jumlah Tambahan Stok</label>

            <input 
                type="number"
                name="stok_tambah"
                min="1"
                required
                placeholder="Masukkan jumlah stok"
            >

            <button type="submit" class="btn">
                ➕ Tambah Stok
            </button>

        </form>

        <a href="menu-stok.php" class="back-btn">
            ⬅ Kembali
        </a>

    </div>

</div>

</body>
</html>