<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include "config.php";
if(isset($_GET['op'])){
	$op	= $_GET['op'];
	if($op == "save"){
		$a		= $_POST['a'];
		$b		= $_POST['b'];
		$c		= $_POST['c'];
		$d		= $_POST['d'];
		$e		= $_POST['e'];
		$f		= $_POST['f'];
		$g		= $_POST['g'];
		$h		= $_POST['h'];
		$i		= $_POST['i'];
		$ii		= $_FILES['img']['name'];
		if($ii == ""){
			echo "<script language='JavaScript'>alert('Tidak Ada Gambar Dipilih'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif($ii != ""){
			$query		= "INSERT INTO `tb_produk` (
							`idproduk`,  
							`nama`,  
							`keterangan`, 
							`satuan`, 
							`harga`, 
							`plusdesain`, 
							`pluscutpersegi`, 
							`pluscutlingkaran`, 
							`pluscutdetail`
						) VALUES (
							'".$a."', '".$b."', '".$c."', '".$d."', '".$e."', '".$f."', '".$g."', '".$h."', '".$i."'
						)";
			$hasil		= mysqli_query($db, $query);
			
			$imgname	= $a.".jpg";
			$file		= 'img';
			$dir		= 'img/produk/';
			$width		= 600;
			$height		= 600;
			UploadGambar($imgname,$file,$dir,$width,$height);
			if($hasil){
				echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
			}elseif(!$hasil){
				echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
			}
		}
	}elseif($op == "update"){
		$a		= $_POST['a'];
		$b		= $_POST['b'];
		$c		= $_POST['c'];
		$d		= $_POST['d'];
		$e		= $_POST['e'];
		$f		= $_POST['f'];
		$g		= $_POST['g'];
		$h		= $_POST['h'];
		$i		= $_POST['i'];
		$ii		= $_FILES['img']['name'];
		
		$query = "UPDATE `tb_produk` SET `nama` = '".$b."', `keterangan` = '".$c."', `satuan` = '".$d."', `harga` = '".$e."', `plusdesain` = '".$f."', `pluscutpersegi` = '".$g."', `pluscutlingkaran` = '".$h."', `pluscutdetail` = '".$i."' WHERE `idproduk` = '".$a."'";
		$hasil = mysqli_query($db, $query);
		
		if($ii != ""){
			$imgname	= $a.".jpg";
			$file		= 'img';
			$dir		= 'img/produk/';
			unlink($dir.$imgname);
			$width	= 600;
			$height	= 600;
			UploadGambar($imgname,$file,$dir,$width,$height);
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}elseif($op == "delete"){
		$id		= $_GET['id'];
		$query	= "DELETE FROM `tb_produk` WHERE `idproduk` = '".$id."'";
		$hasil	= mysqli_query($db, $query);
		unlink("img/produk/".$_GET['id'].".jpg");
		if($hasil){
			echo "<script language='JavaScript'>alert('Berhasil'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}elseif(!$hasil){
			echo "<script language='JavaScript'>alert('Gagal'); window.location = '".basename(__FILE__, '.php')."';</script>";
		}
	}
}
include "header.php";
$xpage	="mproduk";
?>
<div class="row">
	<div class="col-lg-8">
		<h1 class="mt-4">Kelola Data Produk</h1><hr/>
		<?php
		if(isset($_GET['op'])){
			$op = $_GET['op'];
			if($op=="tambah"){
				$r		= mysqli_query($db, "SELECT * FROM `tb_produk`");
				if(mysqli_num_rows($r) == 0){
					$idproduk	= "PRD0001";
				}elseif(mysqli_num_rows($r) >= 1){
					$h			= mysqli_query($db, "SELECT * FROM `tb_produk` ORDER BY `idproduk` DESC limit 1");
					$d			= mysqli_fetch_array($h);
					$idprodukx	= $d['idproduk'];
					$idproduky	= explode("PRD",$idprodukx);
					$idproduk	= "PRD".sprintf('%04d', $idproduky[1]+1);
				}
				?>
				<h2>Tambah Data Produk</h2>
				<form method="post" action="<?php echo basename(__FILE__, '.php');?>?op=save" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="a" value="<?php echo $idproduk; ?>" />
					<label>ID Produk</label><br/>
					<input type="text" value="<?php echo $idproduk; ?>" class="form-control" style="width:100%" disabled /><br/>
					<label>Nama Produk</label><br/>
					<input type="text" name="b" class="form-control" placeholder="Nama Produk" maxlength="72" style="width:100%" required /><br/>
					<label>Keterangan Produk</label><br/>
					<textarea name="c" class="form-control" placeholder="Keterangan Produk" style="width:100%" required /></textarea><br/>
					<label>Satuan</label><br/>
					<input type="text" name="d" class="form-control" placeholder="Satuan" maxlength="72" style="width:100%" required /><br/>
					<label>Harga /satuan</label><br/>
					<input type="text" name="e" class="form-control" placeholder="Harga /satuan" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)" required /><br/>
					<label>Jasa Desain [Optional]</label><br/>
					<input type="text" name="f" class="form-control" placeholder="Jasa Desain" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Cutting Persegi [Optional]</label><br/>
					<input type="text" name="g" class="form-control" placeholder="Cutting Persegi" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Cutting Lingkaran [Optional]</label><br/>
					<input type="text" name="h" class="form-control" placeholder="Cutting Lingkaran" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Cutting Detail (Die Cut) [Optional]</label><br/>
					<input type="text" name="i" class="form-control" placeholder="Cutting Cutting Detail (Die Cut)" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Gambar Produk</label><br/>
					<input type="file" accept="image/JPEG" name="img"> <font color="RED">(600 x 600px)</font><br/>
					<br/>
					<input type="submit" value="SIMPAN" class="btn btn-secondary" style="width:100%"/>
				</form>
				<br/><hr/><br/><br/>
				<?php
			}elseif($op=="edit"){
				$id		= $_GET['id'];
				$query	= "SELECT * FROM `tb_produk` WHERE `idproduk`='".$id."'";
				$hasil	= mysqli_query($db, $query);
				$data	= mysqli_fetch_array($hasil);
				?>
				<h2>Edit Data Produk</h2>
				<form method="post" action="<?php echo basename(__FILE__, '.php');?>?op=update" enctype="multipart/form-data">
					<input type="hidden" name="a" value="<?php echo $data['idproduk']; ?>"/>
					<label>ID Produk</label><br/>
					<input type="text" value="<?php echo $data['idproduk']; ?>" class="form-control" style="width:100%" disabled /><br/>
					<label>Nama Produk</label><br/>
					<input type="text" name="b" class="form-control" placeholder="Nama Produk" value="<?php echo $data['nama']; ?>" maxlength="72" style="width:100%" required /><br/>
					<label>Keterangan Produk</label><br/>
					<textarea name="c" class="form-control" placeholder="Keterangan Produk" style="width:100%" required /><?php echo $data['keterangan']; ?></textarea><br/>
					<label>Satuan</label><br/>
					<input type="text" name="d" class="form-control" placeholder="Satuan" value="<?php echo $data['satuan']; ?>" maxlength="72" style="width:100%" required /><br/>
					<label>Harga /satuan</label><br/>
					<input type="text" name="e" class="form-control" placeholder="Harga /satuan" value="<?php echo $data['harga']; ?>" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)" required /><br/>
					<label>Jasa Desain [Optional]</label><br/>
					<input type="text" name="f" class="form-control" placeholder="Jasa Desain" value="<?php echo $data['plusdesain']; ?>" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Cutting Persegi [Optional]</label><br/>
					<input type="text" name="g" class="form-control" placeholder="Cutting Persegi" value="<?php echo $data['pluscutpersegi']; ?>" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Cutting Lingkaran [Optional]</label><br/>
					<input type="text" name="h" class="form-control" placeholder="Cutting Lingkaran" value="<?php echo $data['pluscutlingkaran']; ?>" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Cutting Detail (Die Cut) [Optional]</label><br/>
					<input type="text" name="i" class="form-control" placeholder="Cutting Cutting Detail (Die Cut)" value="<?php echo $data['pluscutdetail']; ?>" maxlength="12" style="width:100%" onkeypress="return isNumberKey(event)"/><br/>
					<label>Gambar Produk</label><br/>
					<input type="file" accept="image/JPEG" name="img"> <font color="RED">(600 x 600px)</font><br/>
					<br/>
					<input type="submit" value="UBAH" class="btn btn-secondary" style="width:100%"/>
				</form>
				<br/><hr/><br/><br/>
				<?php
			}
		}
		?>
		<b style="font-size:16pt;">Data Produk</b> <a href="<?php echo basename(__FILE__, '.php');?>?op=tambah" style="text-decoration:none;font-size:16pt;float:right;">Tambah Data Produk</a><br/><br/>
		<table id="myTable" class="table table-striped" style="border:1px solid #000;">
			<thead style="background:#444444;color:#fff;">
				<tr>
					<th style="border:1px solid #000;">Produk</th>
					<th style="border:1px solid #000;">Keterangan</th>
					<th style="border:1px solid #000;">Harga</th>
					<th style="border:1px solid #000;">Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$query = "SELECT * FROM `tb_produk`";
			$hasil = mysqli_query($db, $query);
			while ($data = mysqli_fetch_array($hasil)){
				echo "<tr>
					<td valign=\"top\" style=\"border:1px solid #000;\">".$data['nama']."<br/><img src=\"img/produk/".$data['idproduk'].".jpg\" width=\"150\"></td>
					<td valign=\"top\" style=\"border:1px solid #000;\">".str_replace("\r\n", "<br/>", $data['keterangan'])."</td>
					<td valign=\"top\" style=\"border:1px solid #000;\">".number_format($data['harga'],0,",",".").",- /".$data['satuan']."</td>
					<td valign=\"top\" align=\"center\" width=\"110px\" style=\"border:1px solid #000;\">
						<b>
						<a href=\"".basename(__FILE__, '.php')."?op=edit&id=".$data['idproduk']."\" style=\"color:#3892d6;\">Edit</a>
						<br/>
						<a href=\"".basename(__FILE__, '.php')."?op=delete&id=".$data['idproduk']."\" style=\"color:#cd1026;\" onclick=\"return konfirmasi()\">Delete</a>
						</b>
					</td>
				</tr>";
			}
			?>
			</tbody>
		</table>
	</div>
	<?php include "sidemenu.php"; ?>
</div>
<?php
include "footer.php";
?>