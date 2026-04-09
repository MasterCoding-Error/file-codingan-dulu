<?php  
include 'koneksi.php';

$id = $_GET['id'];

$hapus = mysqli_query($db,"DELETE FROM pegawai WHERE id_pegawai = '$id'");

if ($hapus) {
	echo "<script>alert('Anda Berhasil Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
				url=pegawai.php?hal=pegawai'>";
}else{
	echo "<script>alert('Anda Gagal Hapus Data')</script>";
	echo "<meta http-equiv='refresh' content='0
			url=pegawai_edit.php?hal=pegawai'>";
		}

?>