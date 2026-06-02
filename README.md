# 24f_simgizi_mitra
# SIM Gizi Mitra

Aplikasi Sistem Informasi Manajemen (SIM) untuk mengelola data mitra pada layanan gizi, terutama bahan mentah (fokusnya pada beras). Aplikasi ini dikembangkan untuk memenuhi tugas UTS mata kuliah Pemrograman Web,

## Fitur Aplikasi
- Keamanan : Sistem Login dan Logout untuk admin.
- Manajemen Sistem: CRUD (Create, Read, Update, Delete) data mitra.
- Pencarian : Fitur pencarian mitra berdasarkan alamat

## Cara Menjalankan
1. Pastikan XAMPP sudah terinstall dan Apache/MySQL aktif.
2. Clone atau download repository ini ke dalam folder htdocs di XAMPP.
3. Import file database (24f_simgizi_mitra.sql) ke phpMyAdmin.
4. Buka browser dan akses melalui localhost/beraskita/login.php.

## Struktur Database
Tabel 1 : barang
- id_barang (INT, Primary Key, Auto Increment)
- nama_barang (VARCHAR)
- stok (VARCHAR)
Tabel 2 : kiriman
- id_kiriman (INT, Primary Key, Auto Increment)
- id_barang (INT, Foreign Key (tb_barang))
- Jumlah_kirim (INT)
- tujuan (VARCHAR)
- tanggal_kirim (DATE)
Tabel 3 : user
- id_user (INT, Primary Key, Auto Increment)
- username (VARCHAR)
- password (VARCHAR)
** Untuk user, kami tidak memakai sistem registrasi agar keamanan sistem lebih terjaga, sehingga data user sudah tersimpan dalam database
** Mitra yang dituju tidak memakai database karena akan otomatis terisi dan terupdate dalam sistem
