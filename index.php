<?php
require 'koneksi.php';

if (isset($_SESSION['username'])) { 
    header("Location: dashboard.php"); 
    exit; 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login BERASKITA</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: linear-gradient(135deg, #2563eb, #38bdf8);
            overflow:hidden;
        }

        .login-container{
            width:400px;
            background:white;
            padding:40px;
            border-radius:25px;
            box-shadow:0 15px 35px rgba(0,0,0,0.2);
            animation: fadeIn 0.8s ease;
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

        .logo{
            text-align:center;
            margin-bottom:25px;
        }

        .logo h1{
            color:#2563eb;
            font-size:35px;
        }

        .logo p{
            color:#64748b;
            margin-top:8px;
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            color:#1e293b;
        }

        .input-group{
            margin-bottom:20px;
        }

        .input-group label{
            display:block;
            margin-bottom:8px;
            color:#334155;
            font-weight:600;
        }

        .input-group input{
            width:100%;
            padding:14px;
            border:1px solid #cbd5e1;
            border-radius:12px;
            outline:none;
            transition:0.3s;
            font-size:15px;
        }

        .input-group input:focus{
            border-color:#2563eb;
            box-shadow:0 0 8px rgba(37,99,235,0.3);
        }

        .btn-login{
            width:100%;
            padding:14px;
            border:none;
            border-radius:12px;
            background:#2563eb;
            color:white;
            font-size:16px;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
        }

        .btn-login:hover{
            background:#1d4ed8;
            transform:translateY(-2px);
        }

        .footer{
            text-align:center;
            margin-top:20px;
            color:#64748b;
            font-size:14px;
        }

    </style>

</head>

<body>

    <div class="login-container">

        <div class="logo">
            <h1>🌾 BERASKITA</h1>
            <p>Sistem Gudang Beras Modern</p>
        </div>

        <h2>Login Sistem</h2>

        <form action="login-proses.php" method="POST">

            <div class="input-group">
                <label>Username</label>

                <input 
                    type="text" 
                    name="username" 
                    placeholder="Masukkan username"
                    required
                >
            </div>

            <div class="input-group">
                <label>Password</label>

                <input 
                    type="password" 
                    name="password" 
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                🔐 Masuk
            </button>

        </form>

        <div class="footer">
            © 2026 BERASKITA
        </div>

    </div>

</body>
</html>