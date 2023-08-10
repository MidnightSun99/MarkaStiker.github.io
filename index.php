<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include "config.php";
include "header.php";
$xpage	="index";
?>
<img src="img/banner.jpg" width="100%">
<div class="row">
	<div class="col-lg-8">
		<center><h2 class="mt-4"><hr/>Selamat Datang Di<br/><?php echo $xjudul2; ?></h2>
		<h1 class="mt-4">Produk Kami</h1>
		<table width="100%" cellpadding="5px">
			<?php
			$ii		= 0;
			$query	= "SELECT * FROM `tb_produk` ORDER BY RAND() LIMIT 4";
			$hasil	= mysqli_query($db, $query);
			while($data = mysqli_fetch_array($hasil)){
				if($ii%2 == 0){
					echo "<tr>";
				}
				?>
				<td valign="top" align="center" width="50%">
				<a href="produk?idproduk=<?php echo $data['idproduk'];?>" style="color:#000;">
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
		<hr/>
		<center>
	</div>
	<?php include "sidemenu.php"; ?>
</div>
<?php
include "footer.php";
?>