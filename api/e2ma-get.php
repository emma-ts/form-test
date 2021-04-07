<?php

include "e2ma-keys.php";

$memberid = $_GET["memberid"];
$email = rawurldecode($_GET["email"]);

$url = $urlPrefix.$account_id."/members/".$memberid."";

$ch = curl_init();

curl_setopt($ch, CURLOPT_USERPWD, $public_api_key . ":" . $private_api_key);

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_SSLVERSION, 6);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

$user=curl_exec($ch);

curl_close($ch);

$check_member = json_decode($user);

$mid = $check_member->member_id;
$memail = $check_member->email;

if ( $mid == $memberid && $memail == $email ) {

	$json = json_encode($check_member);
	echo $json;

} else {
	echo $memail . " - " . $email;
 	echo "{\"error\": \"User not found.\"}";
}

?>