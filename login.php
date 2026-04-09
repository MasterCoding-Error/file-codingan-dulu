<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

</head>
<body>
	<?php 
		if (isset($_GET['pesan'])) {
			if ($_GET['pesan'] == "gagal") {
				echo "Login gagal! username dan password salah";
			}
			elseif ($_GET['pesan'] == "logout") {
				echo "Anda telah berhasil logout";
			}
			elseif ($_GET['pesan'] == "belum_login") {
				echo "Anda harus login untuk mengakses halaman admin";
			}
		}
	?>
	<form action="#" method="POST">
	<table border="1" width="250" align="center">
		<tr>
			<td colspan="2" align="center">Login</td>
		</tr>
		<tr>
			<td>Username</td>
			<td>:<input name="username" required></td>
		</tr>
		<tr>
			<td>Password</td>
			<td>:<input name="password" type="password" required></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><button type="submit" name="cek_login">Login</button></td>
		</tr>
	</table>
	</form>

</body>
</html>

<?php 
if ($_POST) {
	include "koneksi.php";

	$username = mysqli_real_escape_string($db,$_POST['username']);
	$password = mysqli_real_escape_string($db,$_POST['password']);

	$login = mysqli_query($db,"SELECT * FROM pegawai WHERE 
		username = '$username' AND password = '$password'");

	$data_role = mysqli_fetch_assoc($login);

	if (mysqli_num_rows($login) > 0) {
		session_start();
		$_SESSION['status'] = 'login';
		$_SESSION['role'] = $data_role['role'];
		$_SESSION['id_pegawai'] = $data_role['id_pegawai'];
		echo "<script>alert('Anda Berhasil Login')</script>";
		echo "<meta http-equiv='refresh' content='0
			url=index.php'>";
	}else{
		echo "<script>alert('Anda Gagal Login')</script>";
		echo "<meta http-equiv='refresh' content='0
			url=login.php?pesan=gagal'>";
	}
}
?>