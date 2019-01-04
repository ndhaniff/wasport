<?PHP
/*$merchantcode = $_REQUEST["MerchantCode"];
$paymentid  = $_REQUEST["PaymentId"];
$refno  = $_REQUEST["RefNo"];
$amount  = $_REQUEST["Amount"];
$ecurrency  = $_REQUEST["Currency"];
$remark  = $_REQUEST["Remark"];
$transid  = $_REQUEST["TransId"];
$authcode  = $_REQUEST["AuthCode"];
$estatus  = $_REQUEST["Status"];
$errdesc  = $_REQUEST["ErrDesc"];
$signature  = $_REQUEST["Signature"];
$ccname  = $_REQUEST["CCName"];
$ccno   = $_REQUEST["CCNo"];
$s_bankname  = $_REQUEST["S_bankname"];
$s_country  = $_REQUEST["S_country"];*/

$merchantcode = 'M18793';
$paymentid  = '31';
$refno  = '10057';
$amount  = '1.00';
$ecurrency  = 'MYR';
$remark  = 'Order for Very Miss Rabbit Virtual Run (Order ID: 10057)';
$transid  = 'T201922481900';
$estatus  = '1';
$errdesc  = '';
$signature  = 'd99d30691fa04a09528c1391d536e301e871fb66d601f61ab1914abba416ff4e';
?>

<?php
$expected_sign = $signature;
//$merchantcode = $merchantcode;
$merchantkey = 'flICG0S4Ul';

$check_sign = '';
$str = '';
$HashAmount = '';
$orderID = $refno;
$paymentID = $paymentid;
$paymentStatus = $estatus;
$amountPaid = $amount;
$transID = $transid;
$remark = $remark;
$errDesc = $errdesc;

$HashAmount = str_replace(array(',','.'), "", $amountPaid);
$str = $merchantkey . $merchantcode . $paymentID .trim(stripslashes($orderID)). $HashAmount . $ecurrency . $paymentStatus;
$check_sign = hash('sha256', $str);

if ($paymentStatus == "1" && $expected_sign == $check_sign) {
  echo "RECEIVEOK";
}

?>
