<!DOCTYPE html>
<html>
<head>
	<title>Barang | Edit</title>
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

		$query_barang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM barang WHERE id_barang = $id"));
	?>
	<h1 align="center">Edit Data barang</h1>
	<form action="#" method="POST">
		<table border="1" width="250" align="center">
			<tr>
				<td>Nama Barang</td>
				<td><input type="text" name="nama_barang" required value="<?= $query_barang['nama_barang'] ?>"></td>
			</tr>
			<tr>
				<td>Tanggal Kadaluarsa</td>
				<td><input type="date" name="tgl_kadaluarsa" required value="<?= $query_barang['tgl_kadaluarsa'] ?>"></td> 
			</tr>
			<tr>
				<td>Kode Barang</td>
				<td><input type="number" name="kode_barang" required value="<?= $query_barang['kode_barang'] ?>"></td> 
			</tr>
			<tr>
				<td>Harga</td>
				<td>
					<input type="number" name="harga_barang" required value="<?= $query_barang['harga_barang'] ?>">
				</td> 
			</tr>
			<tr>
				<td>Supplier</td>
				<td>
					<select name="id_supplier">
					<?php 
					include 'koneksi.php';

					$query_supplier = mysqli_query($db,"SELECT * FROM supplier");
					if (mysqli_num_rows($query_supplier) == 0) {
						echo "<option>Data Tidak Ditemukan</option>";
					}else{
						while ($data_supplier = mysqli_fetch_assoc($query_supplier)) {
							if ($query_barang['id_supplier'] == $data_supplier['id_supplier']) {
								$selected = "selected";
							}else{
								$selected = "";
							}
							echo "<option value='$data_supplier[id_supplier]' $selected>$data_supplier[nama_supplier]</option>";
						}
					}
					 ?>
					 </select>
				</td>
			</tr>
			<tr align="center">
				<td colspan="2"><button type="submit" name="edit">Edit</button> | <button><a href="barang.php">Kembali</a></button></td>
			</tr>
		</table>
	</form>

</body>
</html>
<?php 
if ($_POST) {
	$nama_barang =  mysqli_real_escape_string($db,$_POST['nama_barang']);
	$tgl_kadaluarsa =  mysqli_real_escape_string($db,$_POST['tgl_kadaluarsa']);
	$kode_barang =  mysqli_real_escape_string($db,$_POST['kode_barang']);
	$harga_barang =  mysqli_real_escape_string($db,$_POST['harga_barang']);
	$id_supplier =  mysqli_real_escape_string($db,$_POST['id_supplier']);

	$query_edit = mysqli_query($db,"UPDATE barang SET nama_barang = '$nama_barang', tgl_kadaluarsa = '$tgl_kadaluarsa', kode_barang = '$kode_barang', harga_barang = '$harga_barang', id_supplier = '$id_supplier' WHERE id_barang = $id");
	if ($query_edit) {
		echo "<script>alert('Anda Berhasil Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=barang.php?hal=barang'>";
		}else{
			echo "<script>alert('Anda Gagal Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=barang_edit.php?hal=barang&id=$id'>";
		}
}

} else { echo "Halaman Tidak Ditemukan";} 
 ?>