<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Tambah Barang</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:linear-gradient(135deg,#dbeafe,#f0fdf4);
    padding:40px;
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

label{
    display:block;
    margin-bottom:10px;
    font-weight:bold;
}

input{
    width:100%;
    padding:14px;
    border:1px solid #cbd5e1;
    border-radius:12px;
    margin-bottom:20px;
}

input:focus{
    outline:none;
    border-color:#2563eb;
}

.btn{
    background:#16a34a;
    color:white;
    border:none;
    padding:14px 20px;
    border-radius:12px;
    cursor:pointer;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover{
    background:#15803d;
}

.back-btn{
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

<div class="container">

    <div class="card">

        <h1>📦 Tambah Barang Baru</h1>

        <form action="proses-tambah-barang.php" method="POST">

            <label>Nama Barang</label>

            <input 
                type="text"
                name="nama_barang"
                required
                placeholder="Masukkan nama barang"
            >

            <label>Jumlah Stok</label>

            <input 
                type="number"
                name="stok"
                min="0"
                required
                placeholder="Masukkan jumlah stok"
            >

            <button type="submit" class="btn">
                ➕ Simpan Barang
            </button>

        </form>

        <a href="menu-stok.php" class="back-btn">
            ⬅ Kembali
        </a>

    </div>

</div>

</body>
</html>