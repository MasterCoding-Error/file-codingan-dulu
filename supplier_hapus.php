<?php  
include 'koneksi.php';

$id = $_GET['id'];

$hapus = mysqli_query($db,"DELETE FROM supplier WHERE id_supplier = '$id'");

if ($hapus) {
	echo "<script>alert('Anda Berhasil Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
				url=supplier.php?hal=supplier'>";
}else{
	echo "<script>alert('Anda Gagal Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
			url=supplier_edit.php?hal=supplier'>";
		}

?>