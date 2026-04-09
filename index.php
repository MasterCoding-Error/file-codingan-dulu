<!DOCTYPE html>
<html>
<head>
	<title>Beranda</title>
</head>
<body style="background-color: ">
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		$role = $_SESSION['role'];
		include 'navbar.php';
	?>

	<h1 align="center">Selamat Datang Di Warung Pak Sabar</h1>
	<h4 align="center" style="font-family: arial">-- <?= $role ?> --</h4>

</body>
</html>