<!DOCTYPE html>
<html>
<head>
	<title>Transaksi | Edit</title>
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

		$query_transaksi = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM transaksi WHERE id_transaksi = $id"));
	?>
	<h1 align="center">Edit Data TRANSAKSI</h1>
	<form action="#" method="POST">
		<table border="1" width="250" align="center">
			<tr>
				<td>Tanggal Transaksi</td>
				<td><input type="date" name="tgl_transaksi" required value="<?= $query_transaksi['tgl_transaksi'] ?>"></td>
			</tr>
			<tr>
				<td>Id Pegawai</td>
				<td>
					<select name="id_pegawai">
					<?php 
					include 'koneksi.php';

					$query_pegawai = mysqli_query($db,"SELECT * FROM pegawai");
					if (mysqli_num_rows($query_pegawai) == 0) {
						echo "<option>Data Tidak Ditemukan</option>";
					}else{
						while ($data_pegawai = mysqli_fetch_assoc($query_pegawai)) {
							if ($query_transaksi['id_pegawai'] == $data_pegawai['id_pegawai']) {
								$selected = "selected";
							}else{
								$selected = "";
							}
							echo "<option value='$data_pegawai[id_pegawai]' $selected>$data_pegawai[nama_pegawai]</option>";
						}
					}
					 ?>
					 </select>
				</td> 
			</tr>
			<tr align="center">
				<td colspan="2"><button type="submit" name="edit">Edit</button> | <button><a href="transaksi.php">Kembali</a></button></td>
			</tr>
		</table>
	</form>

</body>
</html>
<?php 
if ($_POST) {
	$tgl_transaksi = mysqli_real_escape_string($db,$_POST['tgl_transaksi']);
	$id_pegawai = mysqli_real_escape_string($db,$_POST['id_pegawai']);

	$query_edit = mysqli_query($db,"UPDATE transaksi SET tgl_transaksi = '$tgl_transaksi', id_pegawai = '$id_pegawai' WHERE id_transaksi = $id");
	if ($query_edit) {
		echo "<script>alert('Anda Berhasil Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=transaksi.php?hal=transaksi'>";
		}else{
			echo "<script>alert('Anda Gagal Edit')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=transaksi_edit.php?hal=transaksi&id=$id'>";
		}
}

 ?>