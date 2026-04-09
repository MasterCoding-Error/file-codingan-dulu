<!DOCTYPE html>
<html>
<head>
	<title>Pegawai | Tambah</title>
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


	<h1 align="center">Tambah Data Pegawai</h1>
	<form action="#" method="POST">
	<table border="1" width="250" align="center">
		<tr>
				<td>nama</td>
				<td><input type="text" name="nama_pegawai" required></td>
			</tr>
			<tr>
				<td>alamat</td>
				<td><input type="text" name="alamat" required></td> 
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td><input type="radio" name="jk" value="Laki-Laki" checked>Laki-Laki
					<input type="radio" name="jk" value="Perempuan" checked>Perempuan
				</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td><input type="date" name="tgl_lahir" required></td> 
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<select name="role">
						<option value="admin">Admin</option>
						<option value="karyawan">Karyawan</option>
					</select>
				</td> 
			</tr>
			<tr>
				<td>username</td>
				<td><input type="text" name="username" required></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="password" required></td> 
			</tr>
		<tr align="center">
			<td colspan="2"><button type="submit" name="tambah">Tambah</button> | <button><a href="pegawai.php">Kembali</a></button></td>
		</tr>
	</table>
	</form>

	<?php
	if ($_POST) {
	 	include 'koneksi.php';

		 	$nama_pegawai =  mysqli_real_escape_string($db,$_POST['nama_pegawai']);
			$alamat =  mysqli_real_escape_string($db,$_POST['alamat']);
			$jk =  mysqli_real_escape_string($db,$_POST['jk']);
			$tgl_lahir =  mysqli_real_escape_string($db,$_POST['tgl_lahir']);
			$role =  mysqli_real_escape_string($db,$_POST['role']);
			$username =  mysqli_real_escape_string($db,$_POST['username']);
			$password =  mysqli_real_escape_string($db,$_POST['password']);


			$cek_username =  mysqli_query($db,"SELECT * FROM pegawai WHERE username = '$username'");

			if (mysqli_num_rows($cek_username) > 0)  {
				echo "<script>alert('Username Sudah Terdaftar')</script>";
				echo "<meta http-equiv='refresh' content='0 url=pegawai.php'>";
			}else{

			 $query_tambah = mysqli_query($db, "INSERT INTO pegawai VALUES(NULL,'$nama_pegawai','$alamat','$jk','$tgl_lahir','$role','$username','$password')");


		 if ($query_tambah) {
		 	echo "<script>alert('Anda Berhasil Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=pegawai.php?hal=pegawai'>";
		}else{
			echo "<script>alert('Anda Gagal Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=pegawai_tambah.php?hal=pegawai'>";
		}
	}
}

} else { echo "Halaman Tidak Ditemukan";} 
	?>