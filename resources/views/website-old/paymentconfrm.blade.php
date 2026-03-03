<!DOCTYPE html>
<html>
<head>
    <title>Pay-Now - Signature Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body onload="document.frm1.submit()">




<?php
$mode = "TEST"; //<------------ Change to TEST for test server, PROD for production
// extract($_POST);
//dd($postDatas['workingKey']);
$workingKey = $postDatas['workingKey'];
$access_code = $postDatas['access_code'];
$sellingpricr_subtotal

$postData = array(
    "order_id" => 
    "merchant_id" =>$postDatas['merchant_id'],
    "amount" => $postDatas['amount'],
    "currency" => $postDatas['currency'],
    "redirect_url" => $postDatas['redirect_url'],
    "cancel_url" => $postDatas['cancel_url'],
    "language" => $postDatas['language'],
    "billing_name" => $postDatas['billing_name'],
    'billing_email' => $postDatas['billing_email'],
    'billing_address' => $postDatas['billing_address'],
    'billing_tel' => $postDatas['billing_tel'],
); 
	error_reporting(0);
    if (!function_exists('encrypt_two')) {
	function encrypt_two($plainText,$key)
	{
		$key = hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		$encryptedText = bin2hex($openMode);
		return $encryptedText;
	}
}
    function hextobin($hexString) 
    { 
        $length = strlen($hexString); 
        $binString="";   
        $count=0; 
        while($count<$length) 
        {       
            $subString =substr($hexString,$count,2);           
            $packedString = pack("H*",$subString); 
            if ($count==0)
        {
            $binString=$packedString;
        } 
            
        else 
        {
            $binString.=$packedString;
        } 
            
        $count+=2; 
        } 
          return $binString; 
      } 
	$merchant_data='';
	
	foreach ($postData as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}
    // dd($merchant_data);

	$encrypted_data=encrypt_two($merchant_data,$workingKey); // Method for encrypting the data.
    // dd($encrypted_data);


if ($mode == "PROD") {
    $url = "https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
} else {
    $url = "https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
}

?>
<form action="<?php echo $url; ?>" name="frm1" method="post">
    <p>Please wait.......</p>
    <?php
    echo "<input type=hidden name=encRequest value=$encrypted_data>";
    echo "<input type=hidden name=access_code value=$access_code>";
    ?>
</form>
</body>
</html>