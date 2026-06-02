<?php

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {

        // Cek user
        $stmt = $pdo->prepare("
            SELECT * 
            FROM user 
            WHERE username = ? 
            AND password = ?
        ");

        $stmt->execute([$username, $password]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Jika login berhasil
        if ($user) {

            $_SESSION['username'] = $user['username'];

            echo "
            <!DOCTYPE html>
            <html lang='id'>
            <head>

                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>

                <title>Login Berhasil</title>

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
                        width:400px;
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
                        font-size:70px;
                        margin-bottom:20px;
                    }

                    h1{
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

                <meta http-equiv='refresh' content='2;url=dashboard.php'>

            </head>

            <body>

                <div class='box'>

                    <div class='icon'>✅</div>

                    <h1>Login Berhasil</h1>

                    <p>
                        Selamat datang,
                        ".$user['username']."
                    </p>

                    <a href='dashboard.php'>
                        Masuk Dashboard
                    </a>

                </div>

            </body>
            </html>
            ";

        } else {

            echo "
            <!DOCTYPE html>
            <html lang='id'>
            <head>

                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>

                <title>Login Gagal</title>

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
                        width:400px;
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
                    }

                    a:hover{
                        background:#1d4ed8;
                    }

                </style>

                <meta http-equiv='refresh' content='2;url=index.php'>

            </head>

            <body>

                <div class='box'>

                    <div class='icon'>❌</div>

                    <h1>Login Gagal</h1>

                    <p>
                        Username atau Password salah!
                    </p>

                    <a href='index.php'>
                        Kembali Login
                    </a>

                </div>

            </body>
            </html>
            ";
        }

    } catch (PDOException $e) {

        echo "
        <h2>Terjadi Kesalahan:</h2>
        ".$e->getMessage();
    }
}

?>