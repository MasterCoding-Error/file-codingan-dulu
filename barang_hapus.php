<?php  
include 'koneksi.php';

$id = $_GET['id'];

mysqli_query($db, "DELETE FROM stok_barang WHERE id_barang = '$id'");

$hapus = mysqli_query($db,"DELETE FROM barang WHERE id_barang = '$id'");

if ($hapus) {
	echo "<script>alert('Anda Berhasil Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
				url=barang.php?hal=barang'>";
}else{
	echo "<script>alert('Anda Gagal Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
			url=barang_edit.php?hal=barang'>";
		}

?>