<?php

require 'koneksi.php';

if (!isset($_SESSION['username'])) { 
    header("Location: index.php"); 
    exit; 
}

// Ambil data barang
$stmt = $pdo->query("
    SELECT * FROM barang
");

$dataBarang = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Menu Stok Barang</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:linear-gradient(135deg,#dbeafe,#f0fdf4);
    min-height:100vh;
    padding:30px;
    color:#1e293b;
}

.container{
    max-width:1100px;
    margin:auto;
}

/* TOP BAR */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
    gap:15px;
}

.button-group{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.back-btn{
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
    transform:translateY(-2px);
}

.add-btn{
    text-decoration:none;
    background:#f59e0b;
    color:white;
    padding:12px 18px;
    border-radius:10px;
    transition:0.3s;
    font-weight:bold;
}

.add-btn:hover{
    background:#d97706;
    transform:translateY(-2px);
}

/* TITLE */

.title{
    margin-bottom:25px;
}

.title h1{
    font-size:32px;
    margin-bottom:10px;
}

.title p{
    color:#64748b;
}

/* CARD */

.card{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* SUMMARY */

.summary{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:25px;
}

.summary-card{
    background:white;
    padding:20px;
    border-radius:18px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.summary-card h3{
    color:#2563eb;
    margin-bottom:10px;
}

.summary-card p{
    font-size:24px;
    font-weight:bold;
}

/* TABLE */

table{
    width:100%;
    border-collapse:collapse;
    overflow:hidden;
    border-radius:15px;
}

table th{
    background:#2563eb;
    color:white;
    padding:16px;
    text-align:left;
}

table td{
    padding:15px;
    border-bottom:1px solid #e2e8f0;
}

table tr:hover td{
    background:#f8fafc;
}

/* STOK BADGE */

.stok{
    font-weight:bold;
    padding:8px 14px;
    border-radius:10px;
    display:inline-block;
}

.stok-aman{
    background:#dcfce7;
    color:#15803d;
}

.stok-habis{
    background:#fee2e2;
    color:#dc2626;
}

/* BUTTON TAMBAH STOK */

.tambah-btn{
    text-decoration:none;
    background:#16a34a;
    color:white;
    padding:10px 15px;
    border-radius:10px;
    font-size:14px;
    font-weight:bold;
    transition:0.3s;
    display:inline-block;
}

.tambah-btn:hover{
    background:#15803d;
    transform:translateY(-2px);
}

/* EMPTY */

.empty{
    text-align:center;
    color:#64748b;
    padding:25px;
}

</style>

</head>

<body>

<div class="container">

    <!-- TOP BAR -->
    <div class="top-bar">

        <a href="dashboard.php" class="back-btn">
            ⬅ Kembali ke Dashboard
        </a>

        <div class="button-group">

            <a href="tambah-barang.php" class="add-btn">
                ➕ Tambah Barang
            </a>

        </div>

    </div>

    <!-- TITLE -->
    <div class="title">

        <h1>📦 Daftar Ketersediaan Stok</h1>

        <p>
            Pantau stok barang gudang secara realtime.
        </p>

    </div>

    <!-- SUMMARY -->
    <div class="summary">

        <div class="summary-card">

            <h3>Total Barang</h3>

            <p>
                <?= count($dataBarang) ?>
            </p>

        </div>

        <div class="summary-card">

            <h3>Stok Aman</h3>

            <p>
                <?= count(array_filter($dataBarang, fn($b) => $b['stok'] >= 5)) ?>
            </p>

        </div>

        <div class="summary-card">

            <h3>Stok Menipis</h3>

            <p>
                <?= count(array_filter($dataBarang, fn($b) => $b['stok'] < 5)) ?>
            </p>

        </div>

    </div>

    <!-- TABEL -->
    <div class="card">

        <table>

            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Status Stok</th>
                <th>Aksi</th>
            </tr>

            <?php if(count($dataBarang) > 0): ?>

                <?php foreach($dataBarang as $b): ?>

                <tr>

                    <td>
                        <?= $b['id_barang'] ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($b['nama_barang']) ?>
                    </td>

                    <td>

                        <?php if($b['stok'] < 5): ?>

                            <span class="stok stok-habis">
                                <?= $b['stok'] ?> Unit
                            </span>

                        <?php else: ?>

                            <span class="stok stok-aman">
                                <?= $b['stok'] ?> Unit
                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <a 
                            href="tambah-stok.php?id=<?= $b['id_barang'] ?>" 
                            class="tambah-btn"
                        >
                            ➕ Tambah Stok
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="4" class="empty">
                        Tidak ada data barang.
                    </td>

                </tr>

            <?php endif; ?>

        </table>

    </div>

</div>

</body>
</html>