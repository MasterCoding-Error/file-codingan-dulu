<!DOCTYPE html>
<html>
<head>
	<title>Transaksi</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		$id_pegawai = $_SESSION['id_pegawai'];
		include 'navbar.php';
		include 'koneksi.php';

		$query_pegawai =  mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM pegawai WHERE id_pegawai = $id_pegawai"));
	?>
	<h1 align="center">Data Transaksi</h1>
	<form action="#" method="POST">
	<table border="1" width="250" align="center">			
			<tr>
				<td>Nama Pegawai</td>
				<td>
					<input value="<?= $query_pegawai['nama_pegawai'] ?>" disabled>
					<input type="hidden" name="id_pegawai" value="<?= $query_pegawai['id_pegawai'] ?>">
				</td> 
			</tr>
		<tr align="center">
			<td colspan="2"><button type="submit" name="tambah">Tambah</button></td>
		</tr>
	</table>
	</form>
	<br>
	<table width="60%" border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>Tanggal Transaksi</th>
			<th>Total Belanja</th>
			<th>Total Belanja</th>
			<th>Nama Pegawai</th>
			<th>Aksi</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$query_transaksi = mysqli_query($db,"SELECT * FROM transaksi");

		if (mysqli_num_rows($query_transaksi) == 0) {
			echo "<tr align='center'><td colspan='6'>Data Kosong</td></tr>";
		} else {
			$no = 1;
			while ($data = mysqli_fetch_assoc($query_transaksi)) {
				if ($data['bayar'] > 0) {
					$pilihan = "<a href='cetak_nota.php?id=$data[id_transaksi]' target='blank'>Cetak Nota</a> | <a href='detail_transaksi.php?id=$data[id_transaksi]'>Detail Transaksi</a>";
				} else {
					$pilihan = "<a href='transaksi_hapus.php?id=$data[id_transaksi]'>hapus</a> | <a href='keranjang.php?id=$data[id_transaksi]'>keranjang</a>";
				}
				
				$query_pegawai = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM pegawai WHERE id_pegawai = $data[id_pegawai]"));
				$format_rupiah = "Rp " . number_format($data['total_belanja'], 0, ',', '.');
				echo "<tr> 
						<td>$no</td>
						<td>$data[tgl_transaksi]</td>
						<td>$format_rupiah</td>
						<td>$data[total_belanja]</td>
						<td>$query_pegawai[nama_pegawai]</td>
						<td>$pilihan</td>
					 </tr>";
					 $no++;
			}
		}
		
	?>
	</table>
</body>
</html>
<?php
	if ($_POST) {
	 	

	 	$tgl_transaksi = mysqli_real_escape_string($db,$_POST['tgl_transaksi']);
		$id_pegawai = mysqli_real_escape_string($db,$_POST['id_pegawai']);

	 	$query_tambah = mysqli_query($db, "INSERT INTO transaksi VALUES(NULL,NULL,0,0,'$id_pegawai')");
	 
		 if ($query_tambah) {
		 	echo "<script>alert('Anda Berhasil Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=transaksi.php?hal=transaksi'>";
		}else{
			echo "<script>alert('Anda Gagal Data')</script>";
			echo "<meta http-equiv='refresh' content='0
				url=transaksi.php?hal=transaksi'>";
		}
}
?>