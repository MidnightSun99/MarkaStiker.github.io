<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include "config.php";
if(isset($_GET['op'])){
	$op	= $_GET['op'];
	if($op == "pesan"){
		$a		= $_POST['a'];
		$b		= $_POST['b'];
		$c		= $_POST['c'];
		$d		= $_POST['d'];
		$e		= 0;
		$f		= 0;
		$g		= 0;
		$h		= 0;
		$i		= $_FILES['img']['name'];
		$ix		= $_FILES['img']['tmp_name'];
		
		$query	= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$b."'";
		$hasil	= mysqli_query($db, $query);
		$data	= mysqli_fetch_array($hasil);
		
		if($data['plusdesain'] > 0){
			$e		= $_POST['e'];
		}
		if($data['pluscutpersegi'] > 0){
			$f		= $_POST['f'];
		}
		if($data['pluscutlingkaran'] > 0){
			$g		= $_POST['g'];
		}
		if($data['pluscutdetail'] > 0){
			$h		= $_POST['h'];
		}
		$i		= $data['harga'] * $c;
		$i		= $i + ($e * $c);
		$i		= $i + ($f * $c);
		$i		= $i + ($g * $c);
		$i		= $i + ($h * $c);
		$query	= "INSERT INTO `tb_transaksidetail` (
					`idtransaksi`,
					`username`,  
					`idproduk`,
					`qty`, 
					`keteranganorder`, 
					`harga`, 
					`plusdesain`, 
					`pluscutpersegi`, 
					`pluscutlingkaran`, 
					`pluscutdetail`, 
					`subtotal`, 
					`status`
				) VALUES (
					'-', '".$a."', '".$b."', '".$c."', '".$d."', '".$data['harga']."', '".$e."', '".$f."', '".$g."', '".$h."', '".$i."', 'Keranjang Belanja'
				)";
		$hasil	= mysqli_query($db, $query);
		$id		= mysqli_insert_id($db);
		if($i != ""){
			$new_name	= $id.".jpg";
			move_uploaded_file($ix, 'img/desain/'.$new_name);
		}
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil Masuk Keranjang Belanja'); window.location = 'keranjangbelanja';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}
}
include "header.php";
$xpage	="produk";
?>
<div class="row">
	<div class="col-lg-8">
		<?php
		if(isset($_GET['idproduk'])){
			$idproduk	= $_GET['idproduk'];
			$query		= "SELECT * FROM `tb_produk` WHERE `idproduk` = '".$idproduk."'";
			$hasil		= mysqli_query($db, $query);
			$data		= mysqli_fetch_array($hasil);
				?>
				<h1 class="mt-4">Pemesanan Produk</h2><hr/>
				<center><h3 class="mt-4"><?php echo $data['nama']; ?></h3></center>
				<table width="100%" cellpadding="5px">
					<tr>
						<td valign="top" align="center" width="100%"><img src="img/produk/<?php echo $data['idproduk'];?>.jpg" width="50%"><br/><br/>
						<?php echo "Rp. ".number_format($data['harga'],0,",",".").",- /".$data['satuan']; ?>
						<br/><p><?php echo str_replace("\r\n", "<br/>", $data['keterangan']);?></p>
						<?php
						if(isset($_SESSION[$session])){
							if($_SESSION['level'] == "Konsumen"){
								?>
								<form method="post" action="<?php echo basename(__FILE__, '.php');?>?op=pesan" autocomplete="off" enctype="multipart/form-data">
									<input type="hidden" name="a" value="<?php echo $_SESSION['username']; ?>"/>
									<input type="hidden" name="b" value="<?php echo $data['idproduk']; ?>"/><hr/>
									<table width="90%">
									<tr>
										<td align="right"><label>Jumlah</label></td>
										<td align="center"><input type="text" name="c" class="form-control" placeholder="Jumlah" maxlength="8" onkeypress="return isNumberKey(event)" required /></td>
									</tr>
									<?php
									if($data['plusdesain'] > 0){
										?>
										<tr>
											<td align="right" valign="top"><label>+ Jasa Desain (<?php echo number_format($data['plusdesain'],0,",",".").",-"; ?>)</label></td>
											<td valign="top">
												&nbsp; &nbsp;<input type="radio" id="e1" name="e" value="<?php echo $data['plusdesain']; ?>"> <label for="e1"> Ya</label>&nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" id="e2" name="e" value="0" checked> <label for="e2"> Tidak</label>
											<br/></td>
										</tr>
										<?php
									}
									if($data['pluscutpersegi'] > 0){
										?>
										<tr>
											<td align="right" valign="top"><label>+ Jasa Cutting Persegi (<?php echo number_format($data['pluscutpersegi'],0,",",".").",-"; ?>)</label></td>
											<td valign="top">
												&nbsp; &nbsp;<input type="radio" id="f1" name="f" value="<?php echo $data['pluscutpersegi']; ?>"> <label for="f1"> Ya</label>&nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" id="f2" name="f" value="0" checked> <label for="f2"> Tidak</label>
											<br/></td>
										</tr>
										<?php
									}
									if($data['pluscutlingkaran'] > 0){
										?>
										<tr>
											<td align="right" valign="top"><label>+ Jasa Cutting Lingkaran (<?php echo number_format($data['pluscutlingkaran'],0,",",".").",-"; ?>)</label></td>
											<td valign="top">
												&nbsp; &nbsp;<input type="radio" id="g1" name="g" value="<?php echo $data['pluscutlingkaran']; ?>"> <label for="g1"> Ya</label>&nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" id="g2" name="g" value="0" checked> <label for="g2"> Tidak</label>
											<br/></td>
										</tr>
										<?php
									}
									if($data['pluscutdetail'] > 0){
										?>
										<tr>
											<td align="right" valign="top"><label>+ Jasa Cutting Detail [<i>Die Cut</i>] (<?php echo number_format($data['pluscutdetail'],0,",",".").",-"; ?>)</label></td>
											<td valign="top">
												&nbsp; &nbsp;<input type="radio" id="h1" name="h" value="<?php echo $data['pluscutdetail']; ?>"> <label for="h1"> Ya</label>&nbsp; &nbsp; &nbsp; &nbsp;<input type="radio" id="h2" name="h" value="0" checked> <label for="h2"> Tidak</label>
											<br/></td>
										</tr>
										<?php
									}
									?>
									<tr>
										<td align="right" valign="top"><label>Bahan Desain (Optional) : </label></td>
										<td align="center" valign="top"><input type="file" accept="image/JPEG" name="img"><br/></td>
									</tr>
									<tr>
										<td align="right" valign="top"><label>Keterangan Tambahan</label></td>
										<td align="center" valign="top"><textarea name="d" class="form-control" placeholder="Keterangan Tambahan" required /></textarea><br/></td>
									</tr>
									</table>
									<input type="submit" value="PESAN" class="btn btn-secondary" style="width:100%"/>
								</form>
								<?php
							}
						}
						?>
						</td>
					</tr>
				</table><hr/>
			<br/><br/><hr/>
			<?php
		}
		?>
		<h1 class="mt-4">Produk</h1><hr/>
		<table width="100%" cellpadding="5px">
		<?php
		echo "<h2>Pilih Produk</h2><hr/>";
		$ii		= 0;
		$query	= "SELECT * FROM `tb_produk` ORDER BY RAND()";
		$hasil	= mysqli_query($db, $query);
		while($data = mysqli_fetch_array($hasil)){
			if($ii%2 == 0){
				echo "<tr>";
			}
			?>
			<td valign="top" align="center" width="50%">
			<a href="<?php echo basename(__FILE__, '.php');?>?idproduk=<?php echo $data['idproduk'];?>" style="color:#000;">
				<img src="img/produk/<?php echo $data['idproduk'];?>.jpg" width="60%"><br/><h3><?php echo $data['nama'];?><br/><?php
				echo "Rp. ".number_format($data['harga'],0,",",".").",- /".$data['satuan'];
				?></h3><input type="submit" value="PESAN" class="btn btn-secondary" style="width:70%"/>
			</a><hr/></td>
			<?php
			if($ii%2 == 1){
				echo "</tr>";
			}
			$ii++;
		}
		?>
		</table>
	</div>
	<?php include "sidemenu.php"; ?>
</div>
<?php
include "footer.php";
?>