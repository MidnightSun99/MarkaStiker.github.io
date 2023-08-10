<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include "config.php";
if(isset($_GET['op'])){
	$op	= $_GET['op'];
	if($op == "delete"){
		$id		= $_GET['id'];
		$query	= "DELETE FROM `tb_transaksidetail` WHERE `idtransaksidetail` = '".$id."'";
		$hasil	= mysqli_query($db, $query);
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}elseif($op == "checkout2"){
		$id		= date("dmYHis");
		$a		= $_POST['a'];
		$b		= $_POST['b'];
		$c		= $_POST['c'];
		$d		= $_POST['d'];
		$e		= $_POST['e'];
		$f		= $_POST['f'];
		$g		= $_POST['g'];
		$h		= $_POST['h'];
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=433&destination=".$h."&weight=1&courier=jne",
		  CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
			"key: b1f974a972a4b5826bc86e8a368f563b"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$dataongkir= json_decode($response, true);
		$ong	= $dataongkir['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
		$q1 = "SELECT * FROM `tb_ongkir` WHERE `id` = '".$h."'";
		$h1 = mysqli_query($db, $q1);
		$d1 = mysqli_fetch_array($h1);
		$query	= "INSERT INTO `tb_transaksi` (
					`idtransaksi`,  
					`tglorder`,  
					`tgltempo`,  
					`username`, 
					`totalbelanja`, 
					`namapenerima`, 
					`alamatpenerima`, 
					`kotapenerima`, 
					`notelppenerima`, 
					`emailpenerima`, 
					`ongkir`, 
					`total`, 
					`keterangan`, 
					`status`
				) VALUES (
					'".$id."', '".$xtgl."', '".$xtgltemp."', '".$a."', '".$b."', '".$c."', '".$d."', '".$d1['tujuan']."', '".$e."', '".$f."', '".$ong."', '".($b+$ong)."', '".$g."', 'Pesanan Masuk'
				)";
		$hasil	= mysqli_query($db, $query);
		$query2	= "SELECT * FROM `tb_transaksidetail` WHERE `idtransaksi` = '-' AND `status` = 'Keranjang Belanja' AND `username` = '".$a."'";
		$hasil2	= mysqli_query($db, $query2);
		while ($data2 = mysqli_fetch_array($hasil2)){
			$query3	= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$data2['idproduk']."'";
			$hasil3	= mysqli_query($db, $query3);
			$data3	= mysqli_fetch_array($hasil3);
			$query	= "UPDATE `tb_transaksidetail` SET `idtransaksi` = '".$id."', `status` = 'Transaksi' WHERE `idtransaksidetail` = '".$data2['idtransaksidetail']."'";
			$hasil	= mysqli_query($db, $query);
		}
		$q1 = "SELECT * FROM `tb_login` WHERE `level` = 'Pemilik'";
		$h1 = mysqli_query($db, $q1);
		$d1 = mysqli_fetch_array($h1);
		$query	= "INSERT INTO `tb_transaksitracking` (
					`idtransaksi`,
					`tgl`,  
					`status`,
					`username`, 
					`notif`
				) VALUES (
					'".$id."', '".$xtgl."', 'Pesanan Masuk', '".$d1['username']."', 'Y'
				)";
		$hasil	= mysqli_query($db, $query);
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = 'dtransaksi';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}
}
include "header.php";
$xpage	="keranjangbelanja";
?>
<div class="row">
	<div class="col-lg-8">
		<?php
		if(isset($_GET['op'])){
			$op = $_GET['op'];
			if($op=="checkout1"){
				?>
				<h1 class="mt-4">Selesaikan Pemesanan</h1><hr/>
				<form method="post" action="<?php echo basename(__FILE__, '.php');?>?op=checkout2" autocomplete="off">
					<input type="hidden" name="a" value="<?php echo $_GET['a']; ?>"/>
					<input type="hidden" name="b" value="<?php echo $_GET['b']; ?>"/>
					<label>Nama Penerima</label><br/>
					<input type="text" name="c" class="form-control" placeholder="Nama" maxlength="72" style="width:100%" required/><br/>
					<label>Alamat Lengkap Penerima (Jalan, Kelurahan, RT, RW, Kecamatan & Kode Pos)</label><br/>
					<input type="text" name="d" class="form-control" placeholder="Alamat" style="width:100%" required/><br/>
					<label>Kota Tujuan</label><br/>
					<select name="h" class="form-control" style="width:100%;" required>
						<option value="" disabled selected style="display:none;">Pilih Kota Tujuan</option>
						<?php
						$q1 = "SELECT * FROM `tb_ongkir`";
						$h1 = mysqli_query($db, $q1);
						while ($d1 = mysqli_fetch_array($h1)){
							echo "<option value=\"".$d1['id']."\">".$d1['tujuan']."</option>";
						}
						?>
					</select><br/>
					<label>No. Telp Penerima</label><br/>
					<input type="text" name="e" class="form-control" placeholder="No. Telp" maxlength="15" style="width:100%" required/><br/>
					<label>Email Penerima</label><br/>
					<input type="email" name="f" class="form-control" placeholder="Email Penerima" maxlength="72" style="width:100%" required/><br/>
					<label>Keterangan Tambahan</label><br/>
					<textarea name="g" class="form-control" placeholder="Keterangan Tambahan" /></textarea><br/>
					<br/>
					<input type="submit" value="SIMPAN" class="btn btn-secondary" style="width:100%"/>
				</form>
				<br/><hr/>
				<?php
			}
		}
		?>
		<h1 class="mt-4">Keranjang Belanja Anda</h1><hr/>
		<?php
		$query = "SELECT * FROM `tb_transaksidetail` WHERE `username` = '".$_SESSION['username']."' AND `status` = 'Keranjang Belanja'";
		$hasil = mysqli_query($db, $query);
		if(mysqli_num_rows($hasil) < 1){
			echo "<center><h3>TIDAK ADA DATA</h3></center>";
		}elseif(mysqli_num_rows($hasil) >= 1){
			?>
			<table class="table table-striped" width="100%" style="border:1px solid #000;font-size:8pt;">
				<thead style="background:#444444;color:#fff;">
					<tr>
						<th style="border:1px solid #000;">Produk</th>
						<th style="border:1px solid #000;">Harga @</th>
						<th style="border:1px solid #000;">Qty</th>
						<th style="border:1px solid #000;">Sub Total</th>
						<th style="border:1px solid #000;"></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$tot	= 0;
				$query3	= "SELECT * FROM `tb_login` WHERE `username` = '".$_SESSION['username']."'";
				$hasil3	= mysqli_query($db, $query3);
				$data3	= mysqli_fetch_array($hasil3);				
				while($data = mysqli_fetch_array($hasil)){
					$query2	= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$data['idproduk']."'";
					$hasil2	= mysqli_query($db, $query2);
					$data2	= mysqli_fetch_array($hasil2);
					echo "<tr>
						<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data2['nama']."</b><br/>Keterangan Order : <b>".str_replace("\r\n", "<br/>", $data['keteranganorder'])."</b>";
						if(file_exists("img/desain/".$data['idtransaksidetail'].".jpg")){
							echo "<br/>Desain:<br/><a href=\"img/desain/".$data['idtransaksidetail'].".jpg\" target=\"_blank\"><img src=\"img/desain/".$data['idtransaksidetail'].".jpg\" width=\"100px\">";
						}
						echo "</td>
						<td valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data['harga'],0,",",".").",-</b>";
						if($data['plusdesain'] > 0){
							echo "<br/>+ Jasa Desain <b>".number_format($data['plusdesain'],0,",",".").",-</b>";
						}
						if($data['pluscutpersegi'] > 0){
							echo "<br/>+ Jasa Cutting Persegi <b>".number_format($data['pluscutpersegi'],0,",",".").",-</b>";
						}
						if($data['pluscutlingkaran'] > 0){
							echo "<br/>+ Jasa Cutting Lingkaran <b>".number_format($data['pluscutlingkaran'],0,",",".").",-</b>";
						}
						if($data['pluscutdetail'] > 0){
							echo "<br/>+ Jasa Cutting Detail <b>".number_format($data['pluscutdetail'],0,",",".").",-</b>";
						}
						echo "</td>
						<td valign=\"top\" style=\"border:1px solid #000;\"><b>".$data['qty']."</b></td>
						<td valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($data['subtotal'],0,",",".").",-</b></td>
						<td valign=\"top\" style=\"border:1px solid #000;\">
							<b>
							<a href=\"".basename(__FILE__, '.php')."?op=delete&id=".$data['idtransaksidetail']."\" style=\"color:#cd1026;font-size:10pt;\" onclick=\"return konfirmasi()\">[X]</a>
							</b>
						</td>
					</tr>";
					$tot	= $tot + $data['subtotal'];
				}
				echo "<tr>
					<td colspan=\"3\" valign=\"top\" style=\"border:1px solid #000;\"><b>Total</b></td>
					<td colspan=\"2\" valign=\"top\" style=\"border:1px solid #000;\"><b>".number_format($tot,0,",",".").",-</b></td>
				</tr>";
				?>
				</tbody>
			</table>
		<center><a href="produk" class="btn btn-secondary">PESAN LAGI</a>
		<br/><hr/><a href="<?php echo basename(__FILE__, '.php')."?op=checkout1&a=".$_SESSION['username']."&b=".$tot; ?>" class="btn btn-secondary">Selesaikan Pemesanan (Checkout)</a></center>
		<?php
		}
		?>
	</div>
	<?php include "sidemenu.php"; ?>
</div>
<?php
include "footer.php";
?>