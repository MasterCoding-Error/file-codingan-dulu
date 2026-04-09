<!DOCTYPE html>
<html>
<head>
	<title>Keranjang</title>
</head>
<body>
	<?php
		session_start();
		if ($_SESSION['status']!="login") {
			header("location:login.php?pesan=belum_login");
		}
		$id_transaksi = $_GET['id'];
		include 'navbar.php';
	?>
	<h1 align="center">Detail Transaksi No. <?= $id_transaksi ?></h1>
	<br>
	<table width="60%" border="1" align="center">
		<tr align="center">
			<th>No</th>
			<th>Jumlah Barang</th>
			<th>Barang</th>
			<th>Harga Barang</th>
			<th>Total Harga Barang</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$query_keranjang = mysqli_query($db,"SELECT * FROM keranjang WHERE id_transaksi = $id_transaksi"); 
		if (mysqli_num_rows($query_keranjang) == 0) {
			echo "<tr align='center'><td colspan='6'>Data Kosong Broo</td></tr>";
		} else {
			$total_harga_barang = array();
			$no = 1;
			$array = 0;
			while ($data = mysqli_fetch_assoc($query_keranjang)) {
				$query_barang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM barang WHERE id_barang = $data[id_barang]"));
				$query_transaksi= mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM transaksi WHERE id_transaksi = $data[id_transaksi]"));
				$total_harga_barang[] = $data['jumlah_barang'] * $query_barang['harga_barang'];
				echo "<tr> 
						<td>$no</td>
						<td>$data[jumlah_barang]</td>
						<td>$query_barang[nama_barang]</td>
						<td>$query_barang[harga_barang]</td>
						<td>$total_harga_barang[$array]</td>
					 </tr>";
					 $no++;
					 $array++;	
			}
		$total_keseluruhan = array_sum($total_harga_barang);
		}
	
	?>

	<tr>
		<th colspan="4">Total Keseluruhan</th>
		<th colspan="2"><?php if(mysqli_num_rows($query_keranjang) == 0){echo "0";}else{echo "$total_keseluruhan";}$total_keseluruhan ?></th>
	</tr>
	<tr>
		<th colspan="4">Bayar</th>
		<th colspan="2"><?php $data1_transaksi = mysqli_fetch_assoc(mysqli_query($db,"SELECT bayar FROM transaksi WHERE id_transaksi = $id_transaksi")); echo "$data1_transaksi[bayar]"; ?></th>
	</tr>
	<tr>
		<th colspan="4">Kembali</th>
		<th colspan="2"><?php $kembali = $data1_transaksi['bayar']  - $total_keseluruhan; echo "$kembali"; ?></th>
	</tr>
	</table>
</body>
</html>

<?php
if ($_POST) {
	if  ($_POST['tambah'] == "barang") {
		include 'koneksi.php';

	 	$jumlah_barang =  mysqli_real_escape_string($db,$_POST['jumlah_barang']);
		$id_barang =  mysqli_real_escape_string($db,$_POST['id_barang']);
		$id_transaksi =  mysqli_real_escape_string($db,$_POST['id_transaksi']);

		$data_stok = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM stok_barang WHERE id_barang = $id_barang"));

		if ($jumlah_barang > $data_stok['stok'] || $jumlah_barang < 1) {
			echo "<script>alert('Barang hanya tersedia $data_stok[stok] stok')</script>";
			echo "<meta http-equiv='refresh' content='0 url=keranjang.php?hal=keranjang&id=$id_transaksi'>";
		}else{
			$hasil = $data_stok['stok'] - $jumlah_barang;
			mysqli_query($db,"UPDATE stok_barang SET stok = $hasil WHERE id_barang = $id_barang");

			$query_tambah = mysqli_query($db, "INSERT INTO keranjang VALUES(NULL,'$jumlah_barang','$id_barang','$id_transaksi')");
		 
		 if ($query_tambah) {
			echo "<script>alert('Anda Berhasil Data')</script>";
			echo "<meta http-equiv='refresh' content='0 url=keranjang.php?hal=keranjang&id=$id_transaksi'>";
		}else{
			echo "<script>alert('Anda Gagal Data')</script>";
			echo "<meta http-equiv='refresh' content='0 url=keranjang_tambah.php?hal=keranjang&id=$id_transaksi'>";
		}
	}
		}else{

			$bayar = mysqli_escape_string($db,$_POST['bayar']);
			$id = mysqli_escape_string($db,$_POST['id']);

			$query_transaksi = mysqli_query($db,"UPDATE transaksi SET bayar = $bayar WHERE id_transaksi = $id");

			if ($query_transaksi) {
				echo "<script>alert('Anda Berhasil Data')</script>";
				echo "<script>window.open('cetak_nota.php?id=$id_transaksi','_blank');</script>";
				echo "<meta http-equiv='refresh' content='0 url=transaksi.php'>";
			}else{
				echo "<script>alert('Anda Gagal Data')</script>";
				echo "<meta http-equiv='refresh' content='0 url=keranjang_tambah.php?id=$id_transaksi'>";
			}

		}
	 	
	}
	?>