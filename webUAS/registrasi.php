<?php
session_start();
include "koneksi.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = (int) $_POST['password'];
     $query901 = "SELECT * FROM users WHERE user='$username' and password='$password'";
    $hasil902 = mysqli_query($conn, $query901);
    if (mysqli_num_rows($hasil902) > 0) {
        $_SESSION['errorREG'] = "Username sudah terdaftar, silahkan login!";
       
        header("Location: registrasi.php");
        exit();
    }

    $query = "SELECT * FROM users2 WHERE user='$username' and password='$password'";
    $hasil = mysqli_query($conn, $query);
  
    if (mysqli_num_rows($hasil) > 0) {
        $data=mysqli_fetch_assoc($hasil);
        $username2 = $data['user'];
        $password2 = (int)$data['password'];
        $norek2= $data['norek'];
        $saldo2= $data['saldo'];
         $query2 = "INSERT INTO users (norek,user, password, saldo) VALUES ('$norek2', '$username2', '$password2', '$saldo2')";
         $hasil2 = mysqli_query($conn, $query2);
         if ($hasil2) {
            echo "data ada berhasil registrasi";
            header("Location: index.php");
        exit();
         
        }else{$_SESSION['errorREG'] = "Gagal registrasi";
             header("Location: registrasi.php");
             exit();}
             
    }
    else{
        $_SESSION['errorREG'] = "anda belum pernah jadi nassabah di bank ini,atau username dan password salah!";
        header("Location: registrasi.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register to Luseabank</title>
    <link rel="stylesheet" href="registrasi.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- ============ NAVBAR ============ -->
<header class="navbar">
    <div class="navbar-inner">
        <div class="brand">
            <!-- GANTI SRC DI SINI: logo bank -->
            <img src="luseabank.png" alt="" class="logo-img">
            <span class="brand-name">Melayani dengan hati, Tumbuh bersama negri</span>
        </div>
        <nav class="nav-links">
            <a href="index.php" class="login-btn">Login</a>
        </nav>
    </div>
</header>

<!-- ============ HERO SPLIT SECTION ============ -->
<section class="hero">
    <div class="hero-inner">

        <div class="hero-form-side">
            <div class="card">

                <h2>Register Lusea Bank Dekstop</h2>
                <p class="card-sub">Daftarkan dirimu sebagai nasabah baru.</p>

                <form method="post" action="registrasi.php" class="input-group">

                    <label>Username</label><br>
                    <input type="text" name="username" required><br><br>

                    <label>Password</label><br>
                    <input type="password" name="password" required><br><br>

                    <button type="submit" class="btn-register">Register</button>
                    <br><br>
                    <?php if (isset($_SESSION['errorREG'])): ?>
                        <p style="color: red;"><?php echo $_SESSION['errorREG']; ?></p>
                        <?php unset($_SESSION['errorREG']); ?>
                    <?php endif; ?>
                    <br>
                     <a href="index.php" class="footer-link">Sudah punya akun? Login di sini</a>
                </form>

            </div>
        </div>
 
        <div class="hero-text-side">
            <h1>Melayani dengan hati,<br><span class="highlight">Tumbuh bersama negri</span></h1>
            <p class="hero-sub">Bergabunglah jadi nasabah Bank Lusea dan nikmati kemudahan transaksi digital dalam satu genggaman.</p>

            <div class="hero-graphic">
                <!-- GANTI SRC DI SINI: ilustrasi/gambar dekoratif -->
                <img src="assets/hero-illustration.png" alt="" class="hero-illustration">
            </div>
        </div>

    </div>
</section>

</body>
</html>