<!DOCTYPE html>
<html>
<head>
	<title>Stok Barang</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		include 'navbar.php';
	?>
	<h1 align="center">DATA STOK BARANG</h1>
	<!--<center><a href="stok_barang_tambah.php">Tambah data</a></center>-->
	<table width="60%" border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>Barang</th>
			<th>Stok</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$query_stok_barang = mysqli_query($db,"SELECT * FROM stok_barang");
		if (mysqli_num_rows($query_stok_barang) == 0) {
			echo "<tr align='center'><td colspan='4'>Data Kosong</td></tr>";
		} else {
			$no = 1;
			while ($data = mysqli_fetch_assoc($query_stok_barang)) {
				$query_barang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM barang WHERE id_barang = $data[id_barang]"));
				echo "<tr> 
						<td>$no</td>
						<td>$query_barang[nama_barang]</td>
						<td>$data[stok]</td>
					 </tr>";
					 $no++;
			}
		}
		
	?>
	</table>
</body>
</html>