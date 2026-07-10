<?php
session_start();
include "koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = (int)$_POST['password'];

    $query = "SELECT * FROM users WHERE user='$username' and password='$password'";
    $hasil = mysqli_query($conn, $query);

    if (mysqli_num_rows($hasil) > 0) {
        $_SESSION['username'] = $username;
        header("Location: halaman1.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login MyBank</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="login.css">

</head>

<body>
<header class="navbar">
    <div class="navbar-inner">

        <div class="brand">
            <img src="luseabank.png" alt="Logo" class="logo">
            <div class="brand-name">
                Melayani dengan hati, Tumbuh bersama negri
            </div>
        </div>


    </div>
</header>

<section class="hero">

<div class="hero-inner">
<div class="container">

<img src="luseabank.png" alt="Logo" class="logo">

<h2>Login Lusea Bank Dekstop</h2>

<?php
if($error!=""){
    echo "<div class='error'>$error</div>";
}
?>

<form method="post">

<label>Username</label>
<input type="text" name="username" placeholder="Masukkan Username" required>

<label>Password</label>
<input type="password" name="password" placeholder="Masukkan Password" required>

<button type="submit">Login</button>
<br><br>
<a href="registrasi.php">Belum punya akun? Daftar di sini</a>

</form>

<div class="footer">
bank lusea Simulation &copy; 2026
</div>

</div>
<div class="hero-right">

<h1> 
Melayani dengan hati,<br>
<span>Tumbuh bersama negri</span>
</h1>

<p>
Bergabunglah menjadi nasabah Bank lusea dan nikmati
kemudahan transaksi digital dalam satu genggaman.
</p>

</div>
</div>
</section>

</body>
</html>