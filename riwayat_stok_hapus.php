<?php  
include 'koneksi.php';

$id = $_GET['id'];

$data_riwayat_stok = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM riwayat_stok WHERE id_riwayat = '$id'"));
$data_stok = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM  stok_barang WHERE id_barang = $data_riwayat_stok[id_barang]"));
$hasil = $data_stok['stok'] - $data_riwayat_stok['jumlah_barang'];
mysqli_query($db, "UPDATE stok_barang SET stok = $hasil WHERE id_barang = $data_riwayat_stok[id_barang]");

$hapus = mysqli_query($db,"DELETE FROM riwayat_stok WHERE id_riwayat = '$id'");

if ($hapus) {
	echo "<script>alert('Anda Berhasil Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
				url=riwayat_stok.php?hal=riwayat_stok'>";
}else{
	echo "<script>alert('Anda Gagal Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
			url=riwayat_stok_edit.php?hal=riwayat_stok'>";
		}

?>