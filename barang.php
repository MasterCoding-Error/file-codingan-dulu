<!DOCTYPE html>
<html>
<head>
	<title>Barang</title>
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
	<h1 align="center">Data Barang</h1>
	<center><a href="barang_tambah.php">Tambah Data</a></center>
	<table width="60%" border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>Nama</th>
			<th>Tanggal Kadaluarsa</th>
			<th>Kode Barang</th>
			<th>Harga Barang</th>
			<th>Supplier</th>
			<th>Aksi</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$query_barang = mysqli_query($db,"SELECT * FROM barang");
		if (mysqli_num_rows($query_barang) == 0) {
			echo "<tr align='center'><td colspan='7'>Data Kosong</td></tr>";
		} else {
			$no = 1;
			while ($data = mysqli_fetch_assoc($query_barang)) {
				$query_supplier = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM supplier WHERE id_supplier = $data[id_supplier]"));
				echo "<tr> 
						<td>$no</td>
						<td>$data[nama_barang]</td>
						<td>$data[tgl_kadaluarsa]</td>
						<td>$data[kode_barang]</td>
						<td>$data[harga_barang]</td>
						<td>$query_supplier[nama_supplier]</td>
						<td><a href='barang_edit.php?id=$data[id_barang]'>edit</a> | <a href='barang_hapus.php?id=$data[id_barang]'>hapus</a></td>
					 </tr>";
					 $no++;
			}
		}
		
	?>
	</table>
</body>
</html>
<?php } else { echo "Halaman Tidak Ditemukan";} ?>