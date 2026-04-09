<!DOCTYPE html>
<html>
<head>
	<title>Supplier | Edit</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		$id = $_GET['id'];

		include 'navbar.php';
		include 'koneksi.php';

		$query_supplier = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM supplier WHERE id_supplier = $id"));
	?>
	<h1 align="center">EDIT DATA SUPPLIER</h1>
	<form action="#" method="POST">
		<table border="1" width="250" align="center">
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama_supplier" required value="<?= $query_supplier['nama_supplier'] ?>"></td>
			</tr>
		</table>
	</form>

</body>
</html>
<?php 
if ($_POST) {
	$nama_supplier = mysqli_real_escape_string($db,$_POST['nama_supplier']);

	$query_edit = mysqli_query($db,"UPDATE supplier SET nama_supplier = '$nama_supplier' WHERE id_supplier = $id");
	if ($query_edit) {
		echo "<script>alert('Anda Berhasil Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=supplier.php?hal=supplier'>";
		}else{
			echo "<script>alert('Anda Gagal Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=supplier_edit.php?hal=supplier&id=$id'>";
		}
}

 ?>