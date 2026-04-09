<!DOCTYPE html>
<html>
<head>
	<title>supplier | Tambah</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		include 'navbar.php';
	?>


	<h1 align="center">TAMBAH DATA SUPPLIER</h1>
	<form action="#" method="POST">
	<table border="1" width="250" align="center">
		<tr>
				<td>Nama</td>
				<td><input type="text" name="nama_supplier" required></td>
			</tr>
			<tr align="center">
			<td colspan="2"><button type="submit" name="tambah">Tambah</button> | <button><a href="supplier.php">Kembali</a></button></td>
		</tr>
	</table>
	</form>

	<?php
	if ($_POST) {
	 	include 'koneksi.php';

	 	$nama_supplier = mysqli_real_escape_string($db,$_POST['nama_supplier']);

	 	$query_tambah = mysqli_query($db, "INSERT INTO supplier VALUES(NULL,'$nama_supplier')");
	 
		 if ($query_tambah) {
		 	echo "<script>alert('Anda Berhasil Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=supplier.php?hal=supplier'>";
		}else{
			echo "<script>alert('Anda Gagal Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=supplier_tambah.php?hal=supplier'>";
		}
}
	?>