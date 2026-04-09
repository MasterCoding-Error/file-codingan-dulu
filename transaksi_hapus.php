<?php  
include 'koneksi.php';

$id = $_GET['id'];

$cek_barang = mysqli_query($db,"SELECT * FROM keranjang WHERE id_transaksi = $id");

if (mysqli_num_rows($cek_barang) > 0) {
	echo "<script>alert('Hapus Barang Di Keranjang Terlebih Dahulu')</script>";
	echo "<meta http-equiv='refresh' content='0
			url=transaksi.php?hal=transaksi'>";
} else {
	$hapus = mysqli_query($db,"DELETE FROM transaksi WHERE id_transaksi = '$id'");

if ($hapus) {
	echo "<script>alert('Anda Berhasil Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
				url=transaksi.php?hal=transaksi'>";
}else{
	echo "<script>alert('Anda Gagal Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
			url=transaksi_edit.php?hal=transaksi'>";
		}
}

?>