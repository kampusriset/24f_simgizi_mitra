<?php

require 'koneksi.php';

if (!isset($_SESSION['username'])) { 
    header("Location: index.php"); 
    exit; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data input
    $id_barang     = $_POST['id_barang'];
    $jumlah_kirim  = intval($_POST['jumlah_kirim']);
    $tujuan        = trim($_POST['tujuan']);

    try {

        // Mulai transaksi database
        $pdo->beginTransaction();

        // Ambil stok barang
        $stmt = $pdo->prepare("
            SELECT stok 
            FROM barang 
            WHERE id_barang = ? 
            FOR UPDATE
        ");

        $stmt->execute([$id_barang]);

        $barang = $stmt->fetch(PDO::FETCH_ASSOC);

        // Validasi stok
        if (!$barang || $barang['stok'] < $jumlah_kirim) {

            throw new Exception(
                "Stok barang di gudang tidak mencukupi untuk pengiriman."
            );
        }

        // Kurangi stok barang
        $update = $pdo->prepare("
            UPDATE barang 
            SET stok = stok - ? 
            WHERE id_barang = ?
        ");

        $update->execute([
            $jumlah_kirim,
            $id_barang
        ]);

        // Simpan data kiriman
        $insert = $pdo->prepare("
            INSERT INTO kiriman (
                id_barang,
                jumlah_kirim,
                tujuan
            ) 
            VALUES (?, ?, ?)
        ");

        $insert->execute([
            $id_barang,
            $jumlah_kirim,
            $tujuan
        ]);

        // Simpan transaksi
        $pdo->commit();

        ?>

        <!DOCTYPE html>
        <html lang="id">
        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Berhasil</title>

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

                .box{
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
                    color:#16a34a;
                    margin-bottom:10px;
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
                    border-radius:10px;
                    transition:0.3s;
                    font-weight:bold;
                }

                .btn:hover{
                    background:#1d4ed8;
                    transform:translateY(-2px);
                }

            </style>

            <meta http-equiv="refresh" content="2;url=menu-kiriman.php">

        </head>

        <body>

            <div class="box">

                <div class="icon">
                    ✅
                </div>

                <h1>Pengiriman Berhasil</h1>

                <p>
                    Data kiriman berhasil disimpan dan stok gudang otomatis diperbarui.
                </p>

                <a href="menu-kiriman.php" class="btn">
                    Kembali ke Menu Kiriman
                </a>

            </div>

        </body>
        </html>

        <?php

    } catch (Exception $e) {

        // Batalkan transaksi
        $pdo->rollBack();

        ?>

        <!DOCTYPE html>
        <html lang="id">
        <head>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Gagal</title>

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

                .box{
                    background:white;
                    width:450px;
                    padding:40px;
                    border-radius:20px;
                    text-align:center;
                    box-shadow:0 10px 25px rgba(0,0,0,0.1);
                }

                .icon{
                    font-size:75px;
                    margin-bottom:20px;
                }

                h1{
                    color:#dc2626;
                    margin-bottom:10px;
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
                    border-radius:10px;
                    transition:0.3s;
                    font-weight:bold;
                }

                .btn:hover{
                    background:#1d4ed8;
                }

            </style>

        </head>

        <body>

            <div class="box">

                <div class="icon">
                    ❌
                </div>

                <h1>Pengiriman Gagal</h1>

                <p>
                    <?= $e->getMessage(); ?>
                </p>

                <a href="menu-kiriman.php" class="btn">
                    Kembali
                </a>

            </div>

        </body>
        </html>

        <?php
    }
}
?>