<!DOCTYPE html>
<html>
<head>
	<title>Pegawai | Edit</title>
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

		$query_pegawai = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM pegawai WHERE id_pegawai = $id"));
	?>
	<h1 align="center">Edit Data Pegawai</h1>
	<form action="#" method="POST">
		<table border="1" width="250" align="center">
			<tr>
				<td>nama</td>
				<td><input type="text" name="nama_pegawai" required value="<?= $query_pegawai['nama_pegawai'] ?>"></td>
			</tr>
			<tr>
				<td>alamat</td>
				<td><input type="text" name="alamat" required value="<?= $query_pegawai['alamat'] ?>"></td> 
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td><input type="radio" name="jk" value="Laki-Laki" <?php if ($query_pegawai['jk'] == "Laki-Laki") {echo "checked";}?> required>Laki-Laki
					<input type="radio" name="jk" value="Perempuan" <?php if ($query_pegawai['jk'] == "Perempuan") {echo "checked";}?> required>Perempuan
				</td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td><input type="date" name="tgl_lahir" required value="<?= $query_pegawai['tgl_lahir'] ?>"></td> 
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<select name="role" value="<?= $query_pegawai['role'] ?>">
						<option value="admin" <?php if ($query_pegawai['role'] == "admin") {echo "selected";}?> required>Admin</option>
						<option value="karyawan" <?php if ($query_pegawai['role'] == "karyawan") {echo "selected";}?> required>Karyawan</option>
					</select>
				</td> 
			</tr>
			<tr>
				<td>username</td>
				<td><input type="text" name="username" required value="<?= $query_pegawai['username'] ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="password" required value="<?= $query_pegawai['password'] ?>"></td> 
			</tr>
			<tr align="center">
				<td colspan="2"><button type="submit" name="edit">Edit</button> | <button><a href="pegawai.php">Kembali</a></button></td>
			</tr>
		</table>
	</form>

</body>
</html>
<?php 
if ($_POST) {
	$nama_pegawai =  mysqli_real_escape_string($db,$_POST['nama_pegawai']);
	$alamat =  mysqli_real_escape_string($db,$_POST['alamat']);
	$jk =  mysqli_real_escape_string($db,$_POST['jk']);
	$tgl_lahir =  mysqli_real_escape_string($db,$_POST['tgl_lahir']);
	$role =  mysqli_real_escape_string($db,$_POST['role']);
	$username =  mysqli_real_escape_string($db,$_POST['username']);
	$password =  mysqli_real_escape_string($db,$_POST['password']);

	$query_edit = mysqli_query($db,"UPDATE pegawai SET nama_pegawai = '$nama_pegawai', alamat = '$alamat', jk = '$jk', tgl_lahir = '$tgl_lahir', role = '$role', username = '$username', password = '$password' WHERE id_pegawai = $id");
	if ($query_edit) {
		echo "<script>alert('Anda Berhasil Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=pegawai.php?hal=pegawai'>";
		}else{
			echo "<script>alert('Anda Gagal Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=pegawai_edit.php?hal=pegawai&id=$id'>";
		}
}
} else { echo "Halaman Tidak Ditemukan";} 
 ?>