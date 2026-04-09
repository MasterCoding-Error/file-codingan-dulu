<!DOCTYPE html>
<html>
<head>
	<title>Nota</title>
	<style type="text/css">
		@media print {
			body * {
				visibility: hidden;
			}
			#printArea, #printArea * {
				visibility: visible;
			}
			#printArea {
				position: absolute;
				left: 0;
				top: 0;
			}
		}
	</style>

</head>
<body>
<?php 
include 'koneksi.php';
$id_transaksi = $_GET['id'];

$data_transaksi = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi"));
$data_keranjang = mysqli_query($db,"SELECT * FROM keranjang WHERE id_transaksi = $id_transaksi");
$data_pegawai = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM pegawai WHERE id_pegawai	 = $data_transaksi[id_pegawai]"));
?>
<div id="printArea">
<table border="1" align="center" width="400">
	<tr>
		<td>
			<table align="center" width="100%" cellspacing="5">
				<tr>
					<td colspan="2" align="center">
						<h3>Majoe Makmoer</h3>
						Jl. Laksamana Martadinata Gg IIA<br>
						No. Telp : 085607714164
						<hr>
					</td>
				</tr>
				<tr>
					<td><?php 
						echo "Tanggal : ".date('d-m-Y'); 
						echo "<br>";
						echo "Waktu : ".date('h:i:s');
					?>
					</td>
					<td align="right">
						Kasir<br>
						<?= $data_pegawai['nama_pegawai'] ?>
					</td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<?php 
				$total_harga_barang = array();
			$array = 0;
			while ($data = mysqli_fetch_assoc($data_keranjang)) {
				$query_barang = mysqli_fetch_assoc(mysqli_query($db,"SELECT * FROM barang WHERE id_barang = $data[id_barang]"));
				$total_harga_barang[] = $data['jumlah_barang'] * $query_barang['harga_barang'];
				echo "<tr>
						<td>
							<b>$query_barang[nama_barang]</b><br>
							Qty : $data[jumlah_barang] x Rp. $query_barang[harga_barang]
						</td>
						<td>Rp. $total_harga_barang[$array]</td>
					 </tr>";
					 $array++;	
			}
		$total_keseluruhan = array_sum($total_harga_barang);
		
				?>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td><b>Sub Total</b></td>
					<td><b>Rp. <?= $total_keseluruhan ?></b></td>
					<?php mysqli_query($db,"UPDATE transaksi SET total_belanja = $total_keseluruhan WHERE id_transaksi = $id_transaksi"); ?>
				</tr>
				<tr>
					<td>Bayar</td>
					<td>Rp. <?= $data_transaksi['bayar'] ?></td>
				</tr>
				<tr>
					<td>Kembali</td>
					<td>Rp. <?= $data_transaksi['bayar'] - $total_keseluruhan ?></td>
				</tr>
				<tr>
					<td colspan="2"><hr></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						Terima Kasih <br>
						Saran & Kritik <br>
						Jl. Laksamana Martadinata Gg IIA & No. Telp 085607714164
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>