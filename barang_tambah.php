<!DOCTYPE html>
<html>
<head>
	<title>Barang | Tambah</title>
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


	<h1 align="center">Tambah Data Barang</h1>
	<form action="#" method="POST">
	<table border="1" width="250" align="center">
		<tr>
				<td>Nama Barang</td>
				<td><input type="text" name="nama_barang" required></td>
			</tr>
			<tr>
				<td>Tanggal Kadaluarsa</td>
				<td><input type="date" name="tgl_kadaluarsa" required></td> 
			</tr>
			<tr>
				<td>Kode Barang</td>
				<td><input type="text" name="kode_barang" required></td> 
			</tr>
			<tr>
				<td>Harga</td>
				<td>
					<input type="number" name="harga_barang" required>
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
							echo "<option value='$data_supplier[id_supplier]'>$data_supplier[nama_supplier]</option>";
						}
					}
					 ?>
					 </select>
				</td>
			</tr>
		<tr align="center">
			<td colspan="2"><button type="submit" name="tambah">Tambah</button> | <button><a href="barang.php">Kembali</a></button></td>
		</tr>
	</table>
	</form>

	<?php
	if ($_POST) {
	 	include 'koneksi.php';

	 	$nama_barang =  mysqli_real_escape_string($db,$_POST['nama_barang']);
		$tgl_kadaluarsa =  mysqli_real_escape_string($db,$_POST['tgl_kadaluarsa']);
		$kode_barang =  mysqli_real_escape_string($db,$_POST['kode_barang']);
		$harga_barang =  mysqli_real_escape_string($db,$_POST['harga_barang']);
		$id_supplier =  mysqli_real_escape_string($db,$_POST['id_supplier']);

	 	$query_tambah = mysqli_query($db, "INSERT INTO barang VALUES(NULL,'$nama_barang','$tgl_kadaluarsa','$kode_barang','$harga_barang','$id_supplier')");

	 
		 if ($query_tambah) { 
		 	$id_barang = mysqli_insert_id($db);
		 	$query_stok = mysqli_query($db, "INSERT INTO stok_barang VALUES(NULL,'$stok','$id_barang')");
		 	echo "<script>alert('Anda Berhasil Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=barang.php?hal=barang'>";
		}else{
			echo "<script>alert('Anda Gagal Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=barang_tambah.php?hal=barang'>";
		}
}

} else { echo "Halaman Tidak Ditemukan";} 

	?>