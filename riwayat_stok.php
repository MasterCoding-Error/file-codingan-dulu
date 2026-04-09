<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Stok</title>
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
	<h1 align="center">DATA RIWAYAT STOK</h1>
	<center><a href="riwayat_stok_tambah.php">Tambah data</a></center>
	<table width="60%" border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>Jumlah Barang</th>
			<th>Barang</th>
			<th>Aksi</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$query_riwayat_stok = mysqli_query($db,"SELECT * FROM riwayat_stok");
		if (mysqli_num_rows($query_riwayat_stok) == 0) {
			echo "<tr align='center'><td colspan='4'>Data Kosong</td></tr>";
		} else {
			$no = 1;
			while ($data = mysqli_fetch_assoc($query_riwayat_stok)) {
				$query_barang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM barang WHERE id_barang = $data[id_barang]"));
				echo "<tr> 
						<td>$no</td>
						<td>$data[jumlah_barang]</td>
						<td>$query_barang[nama_barang]</td>
						<td><a href='riwayat_stok_edit.php?id=$data[id_riwayat]'>edit</a> | <a href='riwayat_stok_hapus.php?id=$data[id_riwayat]'>hapus</a></td>
					 </tr>";
					 $no++;
			}
		}
		
	?>
	</table>
</body>
</html>
<?php } else { echo "Halaman Tidak Ditemukan";}  ?>