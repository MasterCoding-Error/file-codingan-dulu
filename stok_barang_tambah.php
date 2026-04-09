<!DOCTYPE html>
<html>
<head>
	<title>Stok | Tambah</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		include 'navbar.php';
	?>


	<h1 align="center">Tambah Data Stok</h1>
	<form action="#" method="POST">
	<table border="1" width="250" align="center">
		<tr>
				<td>Stok</td>
				<td><input type="number" name="stok" required></td>
			</tr>
			<tr>
				<td>Barang</td>
				<td>
					<select name="id_barang">
					<?php 
					include 'koneksi.php';

					$query_barang = mysqli_query($db,"SELECT * FROM barang");
					if (mysqli_num_rows($query_barang) == 0) {
						echo "<option>Data Tidak Ditemukan</option>";
					}else{
						while ($data_barang = mysqli_fetch_assoc($query_barang)) {
							echo "<option value='$data_barang[id_barang]'>$data_barang[nama_barang]</option>";
						}
					}
					 ?>
					 </select>
				</td> 
			</tr>
		<tr align="center">
			<td colspan="2"><button type="submit" name="tambah">Tambah</button> | <button><a href="stok_barang.php">Kembali</a></button></td>
		</tr>
	</table>
	</form>

	<?php
	if ($_POST) {
	 	include 'koneksi.php';

	 	$stok = mysqli_real_escape_string($db,$_POST['stok']);
		$id_barang = mysqli_real_escape_string($db,$_POST['id_barang']);

	 	$query_tambah = mysqli_query($db, "INSERT INTO stok_barang VALUES(NULL,'$stok','$id_barang')");
	 
		 if ($query_tambah) {
		 	echo "<script>alert('Anda Berhasil Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=stok_barang.php?hal=stok_barang'>";
		}else{
			echo "<script>alert('Anda Gagal Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=stok_barang_tambah.php?hal=stok_barang'>";
		}
}
	?>