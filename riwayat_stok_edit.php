<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Stok | Edit</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		if ($_SESSION['role'] == 'admin'){
		$id = $_GET['id'];

		include 'navbar.php';
		include 'koneksi.php';

		$query_riwayat_stok = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM riwayat_stok WHERE id_riwayat = $id"));
		$query_barang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM barang WHERE id_barang = $query_riwayat_stok[id_barang]"));
	?>
	<h1 align="center">Edit Data Riwayat Stok</h1>
	<form action="#" method="POST">
		<table border="1" width="250" align="center">
			<tr>
				<td>Stok</td>
				<td><input type="number" name="jumlah_barang" required value="<?= $query_riwayat_stok['jumlah_barang'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Barang</td>
				<td>
					<input type="text" value="<?= $query_barang['nama_barang'] ?>" disabled>
					<input type="hidden" name="id_barang" value="<?= $query_barang['id_barang'] ?>">
				</td> 
			</tr>
			<tr align="center">
				<td colspan="2"><button type="submit" name="edit">Edit</button> | <button><a href="riwayat_stok.php">Kembali</a></button></td>
			</tr>
		</table>
	</form>

</body>
</html>
<?php 
if ($_POST) {
	$jumlah_barang = mysqli_real_escape_string($db,$_POST['jumlah_barang']);
	$id_barang = mysqli_real_escape_string($db,$_POST['id_barang']);

	$query_edit = mysqli_query($db,"UPDATE riwayat_stok SET jumlah_barang = '$jumlah_barang', id_barang = '$id_barang' WHERE id_riwayat = $id");
	if ($query_edit) {
		$data_stok = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM  stok_barang WHERE id_barang = $id_barang "));
		 	$hasil =$jumlah_barang + $data_stok['stok'] - $query_riwayat_stok['jumlah_barang'];
		 	mysqli_query($db, "UPDATE stok_barang SET stok = $hasil WHERE id_barang = $id_barang");
		echo "<script>alert('Anda Berhasil Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=riwayat_stok.php?hal=riwayat_stok'>";
		}else{
			echo "<script>alert('Anda Gagal Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=riwayat_stok_edit.php?hal=riwayat_stok&id=$id'>";
		}
}
} else { echo "Halaman Tidak Ditemukan";}
 ?>