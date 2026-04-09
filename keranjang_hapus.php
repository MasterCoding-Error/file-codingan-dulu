<?php  
include 'koneksi.php';

$id = $_GET['id'];
$id_transaksi = $_GET['id_transaksi'];

$data_keranjang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM keranjang WHERE id_keranjang = $id"));
$data_stok = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM stok_barang WHERE id_barang = $data_keranjang[id_barang]"));

$hasil = $data_keranjang['jumlah_barang'] + $data_stok['stok'];

mysqli_query($db,"UPDATE stok_barang SET stok = $hasil WHERE id_barang = $data_keranjang[id_barang]");

$hapus = mysqli_query($db,"DELETE FROM keranjang WHERE id_keranjang = '$id'");

if ($hapus) {
	echo "<script>alert('Anda Berhasil Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
				url=keranjang.php?hal=keranjang&id=$id_transaksi'>";
}else{
	echo "<script>alert('Anda Gagal Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
			url=keranjang_edit.php?hal=keranjang&id=$id_transaksi'>";
		}

?>