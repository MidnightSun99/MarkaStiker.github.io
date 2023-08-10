<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include "config.php";
mysqli_query($db, "UPDATE `tb_transaksitracking` SET `notif` = 'T' WHERE `username` = '".$_SESSION['username']."'");
if(isset($_GET['op'])){
	$op	= $_GET['op'];
	if($op == "cancel2"){
		$id		= $_GET['id'];
		$a		= $_POST['a'];
		$query = "UPDATE `tb_transaksi` SET `status` = 'Dibatalkan', `keterangan` = '".$a."' WHERE `idtransaksi` = '".$id."'";
		$hasil = mysqli_query($db, $query);
		$q1 = "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$id."'";
		$h1 = mysqli_query($db, $q1);
		$d1 = mysqli_fetch_array($h1);
		$query	= "INSERT INTO `tb_transaksitracking` (
					`idtransaksi`,
					`tgl`,  
					`status`,
					`username`, 
					`notif`
				) VALUES (
					'".$id."', '".$xtgl."', 'Dibatalkan', '".$d1['username']."', 'Y'
				)";
		$hasil	= mysqli_query($db, $query);
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}elseif($op == "konfirmpesan"){
		$id		= $_GET['id'];
		$query	= "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$id."'";
		$hasil	= mysqli_query($db, $query);
		$data	= mysqli_fetch_array($hasil);
		$query = "UPDATE `tb_transaksi` SET `status` = 'Konfirmasi Pesanan' WHERE `idtransaksi` = '".$id."'";
		$hasil = mysqli_query($db, $query);
		
		$q1 = "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$id."'";
		$h1 = mysqli_query($db, $q1);
		$d1 = mysqli_fetch_array($h1);
		$query	= "INSERT INTO `tb_transaksitracking` (
					`idtransaksi`,
					`tgl`,  
					`status`,
					`username`, 
					`notif`
				) VALUES (
					'".$id."', '".$xtgl."', 'Konfirmasi Pesanan', '".$d1['username']."', 'Y'
				)";
		$hasil	= mysqli_query($db, $query);
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}elseif($op == "proses"){
		$id		= $_GET['id'];
		$query = "UPDATE `tb_transaksi` SET `status` = 'Diproses' WHERE `idtransaksi` = '".$id."'";
		$hasil = mysqli_query($db, $query);
		
		$q1 = "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$id."'";
		$h1 = mysqli_query($db, $q1);
		$d1 = mysqli_fetch_array($h1);
		$query	= "INSERT INTO `tb_transaksitracking` (
					`idtransaksi`,
					`tgl`,  
					`status`,
					`username`, 
					`notif`
				) VALUES (
					'".$id."', '".$xtgl."', 'Diproses', '".$d1['username']."', 'Y'
				)";
		$hasil	= mysqli_query($db, $query);
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}elseif($op == "selesai"){
		$id		= $_GET['id'];
		$query = "UPDATE `tb_transaksi` SET `status` = 'Pesanan Selesai' WHERE `idtransaksi` = '".$id."'";
		$hasil = mysqli_query($db, $query);
		
		$q1 = "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$id."'";
		$h1 = mysqli_query($db, $q1);
		$d1 = mysqli_fetch_array($h1);
		$query	= "INSERT INTO `tb_transaksitracking` (
					`idtransaksi`,
					`tgl`,  
					`status`,
					`username`, 
					`notif`
				) VALUES (
					'".$id."', '".$xtgl."', 'Pesanan Selesai', '".$d1['username']."', 'Y'
				)";
		$hasil	= mysqli_query($db, $query);
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}
}
include "header.php";
$xpage	="dtransaksi";
?>
<div class="row">
	<div class="col-lg-8">
		<h1 class="mt-4">Data Transaksi</h1><hr/>
		<?php
		if(isset($_GET['op'])){
			$op = $_GET['op'];
			if($op=="detail"){
				$id		= $_GET['id'];
				$query	= "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$id."'";
				$hasil	= mysqli_query($db, $query);
				$data	= mysqli_fetch_array($hasil);
				$query2	= "SELECT * FROM `tb_login` WHERE `username` = '".$data['username']."'";
				$hasil2	= mysqli_query($db, $query2);
				$data2	= mysqli_fetch_array($hasil2);
				?><h3>Transaksi #<?php echo $id;?></h3><hr/>
					Nama Penerima<br/>
					<?php echo "<b>".$data['namapenerima']."</b>";?><br/><br/>
					Alamat<br/>
					<?php echo "<b>".$data['alamatpenerima']."</b>";?><br/><br/>
					No. Telp<br/>
					<?php echo "<b>".$data['notelppenerima']."</b><br/><br/>";
					$query3	= "SELECT * FROM `tb_transaksidetail` WHERE `idtransaksi` = '".$id."'";
					$hasil3 = mysqli_query($db, $query3);
					?>
					<b>Detail Pemesanan</b><br/>
					<table class="table table-striped" width="100%" style="border:1px solid #000;font-size:8pt;">
						<thead style="background:#444444;color:#fff;">
							<tr>
								<th style="border:1px solid #000;">Produk</th>
								<th style="border:1px solid #000;">Harga @</th>
								<th style="border:1px solid #000;">Qty</th>
								<th style="border:1px solid #000;">Sub Total</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$tot	= 0;				
						while($data3 = mysqli_fetch_array($hasil3)){
							$query4	= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$data3['idproduk']."'";
							$hasil4	= mysqli_query($db, $query4);
							$data4	= mysqli_fetch_array($hasil4);
							echo "<tr>
								<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data4['nama']."</b><br/>Keterangan Order : <b>".str_replace("\r\n", "<br/>", $data3['keteranganorder'])."</b>";
								if(file_exists("img/desain/".$data3['idtransaksidetail'].".jpg")){
									echo "<br/>Desain:<br/><a href=\"img/desain/".$data3['idtransaksidetail'].".jpg\" target=\"_blank\"><img src=\"img/desain/".$data3['idtransaksidetail'].".jpg\" width=\"100px\">";
								}
								echo "</td>
								<td valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data3['harga'],0,",",".").",-</b>";
								if($data3['plusdesain'] > 0){
									echo "<br/>+ Jasa Desain <b>".number_format($data3['plusdesain'],0,",",".").",-</b>";
								}
								if($data3['pluscutpersegi'] > 0){
									echo "<br/>+ Jasa Cutting Persegi <b>".number_format($data3['pluscutpersegi'],0,",",".").",-</b>";
								}
								if($data3['pluscutlingkaran'] > 0){
									echo "<br/>+ Jasa Cutting Lingkaran <b>".number_format($data3['pluscutlingkaran'],0,",",".").",-</b>";
								}
								if($data3['pluscutdetail'] > 0){
									echo "<br/>+ Jasa Cutting Detail <b>".number_format($data3['pluscutdetail'],0,",",".").",-</b>";
								}
								echo "</td>
								<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data3['qty']."</b></td>
								<td valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data3['subtotal'],0,",",".").",-</b></td>
							</tr>";
						}
						if($data['ongkir'] > 0){
							echo "<tr>
								<td colspan=\"3\" valign=\"top\" align=\"center\" style=\"border:1px solid #000;\"><b>Ongkir</b></td>
								<td colspan=\"1\" valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data['ongkir'],0,",",".").",-</b></td>
							</tr>";
						}
						echo "<tr>
							<td colspan=\"3\" valign=\"top\" align=\"center\" style=\"border:1px solid #000;\"><b>Total</b></td>
							<td colspan=\"1\" valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data['total'],0,",",".").",-</b></td>
						</tr>";
						?>
						</tbody>
					</table><hr/>
					<b>Tracking Pemesanan</b><br/>
					<table class="table table-striped" width="100%" style="border:1px solid #000;font-size:8pt;">
						<thead style="background:#444444;color:#fff;">
							<tr>
								<th style="border:1px solid #000;">Tanggal</th>
								<th style="border:1px solid #000;">Status</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$hasil3	= mysqli_query($db, "SELECT * FROM `tb_transaksitracking` WHERE `idtransaksi` = '".$id."'");		
						while($data3 = mysqli_fetch_array($hasil3)){
							echo "<tr>
								<td valign=\"top\" style=\"border:1px solid #000;\">".TanggalIndo($data3['tgl'])."</td>
								<td valign=\"top\" style=\"border:1px solid #000;\">".$data3['status']."</td>
							</tr>";
						}
						?>
						</tbody>
					</table>
					<center><a href="<?php echo basename(__FILE__, '.php'); ?>" class="btn btn-secondary">Kembali</a></center><br/><hr/><br/>
				<?php
			}elseif($op=="cancel1"){
				$id		= $_GET['id'];
				$query	= "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$id."'";
				$hasil	= mysqli_query($db, $query);
				$data	= mysqli_fetch_array($hasil);
				$query2	= "SELECT * FROM `tb_login` WHERE `username` = '".$data['username']."'";
				$hasil2	= mysqli_query($db, $query2);
				$data2	= mysqli_fetch_array($hasil2);
				?><h3>Pembatalan Transaksi #<?php echo $id;?></h3><hr/>
				Nama Penerima<br/>
				<?php echo "<b>".$data['namapenerima']."</b>";?><br/><br/>
				Alamat<br/>
				<?php echo "<b>".$data['alamatpenerima']."</b>";?><br/><br/>
				No. Telp<br/>
				<?php echo "<b>".$data['notelppenerima']."</b><br/><br/>";
				$query3	= "SELECT * FROM `tb_transaksidetail` WHERE `idtransaksi` = '".$id."'";
				$hasil3 = mysqli_query($db, $query3);
				?>
				<b>Detail Pemesanan</b><br/>
				<table class="table table-striped" width="100%" style="border:1px solid #000;font-size:8pt;">
					<thead style="background:#444444;color:#fff;">
						<tr>
							<th style="border:1px solid #000;">Produk</th>
							<th style="border:1px solid #000;">Harga @</th>
							<th style="border:1px solid #000;">Qty</th>
							<th style="border:1px solid #000;">Sub Total</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$tot	= 0;				
					while($data3 = mysqli_fetch_array($hasil3)){
						$query4	= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$data3['idproduk']."'";
						$hasil4	= mysqli_query($db, $query4);
						$data4	= mysqli_fetch_array($hasil4);
						echo "<tr>
							<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data4['nama']."</b><br/>Keterangan Order : <b>".str_replace("\r\n", "<br/>", $data3['keteranganorder'])."</b>";
							if(file_exists("img/desain/".$data3['idtransaksidetail'].".jpg")){
								echo "<br/>Desain:<br/><a href=\"img/desain/".$data3['idtransaksidetail'].".jpg\" target=\"_blank\"><img src=\"img/desain/".$data3['idtransaksidetail'].".jpg\" width=\"100px\">";
							}
							echo "</td>
							<td valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data3['harga'],0,",",".").",-</b>";
							if($data3['plusdesain'] > 0){
								echo "<br/>+ Jasa Desain <b>".number_format($data3['plusdesain'],0,",",".").",-</b>";
							}
							if($data3['pluscutpersegi'] > 0){
								echo "<br/>+ Jasa Cutting Persegi <b>".number_format($data3['pluscutpersegi'],0,",",".").",-</b>";
							}
							if($data3['pluscutlingkaran'] > 0){
								echo "<br/>+ Jasa Cutting Lingkaran <b>".number_format($data3['pluscutlingkaran'],0,",",".").",-</b>";
							}
							if($data3['pluscutdetail'] > 0){
								echo "<br/>+ Jasa Cutting Detail <b>".number_format($data3['pluscutdetail'],0,",",".").",-</b>";
							}
							echo "</td>
							<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data3['qty']."</b></td>
							<td valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data3['subtotal'],0,",",".").",-</b></td>
						</tr>";
					}
					if($data['ongkir'] > 0){
						echo "<tr>
							<td colspan=\"3\" valign=\"top\" align=\"center\" style=\"border:1px solid #000;\"><b>Ongkir</b></td>
							<td colspan=\"1\" valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data['ongkir'],0,",",".").",-</b></td>
						</tr>";
					}
					echo "<tr>
						<td colspan=\"3\" valign=\"top\" align=\"center\" style=\"border:1px solid #000;\"><b>Total</b></td>
						<td colspan=\"1\" valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data['total'],0,",",".").",-</b></td>
					</tr>";
					?>
					</tbody>
				</table><hr/>
				<b>Tracking Pemesanan</b><br/>
				<table class="table table-striped" width="100%" style="border:1px solid #000;font-size:8pt;">
					<thead style="background:#444444;color:#fff;">
						<tr>
							<th style="border:1px solid #000;">Tanggal</th>
							<th style="border:1px solid #000;">Status</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$hasil3	= mysqli_query($db, "SELECT * FROM `tb_transaksitracking` WHERE `idtransaksi` = '".$id."'");		
					while($data3 = mysqli_fetch_array($hasil3)){
						echo "<tr>
							<td valign=\"top\" style=\"border:1px solid #000;\">".TanggalIndo($data3['tgl'])."</td>
							<td valign=\"top\" style=\"border:1px solid #000;\">".$data3['status']."</td>
						</tr>";
					}
					?>
					</tbody>
				</table>
				<form method="post" action="<?php echo basename(__FILE__, '.php');?>?op=cancel2&id=<?php echo $id;?>" autocomplete="off">
					<label>Keterangan Pembatalan</label><br/>
					<input type="text" name="a" class="form-control" placeholder="Keterangan Pembatalan" maxlength="120" style="width:100%" required/><br/>
					<input type="submit" value="PROSES BATAL" class="btn btn-secondary" style="width:100%"/>
				</form>
				<br/><hr/><br/><br/>
				<?php
			}
		}
		if($_SESSION['level'] == "Konsumen"){
			$query = "SELECT * FROM `tb_transaksi` WHERE `username` = '".$_SESSION['username']."' ORDER BY `idtransaksi` DESC";
		}elseif($_SESSION['level'] != "Konsumen"){
			$query = "SELECT * FROM `tb_transaksi` ORDER BY `idtransaksi` DESC";
		}
		$hasil = mysqli_query($db, $query);
		if(mysqli_num_rows($hasil) < 1){
			echo "<center><h3>TIDAK ADA DATA</h3></center>";
		}elseif(mysqli_num_rows($hasil) >= 1){
			?>
			<table id="myTable1" class="table table-striped" width="100%" style="border:1px solid #000;font-size:8pt;">
				<thead style="background:#444444;color:#fff;">
					<tr>
						<th style="border:1px solid #000;" width="10px">ID</th>
						<th style="border:1px solid #000;" width="100px">Tanggal</th>
						<th style="border:1px solid #000;" width="100px">Total</th>
						<th style="border:1px solid #000;">Status</th>
						<th style="border:1px solid #000;" width="100px">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
				while($data = mysqli_fetch_array($hasil)){
					echo "<tr>
						<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data['idtransaksi']."</b></td>
						<td valign=\"top\" style=\"border:1px solid #000;\">Order :<br/><b>".TanggalIndo($data['tglorder'])."</b>";
						if($data['tgltempo'] != ""){
							echo "<hr/>Jatuh Tempo :<br/><b>".TanggalIndo($data['tgltempo'])."</b>";
						}
						echo "</td>
						<td valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data['total'],0,",",".").",-</b>
						</td>
						<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data['status']."</b>";
						if($data['status'] == "Pesanan Masuk"){
							echo "<br/>Kami akan memeriksa pemesanan anda. Silahkan tunggu konfirmasi pemesanan dari kami.";
						}elseif($data['status'] == "Dibatalkan"){
							echo "<hr/>Keterangan Batal :<br/><b>".$data['keterangan']."</b>";
						}elseif($data['status'] == "Konfirmasi Pesanan"){
							echo "";
						}elseif($data['status'] == "Konfirmasi Bayar"){
							echo "<hr/>Kami sedang memverifikasi pesanan anda. Silahkan tunggu konfirmasi selanjutnya dari kami.";
						}elseif($data['status'] == "Diproses"){
							echo "<hr/>Kami sedang memproses pesanan anda. Silahkan tunggu konfirmasi selanjutnya dari kami.";
						}
						echo "</td>
						<td align=\"center\" valign=\"top\" style=\"border:1px solid #000;\">
							<b>
							<a href=\"".basename(__FILE__, '.php')."?op=detail&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Detail</a>";
							if($_SESSION['level'] == "Konsumen"){
								if($data['status'] == "Konfirmasi Pesanan"){
									echo "<hr/><a href=\"payment/examples/snap/checkout-process-simple-version.php?order_id=".$data['idtransaksi']."\" target=\"_blank\" style=\"color:#3892d6;\">Bayar Sekarang</a>";
								}
							}elseif($_SESSION['level'] != "Konsumen"){
								if($data['status'] == "Pesanan Masuk"){
									echo "<hr/><a href=\"".basename(__FILE__, '.php')."?op=konfirmpesan&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Konfirmasi Pesanan</a>
									<hr/><a href=\"".basename(__FILE__, '.php')."?op=cancel1&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Dibatalkan</a>";
								}elseif($data['status'] == "Konfirmasi Pesanan"){
									echo "<hr/><a href=\"".basename(__FILE__, '.php')."?op=cancel1&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Dibatalkan</a>";
								}elseif($data['status'] == "Konfirmasi Bayar"){
									echo "<hr/><a href=\"".basename(__FILE__, '.php')."?op=proses&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Diproses</a>";
									echo "<hr/><a href=\"".basename(__FILE__, '.php')."?op=cancel1&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Dibatalkan</a>";
								}elseif($data['status'] == "Diproses"){
									echo "<hr/><a href=\"".basename(__FILE__, '.php')."?op=selesai&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Selesai</a>";
									echo "<hr/><a href=\"".basename(__FILE__, '.php')."?op=cancel1&id=".$data['idtransaksi']."\" style=\"color:#3892d6;\">Dibatalkan</a>";
								}
							}
							echo "</b>
						</td>
					</tr>";
				}
				?>
				</tbody>
			</table>
		<?php
		}
		?>
	</div>
	<?php include "sidemenu.php"; ?>
</div>
<?php
include "footer.php";
?>