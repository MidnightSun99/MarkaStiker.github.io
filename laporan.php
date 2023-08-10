<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include "config.php";
if(isset($_GET['opx'])){
	$opx	= $_GET['opx'];
	if($opx == "cetaktransaksi"){
		?>
		<!DOCTYPE html>
		<html>
		<head>
		<style>
			@page {
				size: A4;
				margin: 0;
			}
			@media print {
				html, body {
					width: 210mm;
					height: 297mm;
				}
				page-break-after:always;
			}
		</style>
		<script type="text/javascript" src="Chart.js"></script>
		</head>
		<body>
			<?php
			$a	= $_POST['a'];
			$b	= $_POST['b'];
			?>
			<center><b style="font-size:22pt;"><?php echo $xjudul1; ?></b><br/><?php echo $xalamat; ?><hr/>
			<b style="font-size:14pt;">Data Laporan Transaksi<br/>Periode Tanggal <?php echo TanggalIndo($a)." s/d ".TanggalIndo($b); ?></b></center>
			<table cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #000;">
				<thead>
					<tr>
						<th align="center" valign="middle" style="border:1px solid #000;">Invoice</th>
						<th align="center" valign="middle" style="border:1px solid #000;">Konsumen</th>
						<th align="center" valign="middle" style="border:1px solid #000;">Total Pesanan</th>
						<th align="center" valign="middle" style="border:1px solid #000;">Ongkir</th>
						<th align="center" valign="middle" style="border:1px solid #000;">Total</th>
						<th align="center" valign="middle" style="border:1px solid #000;">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$aru1	= array();
					$aru2	= array();
					$aru3	= array();
					$aru4	= array();
					$query	= "SELECT * FROM `tb_transaksi` WHERE STR_TO_DATE(`tglorder`, '%d-%m-%Y') BETWEEN STR_TO_DATE('".$a."', '%d-%m-%Y') AND STR_TO_DATE('".$b."', '%d-%m-%Y')";
					$hasil	= mysqli_query($db, $query);
					while($data = mysqli_fetch_array($hasil)){
						$aru1[] = $data['tglorder'];
						$aru2[]	= $data['total'];
						$aru3[]	= "rgba(255, 99, 132, 0.2)";
						$aru4[]	= "rgba(255,99,132,1)";
						$q = "SELECT * FROM `tb_login` WHERE `username` = '".$data['username']."'";
						$h = mysqli_query($db, $q);
						$d = mysqli_fetch_array($h);
						echo "<tr>
							<td align=\"center\" valign=\"top\" style=\"border:1px solid #000;\">".$data['idtransaksi']."<hr/>Order : ".TanggalIndo($data['tglorder']);
							if($data['tgltempo'] != ""){
								echo "<br/>Jatuh Tempo: ".TanggalIndo($data['tgltempo']);
							}
							echo "</td>
							<td align=\"center\" valign=\"top\" style=\"border:1px solid #000;\">Username : ".$d['username']."<br/>Nama : ".$data['namapenerima']."<br/>Alamat : ".$data['alamatpenerima']."<br/>No. Telp : ".$data['notelppenerima']."</td>
							<td align=\"center\" valign=\"top\" style=\"border:1px solid #000;\"><b>Rp. ".number_format($data['totalbelanja'],0,",",".").",-</b></td>
							<td align=\"center\" valign=\"top\" style=\"border:1px solid #000;\"><b>Rp. ".number_format($data['ongkir'],0,",",".").",-</b></td>
							<td align=\"center\" valign=\"top\" style=\"border:1px solid #000;\"><b>Rp. ".number_format($data['total'],0,",",".").",-</b></td>
							<td align=\"center\" valign=\"top\" style=\"border:1px solid #000;\">".$data['status']."</td>
						</tr>";
					}
					?>
				</tbody>
			</table>
			<?php
			if(isset($_POST['grafik'])){
				?>
				<hr/><div style="width: 900px;margin: 0px auto;">
					<canvas id="myChart"></canvas>
				</div>
				
				<script>
					var ctx = document.getElementById("myChart");
					var myChart = new Chart(ctx, {
						type: 'bar',
						data: {
							labels: <?php echo json_encode($aru1); ?>,
							datasets: [{
								label: 'Total Transaksi',
								data: <?php echo json_encode($aru2); ?>,
								backgroundColor: <?php echo json_encode($aru3); ?>,
								borderColor: <?php echo json_encode($aru4); ?>,
								borderWidth: 2
							}]
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero:true
									}
								}]
							}
						}
					});
				</script>
			<?php
			}
			echo "<br/><br/><table align=\"center\" width=\"100%\">
				<tr><td></td><td align=\"center\" width=\"30%\">".$xkota.", ".TanggalIndo($xtgl)."<br/><br/><br/><br/><br/>( ________________ )<br/></td></tr>
			</table>
		<script language='JavaScript'>window.onload = window.print;</script>";
		?>
		</body>
		</html>
		<?php
	}
}if(!isset($_GET['opx'])){
	include "header.php";
	$xpage	="laporan";
	?>
	<div class="row">
		<div class="col-lg-8">
			<?php
			if(isset($_GET['op'])){
				$op = $_GET['op'];
				if($op=="transaksi"){
					?>
					<h1 class="mt-4">Laporan Transaksi</h1><hr/>
					<h2>Pilih Periode Transaksi</h2>
					<form method="post" action="<?php echo basename(__FILE__, '.php');?>?opx=cetaktransaksi" target="_blank" autocomplete="off">
						<label>Dari Tanggal</label><br/>
						<input type="text" name="a" class="form-control datepicker1" placeholder="DD-MM-YYYY" maxlength="10" style="width:100%" required/><br/>
						<label>Sampai Tanggal</label><br/>
						<input type="text" name="b" class="form-control datepicker2" class="form-control datepicker2" placeholder="DD-MM-YYYY" maxlength="10" style="width:100%" required/><br/>
						<input type="checkbox" id="grafik" name="grafik" value="Y">
						<label for="grafik"> Tampilkan Grafik</label>
						<br/><br/>
						<input type="submit" value="LIHAT LAPORAN" class="btn btn-secondary" style="width:100%"/>
					</form>
					<?php
				}
			}
			?>
		</div>
		<?php include "sidemenu.php"; ?>
	</div>
	<?php
	include "footer.php";
}
?>