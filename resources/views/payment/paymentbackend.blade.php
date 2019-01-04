<?PHP
$merchantcode = $_REQUEST["MerchantCode"];
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
$s_country  = $_REQUEST["S_country"];
?>

<?php
$expected_sign = $signature;
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
