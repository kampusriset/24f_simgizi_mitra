<?php
require 'koneksi.php';

if (!isset($_SESSION['username'])) { 
    header("Location: index.php"); 
    exit; 
}

if (isset($_GET['id'])) {

    $id_kiriman = $_GET['id'];

    try {

        $pdo->beginTransaction();

        // Ambil data kiriman
        $stmt = $pdo->prepare("
            SELECT id_barang, jumlah_kirim 
            FROM kiriman 
            WHERE id_kiriman = ?
        ");

        $stmt->execute([$id_kiriman]);

        $kiriman = $stmt->fetch(PDO::FETCH_ASSOC);

        // Jika data ditemukan
        if ($kiriman) {

            // Kembalikan stok barang
            $restore = $pdo->prepare("
                UPDATE barang 
                SET stok = stok + ? 
                WHERE id_barang = ?
            ");

            $restore->execute([
                $kiriman['jumlah_kirim'],
                $kiriman['id_barang']
            ]);

            // Hapus data kiriman
            $delete = $pdo->prepare("
                DELETE FROM kiriman 
                WHERE id_kiriman = ?
            ");

            $delete->execute([$id_kiriman]);

            $pdo->commit();

            echo "
            <!DOCTYPE html>
            <html lang='id'>
            <head>
                <title>Berhasil</title>

                <style>
                    *{
                        margin:0;
                        padding:0;
                        box-sizing:border-box;
                        font-family:'Segoe UI', sans-serif;
                    }

                    body{
                        background: linear-gradient(135deg,#dbeafe,#f0fdf4);
                        height:100vh;
                        display:flex;
                        justify-content:center;
                        align-items:center;
                    }

                    .box{
                        background:white;
                        padding:40px;
                        border-radius:20px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.1);
                        text-align:center;
                        width:400px;
                    }

                    .icon{
                        font-size:70px;
                        margin-bottom:20px;
                    }

                    h2{
                        color:#16a34a;
                        margin-bottom:10px;
                    }

                    p{
                        color:#64748b;
                        margin-bottom:25px;
                    }

                    a{
                        text-decoration:none;
                        background:#2563eb;
                        color:white;
                        padding:12px 20px;
                        border-radius:10px;
                        transition:0.3s;
                    }

                    a:hover{
                        background:#1d4ed8;
                    }
                </style>

                <meta http-equiv='refresh' content='2;url=menu-kiriman.php'>
            </head>

            <body>

                <div class='box'>
                    <div class='icon'>✅</div>

                    <h2>Data Berhasil Dihapus</h2>

                    <p>
                        Data kiriman berhasil dihapus dan stok barang sudah dikembalikan.
                    </p>

                    <a href='menu-kiriman.php'>
                        Kembali ke Menu Kiriman
                    </a>
                </div>

            </body>
            </html>
            ";

        } else {

            echo "
            <script>
                alert('Data kiriman tidak ditemukan!');
                window.location='menu-kiriman.php';
            </script>
            ";
        }

    } catch (Exception $e) {

        $pdo->rollBack();

        echo "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Error</title>

            <style>
                body{
                    background:#fee2e2;
                    font-family:Arial;
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    height:100vh;
                }

                .error-box{
                    background:white;
                    padding:30px;
                    border-radius:15px;
                    box-shadow:0 5px 15px rgba(0,0,0,0.1);
                    text-align:center;
                    width:450px;
                }

                h2{
                    color:#dc2626;
                    margin-bottom:15px;
                }

                p{
                    color:#444;
                }
            </style>
        </head>

        <body>

            <div class='error-box'>
                <h2>❌ Gagal Menghapus</h2>

                <p>
                    ".$e->getMessage()."
                </p>
            </div>

        </body>
        </html>
        ";
    }
}
?>