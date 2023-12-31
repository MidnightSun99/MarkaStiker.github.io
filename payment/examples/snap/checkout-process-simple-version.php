<?php
// This is just for very basic implementation reference, in production, you should validate the incoming requests and implement your backend more securely.
// Please refer to this docs for snap popup:
// https://docs.midtrans.com/en/snap/integration-guide?id=integration-steps-overview

namespace Midtrans;

include "../../../config.php";
require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = $xservKey;
Config::$clientKey = $xclieKey;

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
$idtransaksi	= $_GET['order_id'];
$query			= "SELECT * FROM `tb_transaksi` WHERE `idtransaksi` = '".$idtransaksi."'";
$sql			= mysqli_query($db, $query);
$data			= mysqli_fetch_array($sql);
$nama			= $data['namapenerima'];
$alamat			= $data['alamatpenerima'];
$notelp			= $data['notelppenerima'];
$email			= $data['emailpenerima'];
$total			= $data['total'];

$transaction_details = array(
	'order_id' => $idtransaksi,
	'gross_amount' =>  $total, // no decimal allowed for creditcard
);
// Optional
$item_details = array (
    array(
        'id' => 'A1',
        'price' => $total,
        'quantity' => 1,
        'name' => "PEMBAYARAN MARKASTIKER"
    ),
  );
// Optional
$customer_details = array(
    'first_name'    => $nama,
    'last_name'     => "",
    'email'         => $email,
    'phone'         => $notelp,
    'billing_address'  => $alamat,
    'shipping_address' => $alamat
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}


function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars("Config::$serverKey = '<server key>';");
        die();
    } 
}

?>

<!DOCTYPE html>
<html>
      <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PEMBAYARAN </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
    <body>
        <br>
        <br>
            <div class="container">
<div class="card">
  <div class="card-body">
      <p>Selesaikan Pembayaran Sekarang</p>
        <button id="pay-button" class="btn btn-primary">PILIH METODE PEMBAYARAN</button>
    
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snap_token?>');
            };
        </script>
      
          </div>
          </div>
          </div>
          
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
</html>
