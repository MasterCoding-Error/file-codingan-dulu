<!DOCTYPE html>
<html>
<head>
	<title>Pegawai</title>
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
	<h1 align="center">DATA PEGAWAI</h1>
	<center><a href="pegawai_tambah.php">Tambah data</a></center>
	<table width="60%" border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>Nama</th>
			<th>Alamat</th>
			<th>Jenis Kelamin</th>
			<th>Tgl Lahir</th>
			<th>status</th>
			<th>username</th>
			<th>Password</th>
			<th>Aksi</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$query_pegawai = mysqli_query($db,"SELECT * FROM pegawai");
		if (mysqli_num_rows($query_pegawai) == 0) {
			echo "<tr align='center'><td colspan='9'>Data Kosong</td></tr>";
		} else {
			$no = 1;
			while ($data = mysqli_fetch_assoc($query_pegawai)) {
				echo "<tr> 
						<td>$no</td>
						<td>$data[nama_pegawai]</td>
						<td>$data[alamat]</td>
						<td>$data[jk]</td>
						<td>$data[tgl_lahir]</td>
						<td>$data[role]</td>
						<td>$data[username]</td>
						<td>$data[password]</td>
						<td><a href='pegawai_edit.php?id=$data[id_pegawai]'>edit</a> | <a href='pegawai_hapus.php?id=$data[id_pegawai]'>hapus</a></td>
					 </tr>";
					 $no++;
			}
		}
		
	?>
	</table>
</body>
</html>
<?php } else { echo "Halaman Tidak Ditemukan";} ?>