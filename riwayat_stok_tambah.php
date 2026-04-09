<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Stok | Tambah</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		if ($_SESSION['role'] == 'admin'){
		include 'navbar.php';
	?>


	<h1 align="center">Tambah Data Riwayat Stok</h1>
	<form action="#" method="POST">
	<table border="1" width="250" align="center">
		<tr>
				<td>Jumlah Barang</td>
				<td><input type="number" name="jumlah_barang" required></td>
			</tr>
			<tr>
				<td>Nama Barang</td>
				<td>
					<select name="id_barang">
					<?php 
					include 'koneksi.php';

					$query_barang = mysqli_query($db,"SELECT * FROM barang");
					if (mysqli_num_rows($query_barang) == 0) {
						echo "<option>Data Tidak Ditemukan</option>";
					}else{
						while ($data_barang = mysqli_fetch_assoc($query_barang)) {

							echo "<option value='$data_barang[id_barang]'>$data_barang[nama_barang] </option>";
						}
					}
					 ?>
					 </select>
				</td> 
			</tr>
		<tr align="center">
			<td colspan="2"><button type="submit" name="tambah">Tambah</button> | <button><a href="riwayat_stok.php">Kembali</a></button></td>
		</tr>
	</table>
	</form>

	<?php
	if ($_POST) {
	 	include 'koneksi.php';

	 	$jumlah_barang = mysqli_real_escape_string($db,$_POST['jumlah_barang']);
		$id_barang = mysqli_real_escape_string($db,$_POST['id_barang']);

	 	$query_tambah = mysqli_query($db, "INSERT INTO riwayat_stok VALUES(NULL,'$jumlah_barang','$id_barang')");
	 
		 if ($query_tambah) {
		 	$data_stok = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM  stok_barang WHERE id_barang = $id_barang "));
		 	$hasil =$jumlah_barang + $data_stok['stok'];
		 	mysqli_query($db, "UPDATE stok_barang SET stok = $hasil WHERE id_barang = $id_barang");
		 	echo "<script>alert('Anda Berhasil Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=riwayat_stok.php?hal=riwayat_stok'>";
		}else{
			echo "<script>alert('Anda Gagal Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=riwayat_stok_tambah.php?hal=riwayat_stok'>";
		}
}
} else { echo "Halaman Tidak Ditemukan";}
	?>