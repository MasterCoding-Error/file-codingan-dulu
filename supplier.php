<!DOCTYPE html>
<html>
<head>
	<title>supplier</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		include 'navbar.php';
	?>
	<h1 align="center">DATA SUPPLIER</h1>
	<center><a href="supplier_tambah.php">Tambah data</a></center>
	<table width="60%" border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>Nama</th>
			<th>Aksi</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$query_supplier = mysqli_query($db,"SELECT * FROM supplier");
		if (mysqli_num_rows($query_supplier) == 0) {
			echo "<tr align='center'><td colspan='3'>Data Kosong</td></tr>";
		} else {
			$no = 1;
			while ($data = mysqli_fetch_assoc($query_supplier)) {
				echo "<tr> 
						<td>$no</td>
						<td>$data[nama_supplier]</td>
						<td><a href='supplier_edit.php?id=$data[id_supplier]'>edit</a> | <a href='supplier_hapus.php?id=$data[id_supplier]'>hapus</a></td>
					 </tr>";
					 $no++;
			}
		}
		
	?>
	</table>
</body>
</html>