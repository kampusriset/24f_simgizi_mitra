<?php

require 'koneksi.php';

if (!isset($_SESSION['username'])) { 
    header("Location: index.php"); 
    exit; 
}

// Ambil data barang
$dataBarang = $pdo->query("
    SELECT * FROM barang
")->fetchAll(PDO::FETCH_ASSOC);

// --- LOGIKA PENCARIAN (HANYA BERSIFAT MENYARING DATA JIKA ADA GET SEARCH) ---
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search)) {
    $stmt = $pdo->prepare("
        SELECT k.*, b.nama_barang 
        FROM kiriman k
        JOIN barang b ON k.id_barang = b.id_barang
        WHERE b.nama_barang LIKE ? OR k.tujuan LIKE ?
        ORDER BY k.id_kiriman DESC
    ");
    $stmt->execute(["%$search%", "%$search%"]);
    $dataKiriman = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Ambil data kiriman (CODE ASLI ANDA TETAP DI SINI)
    $dataKiriman = $pdo->query("
        SELECT k.*, b.nama_barang 
        FROM kiriman k
        JOIN barang b ON k.id_barang = b.id_barang
        ORDER BY k.id_kiriman DESC
    ")->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Menu Kiriman Barang</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', sans-serif;
        }

        body{
            background: linear-gradient(135deg,#dbeafe,#f0fdf4);
            padding:30px;
            color:#1e293b;
        }

        .container{
            max-width:1200px;
            margin:auto;
        }

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:25px;
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
        }

        h1{
            margin-bottom:25px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.08);
            margin-bottom:30px;
        }

        .card h2{
            margin-bottom:20px;
            color:#2563eb;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
        }

        input,
        select{
            width:100%;
            padding:12px;
            border:1px solid #cbd5e1;
            border-radius:10px;
            margin-bottom:20px;
            font-size:15px;
        }

        input:focus,
        select:focus{
            outline:none;
            border-color:#2563eb;
            box-shadow:0 0 8px rgba(37,99,235,0.2);
        }

        .btn{
            background:#16a34a;
            color:white;
            border:none;
            padding:12px 20px;
            border-radius:10px;
            cursor:pointer;
            font-size:15px;
            font-weight:bold;
            transition:0.3s;
        }

        .btn:hover{
            background:#15803d;
            transform:translateY(-2px);
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:15px;
            overflow:hidden;
            border-radius:15px;
        }

        table th{
            background:#2563eb;
            color:white;
            padding:15px;
            text-align:left;
        }

        table td{
            background:white;
            padding:14px;
            border-bottom:1px solid #e2e8f0;
        }

        table tr:hover td{
            background:#f8fafc;
        }

        .hapus-btn{
            text-decoration:none;
            background:#ef4444;
            color:white;
            padding:8px 14px;
            border-radius:8px;
            transition:0.3s;
            font-size:14px;
        }

        .hapus-btn:hover{
            background:#dc2626;
        }

        .empty{
            text-align:center;
            padding:20px;
            color:#64748b;
        }

        /* --- STYLES BARU UNTUK FORM SEARCH --- */
        .search-wrapper {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            max-width: 450px;
        }
        .search-wrapper input {
            margin-bottom: 0;
            padding: 10px 15px;
            font-size: 14px;
        }
        .search-wrapper .btn-search {
            background: #2563eb;
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: 0.3s;
        }
        .search-wrapper .btn-search:hover {
            background: #1d4ed8;
        }
        .search-wrapper .btn-reset {
            display: flex;
            align-items: center;
            text-decoration: none;
            background: #e2e8f0;
            color: #475569;
            padding: 0 15px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }
        .search-wrapper .btn-reset:hover {
            background: #cbd5e1;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="top-bar">

        <a href="dashboard.php" class="back-btn">
            ⬅ Kembali ke Dashboard
        </a>

    </div>

    <h1>📦 Menu Pengiriman Barang</h1>

    <!-- FORM INPUT -->
    <div class="card">

        <h2>➕ Form Input Pesanan Baru</h2>

        <form action="tambah-kiriman.php" method="POST">

            <label>Pilih Unit Barang</label>

            <select name="id_barang" required>

                <?php foreach($dataBarang as $b): ?>

                    <option value="<?= $b['id_barang'] ?>">

                        <?= htmlspecialchars($b['nama_barang']) ?>

                        (Stok: <?= $b['stok'] ?>)

                    </option>

                <?php endforeach; ?>

            </select>

            <label>Jumlah yang Harus Dikirim</label>

            <input 
                type="number" 
                name="jumlah_kirim" 
                min="1" 
                required
                placeholder="Masukkan jumlah kiriman"
            >

            <label>Lokasi Kota Tujuan</label>

            <input 
                type="text" 
                name="tujuan" 
                required
                placeholder="Masukkan kota tujuan"
            >

            <button type="submit" class="btn">
                🚚 Proses Pengiriman
            </button>

        </form>

    </div>

    <!-- TABEL -->
    <div class="card">

        <h2>📋 Riwayat Daftar Pengiriman</h2>

        <!-- --- FORM SEARCH (HANYA INI YANG DISISIPKAN DI ATAS TABEL) --- -->
        <form action="" method="GET" class="search-wrapper">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari nama barang atau kota tujuan..." 
                value="<?= htmlspecialchars($search) ?>"
            >
            <button type="submit" class="btn-search">Cari</button>
            <?php if (!empty($search)): ?>
                <a href="menu-kiriman.php" class="btn-reset">Reset</a>
            <?php endif; ?>
        </form>

        <table>

            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            <?php if(count($dataKiriman) > 0): ?>

                <?php foreach($dataKiriman as $k): ?>

                <tr>

                    <td><?= $k['id_kiriman'] ?></td>

                    <td>
                        <?= htmlspecialchars($k['nama_barang']) ?>
                    </td>

                    <td>
                        <?= $k['jumlah_kirim'] ?> Pcs
                    </td>

                    <td>
                        <?= htmlspecialchars($k['tujuan']) ?>
                    </td>

                    <td>
                        <?= !empty($k['tanggal_kirim']) 
                            ? date('d M Y H:i', strtotime($k['tanggal_kirim'])) 
                            : '-' ?>
                    </td>

                    <td>

                        <a 
                            href="hapus-kiriman.php?id=<?= $k['id_kiriman'] ?>"
                            class="hapus-btn"
                            onclick="return confirm('Batalkan pengiriman? Stok otomatis dikembalikan ke gudang.')"
                        >
                            ❌ Hapus
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="6" class="empty">
                        Belum ada data pengiriman.
                    </td>

                </tr>

            <?php endif; ?>

        </table>

    </div>

</div>

</body>
</html>
