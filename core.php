<?php 

$namaOutputCracked = "Rasult/".date('Y-m-d').'-Cracked.txt';
$namaOutputNotCracked = "Rasult/".date('Y-m-d').'-Not_cracked.txt';
$namaOutputDbug = "config/dbug.txt";
$namaOutputDbugCracked = "Rasult/".date('Y-m-d').'-Cracked.txt';
$namaOutputDbugNotCracked = "Rasult/".date('Y-m-d').'-Not_cracked.txt';
$token = file_get_contents("token.txt");
$split = explode(":", $argv[1]);
$email = $split[0];
$password = $split[1];
$call = checker($email,$password,$token);
if ($call["msg"] == "api key is wrong") {
	tulis("dbug", "[401] Api key is wrong", $namaOutputDbug);
}else if( $call["msg"] == "something wrong, check endpoint!" ){
	tulis("dbug", "[401] Something Wrong, Check Endpoint Api!", $namaOutputDbug);
}else if($call["msg"] == "ok"){
	if ($call["data"]["status"] == "cracked") {
		$datacrack = $call["data"]["email"].":".$call["data"]["password"];
		tulis("live", $datacrack, $namaOutputCracked);
		tulis("dbug", "[crack]$datacrack", $namaOutputDbug);
		tulis("dbug", "[crack]$datacrack", $namaOutputDbugCracked);
	}else{
		tulis("die", $argv[1], $namaOutputNotCracked);
		tulis("dbug", "[not crack]$argv[1]", $namaOutputDbug);
		tulis("dbug", "[not crack]$argv[1]", $namaOutputDbugNotCracked);
	}
}


function checker($email,$password,$token){
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://eastlombok.xyz/restApi/api.php?check=md5&key=$token&tipe=decrypt",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "email=$email&password=$password",
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/x-www-form-urlencoded"
		),
	));

	$response = curl_exec($curl);
	$decode = json_decode($response, true);
	curl_close($curl);
	return $decode;

}

function tulis($tipe, $data = null, $path){
	if ($tipe == "copret") {
		$namaFile = $path;
		$file = fopen($namaFile, "a");
		fwrite($file, "================Tool EastLombok===============\n=====created by: sayidina ahmadal qoqosyi=====\n\n");
		fclose($file);
	}else if($tipe == "dbug"){
		$namaFile = $path;
		$file = fopen($namaFile, "a");
		fwrite($file, "$data\n");
		fclose($file);
	}else{
		$namaFile = $path;
		$file = fopen($namaFile, "a");
		fwrite($file, $data."\n");
		fclose($file);
	}
}


?>