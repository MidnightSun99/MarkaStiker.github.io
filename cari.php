<?php
error_reporting(E_NOTICE | E_WARNING | E_DEPRECATED);
session_start();
set_time_limit(0);
include("config.php");
if(isset($_GET['x'])){
	$x = $_GET['x'];
	if($x == "caripelanggan"){
		$searchTerm = addslashes($_POST['pelanggan']);
		$query = mysqli_query($db, "SELECT * FROM `tb_login` WHERE `nama` LIKE '%".$searchTerm."%' AND `level` = 'pelanggan'");
		while($data = mysqli_fetch_array($query)){
			echo '<span class="pilihan" onclick="pilih_pelanggan(\'('.$data['username'].') - '.$data['nama'].'\');hideStuff(\'caripelanggan\');" style=\'background-color:#CFF3FF;padding:10px;font-weight:bold;width:96%;\'>('.$data['username'].') - '.$data['nama'].'</span>';
		}
	}
}
?>