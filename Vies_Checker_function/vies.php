<html>
<head>
</head>
<body>

<?php 
function vies_check($country,$vatNumber){
$client = new SoapClient("http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl");

/*var_dump($client->checkVat(array(
  'countryCode' => "IT",
  'vatNumber' => "02388630390"
)));*/ //Debug for the soap

$res = $client->checkVat(array(
  'countryCode' => $country,
  'vatNumber' => $vatNumber
));
//print_r($res);//DEBUG for th Result of soap

$result=json_decode(json_encode($res),true);

//print_r($result); //DEBUG ARREY OF SOAP RESULT
//print("VALID? ".$result['valid']); //DEBUG FOR VALID FIELD
$valid = $result['valid'];
return $valid;
}

//USING the function vies_check
$vatNumber = "02388630390";
$country = "IT";

$result = vies_check($country,$vatNumber);

echo $result;

?>
</body>
</html>