<!DOCTYPE html>
<html>
<head>
	<title>Stok Barang | Edit</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		$id = $_GET['id'];

		include 'navbar.php';
		include 'koneksi.php';

		$query_stok_barang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM stok_barang WHERE id_stok = $id"));
	?>
	<h1 align="center">Edit Data Stok Barang</h1>
	<form action="#" method="POST">
		<table border="1" width="250" align="center">
			<tr>
				<td>Stok</td>
				<td><input type="number" name="stok" required value="<?= $query_stok_barang['stok'] ?>"></td>
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
							if ($query_siswa['id_barang'] == $data_barang['id_barang']) {
								$selected = "selected";
							}else{
								$selected = "";
							}
							echo "<option value='$data_barang[id_barang]' $selected>$data_barang[nama_barang]</option>";
						}
					}
					 ?>
					 </select>
				</td> 
			</tr>
			<tr align="center">
				<td colspan="2"><button type="submit" name="edit">Edit</button> | <button><a href="stok_barang.php">Kembali</a></button></td>
			</tr>
		</table>
	</form>

</body>
</html>
<?php 
if ($_POST) {
	$stok = mysqli_real_escape_string($db,$_POST['stok']);
	$id_barang = mysqli_real_escape_string($db,$_POST['id_barang']);

	$query_edit = mysqli_query($db,"UPDATE stok_barang SET stok = '$stok', id_barang = '$id_barang' WHERE id_stok = $id");
	if ($query_edit) {
		echo "<script>alert('Anda Berhasil Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=stok_barang.php?hal=stok_barang'>";
		}else{
			echo "<script>alert('Anda Gagal Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=stok_barang_edit.php?hal=stok_barang&id=$id'>";
		}
}

 ?>