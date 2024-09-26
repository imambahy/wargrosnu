<?php
@ob_start();
session_start();
if (empty($_SESSION['admin'])) { 
    echo '<script>window.location="login.php";</script>';
    exit;
}
require 'config.php';
include $view;
$lihat = new view($config);
$toko = $lihat->toko();
$hsl = $lihat->penjualan();

// Ambil data yang dikirim melalui URL
$nm_member = $_GET['nm_member'];
$bayar = $_GET['bayar'];
$kembali = $_GET['kembali'];
$total = $_GET['total'];
$diskon = $_GET['diskon'];
$total_setelah_potongan = $_GET['total_setelah_potongan'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
        }
        h2, p {
            margin: 0;
            padding: 5px 0;
        }
        .nato{
            text-align: center;
            font-weight: bold;
        }
        .title {
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
        .line {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }
        .info {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px 0;
            text-align: left;
        }
        th {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            font-weight: bold;
        }
        td {
            border-bottom: 1px dashed #000;
        }
    </style>
</head>
<body>
    <div class="nato"><h2><?php echo $toko['nama_toko']; ?></h2></div>
    <div class="title">
        <hr />
        <div class="info">
            <p>Tanggal : <?php echo date("j F Y, G:i"); ?></p>
            <p>Kasir : <?php echo htmlentities($nm_member); ?></p>
        </div>
    </div>
    <div class="line"></div>
    <table>
        <tr>
            <th>No.</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
        </tr>
        <?php 
        $no = 1; 
        foreach ($hsl as $isi) { 
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $isi['nama_barang']; ?></td>
            <td><?php echo $isi['jumlah']; ?></td>
            <td>Rp. <?php echo number_format($isi['total'], 2); ?></td>
        </tr>
        <?php 
            $no++; 
        } 
        ?>
    </table>
    <div class="line"></div>
    <p>Total: Rp. <?php echo number_format($total); ?>,-</p>
    <p>Diskon: Rp. <?php echo number_format($diskon); ?>,-</p>
    <p>Total Setelah Diskon: Rp. <?php echo number_format($total_setelah_potongan); ?>,-</p>
    <p>Bayar: Rp. <?php echo number_format($bayar); ?>,-</p>
    <p>Kembali: Rp. <?php echo number_format($kembali); ?>,-</p>
    <div class="line"></div>
    <div class="footer">
        <p>Terima kasih atas kunjungan Anda!</p>
        <p>Selamat berbelanja kembali</p>
    </div>
</body>
</html>
