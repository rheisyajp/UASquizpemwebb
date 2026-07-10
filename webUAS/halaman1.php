<?php
session_start();
include 'koneksi.php';

$query2= "SELECT * FROM users where user='".$_SESSION['username']."'";
$hasil2 = mysqli_query($conn, $query2);
if (mysqli_num_rows($hasil2) > 0) {
    $data2 = mysqli_fetch_assoc($hasil2);

    $_SESSION['password'] =(int) $data2['password'];
    $_SESSION['saldo'] = $data2['saldo'];
    $_SESSION['norek'] = $data2['norek'];
}
if (isset($_POST['norek'] )) {
    $norek = $_POST['norek'];
    $query3 = "DELETE FROM users WHERE norek='$norek'";
    $hasil3 = mysqli_query($conn, $query3);
    if ($hasil3) {
        unset($_SESSION['username']);
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal menghapus akun.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>livin by mandiri Simulation</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- ============ NAVBAR ============ -->
<header class="navbar">
    <div class="navbar-inner">

        <div class="brand">
            <!-- GANTI SRC DI SINI: logo bank -->
            <img src="luseabank.png" alt="My Bank" class="logo-img">
            <span class="brand-name">Melayani dengan hati, Tumbuh bersama negri</span>
        </div>

        <nav class="nav-links">
            <span class="nav-user">Halo, <?php echo $_SESSION['username']; ?></span>
            <a href="index.php" class="logout-btn">Logout</a>
        </nav>

    </div>
</header>

<!-- ============ HERO SECTION ============ -->
<section class="hero">

    <div class="hero-inner">

        <div class="hero-text">
            <h1>Kelola Rekeningmu <span class="highlight">Tanpa Ribet</span></h1>
            <p class="hero-sub">Internet Banking Simulation &mdash; transfer, cek saldo, dan kelola akunmu dalam satu genggaman.</p>

            <div class="info-pill-group">
                <div class="info-pill">
                    <span>No Rekening</span>
                    <strong><?php echo $_SESSION['norek']; ?></strong>
                </div>
                <div class="info-pill saldo-pill">
                    <span>Saldo Saat Ini</span>
                    <strong id="saldo">Rp <?php echo number_format($_SESSION['saldo'],0,',','.'); ?></strong>
                </div>
            </div>
        </div>

        <div class="hero-graphic">
            <!-- GANTI SRC DI SINI: ilustrasi/gambar dekoratif utama (seperti splash/orang di contoh Mandiri) -->
            <img src="luseapre.png" alt="" class="hero-illustration">
        </div>

    </div>

</section>

<!-- ============ MAIN CONTENT ============ -->
<main class="container">

    <div class="card transfer-card">

        <h3 class="card-title">Transfer Sekarang</h3>

        <form action="konfirmasi.php" method="post" class="transfer-form">

            <div class="input-group">
                <label>Nomor Rekening Tujuan</label>
                <input
                    name="rekening"
                    type="text"
                    placeholder="Masukkan nomor rekening"
                    required
                >
            </div>

            <div class="input-group">
                <label>Jumlah Transfer</label>
                <input
                    name="jumlah"
                    type="number"
                    placeholder="Minimal Rp1000"
                    required
                    min="1000"
                >
            </div>

            <div class="input-group">
                <label>Password</label>
                <input
                    name="password"
                    id="password"
                    type="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <!-- <div class="show-pass">
                <input type="checkbox" id="showPassword">
                <label for="showPassword">Tampilkan Password</label>
            </div> -->

            <button class="btn-transfer" type="submit">
                Transfer Sekarang
            </button>

        </form>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='alert error'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo "<div class='alert success'>".$_SESSION['success']."</div>";
            unset($_SESSION['success']);
        }
        ?>

        <a href="index.php" class="logout-link-btn">
            Logout
        </a>
<!-- 
<form action="" method="post" class="delete-form">
    <input type="hidden" name="norek" value="<?php echo $_SESSION['norek']; ?>">

    <button
        type="submit"
        class="delete-btn"
        onclick="return confirm('Yakin ingin menghapus akun ini?')">
        🗑️ Hapus Akun
    </button>
</form> -->
<form action="halaman1.php" method="post" class="delete-form">
    <input type="hidden" name="norek" value="<?php echo $_SESSION['norek']; ?>">

    <button
        type="submit"
        class="delete-btn"
        onclick="return confirm('Yakin ingin menghapus akun ini?')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 6h18"></path>
            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
            <line x1="10" y1="11" x2="10" y2="17"></line>
            <line x1="14" y1="11" x2="14" y2="17"></line>
        </svg>
        Hapus Akun
    </button>
</form>
    </div>

</main>

<!-- ============ FEATURE STRIP (bawah, seperti contoh Mandiri) ============ -->
<footer class="feature-strip">
    <div class="feature-item">
        <!-- GANTI SRC DI SINI: icon fitur 1 -->
        <img src="lusea.png" alt="">
        <p>Jelajahi keunggulan produk<br>kartu lusea bank &rsaquo;</p>
    </div>
    <div class="feature-item">
        <!-- GANTI SRC DI SINI: icon fitur 2 -->
        <img src="deposito.jpg" alt="">
        <p>Buka deposito secara<br>online sekarang juga &rsaquo;</p>
    </div>
    <div class="feature-item">
        <!-- GANTI SRC DI SINI: icon fitur 3 -->
        <img src="transaksi.jpg" alt="">
        <p>Nikmati kemudahan transaksi<br>lewat aplikasi &rsaquo;</p>
    </div>
</footer>

</body>
</html>