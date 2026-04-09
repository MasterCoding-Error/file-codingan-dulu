<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    h1{
      font-family: calibri;
    }
  </style>
</head>
<body>
  
  <table align="center" width="50%" border="1">
    <tr align="center">
      <td><a href="index.php?hal=Beranda">Beranda</a></td>
      <?php if ($_SESSION['role'] == 'admin') { ?>
          <td><a href="pegawai.php?hal=Pegawai">Pegawai</a></td>
          <td><a href="barang.php">Barang</a></td>
          <td><a href="riwayat_stok.php">Riwayat Stok</a></td>
      <?php } ?> 
      <td><a href="stok_barang.php">Stok Barang</a></td>
      <td><a href="supplier.php">Supplier</a></td>
      <td><a href="transaksi.php">Transaksi</a></td>
      <td><a href="#">Laporan</a></td>
      <td><a href="logout.php">Keluar</a></td>
    </tr>
  </table>

</body>
</html>