<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for sample HTTP notifications:
// https://docs.midtrans.com/en/after-payment/http-notification?id=sample-of-different-payment-channels

namespace Midtrans;
include "../../config.php";
require_once dirname(__FILE__) . '/../Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = $xservKey;

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

try {
    $notif = new Notification();
}
catch (\Exception $e) {
    exit($e->getMessage());
}

$notif = $notif->getResponse();
$transaction = $notif->transaction_status;
$transaction_id = $notif->transaction_id;

$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

if($transaction == 'settlement'){
	mysqli_query($db,"UPDATE `tb_transaksi` SET `status` = 'Diproses' WHERE `idtransaksi` = '".$order_id."'");
	
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
				'".$id."', '".$xtgl."', 'Diproses', '".$d1['username']."', 'Y'
			)";
	$hasil	= mysqli_query($db, $query);
}elseif($transaction == 'pending'){
	mysqli_query($db,"UPDATE `tb_transaksi` SET `status` = 'Konfirmasi Bayar' WHERE `idtransaksi` = '".$order_id."'");
	
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
				'".$id."', '".$xtgl."', 'Konfirmasi Bayar', '".$d1['username']."', 'Y'
			)";
	$hasil	= mysqli_query($db, $query);
}elseif($transaction == 'deny'){
	mysqli_query($db,"UPDATE `tb_transaksi` SET `status` = 'Dibatalkan', `keterangan` = 'Pembayaran Ditolak' WHERE `idtransaksi` = '".$order_id."'");
	
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
				'".$id."', '".$xtgl."', 'Dibatalkan', '".$d1['username']."', 'Y'
			)";
	$hasil	= mysqli_query($db, $query);	
}elseif($transaction == 'expire'){
	mysqli_query($db,"UPDATE `tb_transaksi` SET `status` = 'Dibatalkan', `keterangan` = 'Pembayaran Expired' WHERE `idtransaksi` = '".$order_id."'");
	
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
				'".$id."', '".$xtgl."', 'Dibatalkan', '".$d1['username']."', 'Y'
			)";
	$hasil	= mysqli_query($db, $query);    
}elseif($transaction == 'cancel'){
	mysqli_query($db,"UPDATE `tb_transaksi` SET `status` = 'Dibatalkan', `keterangan` = 'Pembayaran Dibatalkan' WHERE `idtransaksi` = '".$order_id."'");
	
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
				'".$id."', '".$xtgl."', 'Dibatalkan', '".$d1['username']."', 'Y'
			)";
	$hasil	= mysqli_query($db, $query);
}

function printExampleWarningMessage() {
    if($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo 'Notification-handler are not meant to be opened via browser / GET HTTP method. It is used to handle Midtrans HTTP POST notification / webhook.';
    }
    if(strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars("Config::$serverKey = '".$xservKey."';");
        die();
    }   
}
