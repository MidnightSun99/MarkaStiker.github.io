<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
error_reporting(E_ALL ^ E_DEPRECATED);
date_default_timezone_set("Asia/Jakarta");
$undb	= "root";
$passdb	= "";
$hostdb	= "localhost";
$namadb	= "db_markastiker";
$db		= mysqli_connect($hostdb,$undb,$passdb);
mysqli_select_db($db, $namadb) or die ("Database Gagal");
mysqli_query($db, "SET GLOBAL time_zone = `Asia/Jakarta`");
/* --------------------------------------------------------------- */
define('_HOST_NAME', $hostdb);
define('_DATABASE_USER_NAME', $undb);
define('_DATABASE_PASSWORD', $passdb);
define('_DATABASE_NAME', $namadb);
$dbConnection = new mysqli(_HOST_NAME, _DATABASE_USER_NAME, _DATABASE_PASSWORD, _DATABASE_NAME);
if($dbConnection->connect_error){
	trigger_error('Connection Failed: '. $dbConnection->connect_error, E_USER_ERROR);
}
/* --------------------------------------------------------------- */
$xclieKey	= "SB-Mid-client-ieRtw4jHQPWwCLYf";
$xservKey	= "SB-Mid-server-ShAccMrfwV8hQuzE3hcWMhaV";
$xAPI		= "d024ed9d0ccaa53606b0c7074d7d6d5a";
$xtgl		= date("d-m-Y");
$xtgltemp	= strtotime("+3 day");
$xtgltemp	= date("d-m-Y", $xtgltemp);
$xthn		= date("Y");
$xjam		= date("H:i:s");
$xtgljam	= $xjam." ".$xtgl;
$tglsession	= date("dmY");
$tsessy		= date("HisdmY");
$tsessz		= date("mY");
$tsessx		= md5($tglsession);
$xjudul1	= "MARKASTIKER";
$xjudul2	= "MARKASTIKER";
$xfounder	= "Eksan Priyo Sukoco - 190101038";
$xalamat	= "Jl. Songgo Bumi, Dusun II, Manang, Kec. Grogol, Kabupaten Sukoharjo, Jawa Tengah 57552";
$xkota		= "Sukoharjo";
$xnotelp	= "081329079110";
$xwa		= "+6281329079110";
$xemail		= "markastiker@gmail.com";
$xbank		= "Silahkan Transfer ke Rekening Berikut, BCA 3100042036 Atas Nama Agus Setioko";
$xtentang	= "Kami melayani jasa percetakan Digital Printing, Outdoor & Indoor promotion, advertising, graphic design. Kami juga mencetak Mug, Pin, ID Card, Kartu Nama, Kaos Digital, Nota dan Brosur. Kami juga menyewakan titik baliho yang strategis. Kami pastikan anda akan menjadi Klien kami, harga bukan menjadi halangan. Melayani pengiriman LUAR KOTA";
/* --------------------------------------------------------------- */
$qa = "SELECT * FROM `tb_transaksi` WHERE `tgltempo` <> '' AND STR_TO_DATE(`tgltempo`, '%d-%m-%Y') < STR_TO_DATE('".date("d-m-Y")."', '%d-%m-%Y') AND `status`='Pesanan Masuk'";
$ha = mysqli_query($db, $qa);
while($da = mysqli_fetch_array($ha)){
	$deko	= $da['idtransaksi'];
	$query	= "UPDATE `tb_transaksidetail` SET `status` = 'Dibatalkan' WHERE `idtransaksidetail` = '".$deko."'";
	$hasil = mysqli_query($db, $query);
	$query = "DELETE FROM `tb_transaksidetail` WHERE `idtransaksi` = '".$deko."'";
	$hasil = mysqli_query($db, $query);
}
/* --------------------------------------------------------------- */
$arei1	= array();
$qa = "SELECT * FROM `tb_transaksidetail` WHERE `idtransaksi` <> '-'";
$ha = mysqli_query($db, $qa);
while($da = mysqli_fetch_array($ha)){
	$depro = $da['idproduk'];
	$qtpro = $da['qty'];
	$qa1 = "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$da['idtransaksi']."'";
	$ha1 = mysqli_query($db, $qa1);
	$da1 = mysqli_fetch_array($ha1);
	if($da1['status'] == "Pesanan Selesai"){
		if(array_key_exists($depro, $arei1)){
			$uo	= $arei1[$depro] + $qtpro;
			$arei1[$depro] = $uo;
		}if(!array_key_exists($depro, $arei1)){
			$arei1[$depro] = $qtpro;
		}
	}
}
arsort($arei1);
array_slice($arei1, 0, 5);
/* --------------------------------------------------------------- */
function acak1(){
    $ix = "";
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	for($i=0;$i<15;$i++)
	$ix.=substr($chars,rand(0,strlen($chars)),1);
    return $ix;
}
function acak2(){
    $ix = "";
	$chars = "0123456789";
	for($i=0;$i<3;$i++)
	$ix.=substr($chars,rand(0,strlen($chars)),1);
    return $ix;
}
function acak3(){
    $ix = "";
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	for($i=0;$i<5;$i++)
	$ix.=substr($chars,rand(0,strlen($chars)),1);
    return $ix;
}
function anti_injection($data){
	$filter = mysqli_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
	return $filter;
}
function TanggalIndo($date){
	$BulanIndo	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$tglx		= explode("-",$date);
 
	$result		= $tglx[0]." ".$BulanIndo[(int)$tglx[1]-1]." ".$tglx[2];		
	return($result);
}
function UploadGambar($new_name,$file,$dir,$width,$height){
   $vdir_upload = $dir;
   $vfile_upload = $vdir_upload . $_FILES[''.$file.'']["name"];
   move_uploaded_file($_FILES[''.$file.'']["tmp_name"], $dir.$_FILES[''.$file.'']["name"]);
   $im_src = imagecreatefromjpeg($vfile_upload);
   $src_width = imageSX($im_src);
   $src_height = imageSY($im_src);
   $dst_width = $width;
   $dst_height = $height;
   $im = imagecreatetruecolor($dst_width,$dst_height);
   imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
   imagejpeg($im,$vdir_upload . $new_name,100);
   imagedestroy($im_src);
   imagedestroy($im);
   $remove_small = unlink($vfile_upload);
}
/* --------------------------------------------------------------- */
$filesession	= join("",file("session"));
$pecahsession	= explode("\n", $filesession);
$session1		= rtrim($pecahsession[0]);
$session2		= rtrim($pecahsession[1]);
$pecahsession2	= explode("#",$session1);
$session12		= $pecahsession2[1];
if($session12 != $tglsession){
	$session	= acak1();
	$myfile = fopen("session", "w") or die("Unable to open file!");
	$txt = "session#".$tglsession. "\r\n";
	fwrite($myfile, $txt);
	$txt = $session;
	fwrite($myfile, $txt);
	fclose($myfile);
}if($session12 == $tglsession){
	$session = $session2;
}
$sessionenkrip = md5($tglsession.$session);
/* --------------------------------------------------------------- */
?>