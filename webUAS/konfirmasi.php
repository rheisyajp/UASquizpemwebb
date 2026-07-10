<?php
session_start();
include 'koneksi.php';

if (isset($_POST['rekening']) ) {
    
    $_SESSION['norek_tujuan'] = $_POST['rekening'];
    $_SESSION['jumlah_transfer'] = $_POST['jumlah'];
    $_SESSION['password_input'] = (int) $_POST['password'];
    
header("Location: konfirmasi.php");
exit();   
    }
    
    if ( isset($_POST['pilihan'])  ) {
        $pilihan = $_POST['pilihan'];
        if ($pilihan == 0) {
        $query3 = "UPDATE users SET saldo = saldo - ".$_SESSION['jumlah_transfer']." WHERE norek = ".$_SESSION['norek']; 
        $hasil2=mysqli_query($conn, $query3);

        $query32 = "UPDATE users2 SET saldo = saldo - ".$_SESSION['jumlah_transfer']." WHERE norek = ".$_SESSION['norek']; 
        $hasil22=mysqli_query($conn, $query32);

        $query4= "UPDATE users SET saldo = saldo + " . $_SESSION['jumlah_transfer'] . " WHERE norek = " . $_SESSION['norek_tujuan'] . ";";
        $hasil3=mysqli_query($conn, $query4);

        $query42= "UPDATE users2 SET saldo = saldo + " . $_SESSION['jumlah_transfer'] . " WHERE norek = " . $_SESSION['norek_tujuan'] . ";";
        $hasil32=mysqli_query($conn, $query42);
         $_SESSION['success'] = " rekening di temukan, Transfer berhasil!";
        header("Location: halaman1.php"); 
        unset($_SESSION['pilihan']);
        unset($_SESSION['norek_tujuan']);
        unset($_SESSION['jumlah_transfer']);
        unset($_SESSION['password_input']);
        unset($_SESSION['namatujuan']);


        exit();}
        else{
            $_SESSION['success'] = "Transfer dibatalkan!";
            header("Location: halaman1.php");
            unset($_SESSION['pilihan']);
        unset($_SESSION['norek_tujuan']);
        unset($_SESSION['jumlah_transfer']);
        unset($_SESSION['password_input']);
        unset($_SESSION['namatujuan']);

            exit();
  
        }




}
if ( $_SESSION['saldo'] - $_SESSION['jumlah_transfer'] >= 0 ){ 
        $query = "SELECT * FROM users WHERE norek='" . $_SESSION['norek_tujuan'] . "'";
        $hasil = mysqli_query($conn, $query);
        if (mysqli_num_rows($hasil) == 0){
            $_SESSION['error'] = "Rekening tujuan tidak ditemukan!";
            header("Location: halaman1.php");
            // unset($_SESSION['pilihan']);
        unset($_SESSION['norek_tujuan']);
        unset($_SESSION['jumlah_transfer']);
        unset($_SESSION['password_input']);
        unset($_SESSION['namatujuan']);

            exit();
        }else{
            $row = mysqli_fetch_assoc($hasil);
            $_SESSION['namatujuan'] = $row['user'];
        }}
        else{
        $_SESSION['error'] = "Saldo anda tidak cukup untuk melakukan transfer!";
        header("Location: halaman1.php");
        // unset($_SESSION['pilihan']);
        unset($_SESSION['norek_tujuan']);
        unset($_SESSION['jumlah_transfer']);
        unset($_SESSION['password_input']);
        unset($_SESSION['namatujuan']);

        exit();
    }

// cek password
if ( $_SESSION['password_input'] !== $_SESSION['password'] ) {
        $_SESSION['error'] = "Password anda salah! gagal melakukan transfer!";
        header("Location: halaman1.php");
        // unset($_SESSION['pilihan']);
        unset($_SESSION['norek_tujuan']);
        unset($_SESSION['jumlah_transfer']);
        unset($_SESSION['password_input']);
        unset($_SESSION['namatujuan']);

        exit();
    }
    if ( $_SESSION['norek_tujuan'] == $_SESSION['norek']){
        $_SESSION['error'] = "Tidak bisa transfer ke rekening sendiri!";
        header("Location: halaman1.php");
        // unset($_SESSION['pilihan']);
        unset($_SESSION['norek_tujuan']);
        unset($_SESSION['jumlah_transfer']);
        unset($_SESSION['password_input']);
        unset($_SESSION['namatujuan']);
        exit();
    }



?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Konfirmasi Transfer</title>
<link rel="stylesheet" href="konfirmstyle.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="confirm-card">

<h2 class="transfer-title">Konfirmasi Transfer</h2>

<div class="confirm-illustration">
    <img src="assets/confirm-illustration.png" alt="">
</div>

<table class="transfer-table" border="1" cellpadding="8">
    <tr class="transfer-row">
        <td class="transfer-label">Nama Tujuan</td>
        <td class="transfer-value"><?= htmlspecialchars($_SESSION['namatujuan']) ?></td>
    </tr>

    <tr class="transfer-row">
        <td class="transfer-label">No Rekening</td>
        <td class="transfer-value"><?= htmlspecialchars($_SESSION['norek_tujuan']) ?></td>
    </tr>

    <tr class="transfer-row">
        <td class="transfer-label">Jumlah</td>
        <td class="transfer-value">Rp <?= number_format($_SESSION['jumlah_transfer'],0,',','.') ?></td>
    </tr>
</table>

<br>

<form class="transfer-form" action="konfirmasi.php" method="post">

    <label class="transfer-option">
        <input type="radio" name="pilihan" value="0" required>
        Ya, saya yakin melakukan transfer
    </label>

    <br><br>

    <label class="transfer-option">
        <input type="radio" name="pilihan" value="1">
        Tidak, batalkan transfer
    </label>

    <br><br>

    <button class="transfer-button" type="submit" name="aksi" value="konfirmasi">
        Konfirmasi
    </button>

</form>

</div>

</body>
</html>