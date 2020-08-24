<?php 
error_reporting(0);
###############   credit  ################
#     jika mau recode,jangann hapus      #
#  				credit ini 				 #
#		   checker cli amazon v2		 #
#			    created by 				 #
#		  sayidina ahmadal qososyi 	 	 #
#			  eastlombok team 	 		 #
#	 youtube : https://bit.ly/3hhtaqN 	 #
##########################################

require_once 'vendor/autoload.php';

$cli = new League\CLImate\CLImate;


$cli->draw('fancy-bender');
$cli->br();
$namaFile = $cli->input(" masukkan nama file gayn :")->prompt();
$threads = 10; //ubah ini jika mau cepet tapi ubah max 10 aja
$namaOutputCracked = "Rasult/".date('Y-m-d').'-Cracked.txt';
$namaOutputNotCracked = "Rasult/".date('Y-m-d').'-Not_cracked.txt';
$inputHapus = $cli->confirm(" Clear Rasult Sebelumnya ($namaOutputCracked) y/n :");
if ($inputHapus->confirmed()) {
	file_put_contents("$namaOutputCracked", "");
}
$cli->br();
$namaOutputDbug = "config/dbug.txt";
$date = date('Y-m-d');
while (count(file($namaFile)) > 1) {
	$count = count(file($namaFile));
	$file = fopen($namaFile, "r");
	for ($j = 0; $j < $threads; $j++) {
		$string = fgets($file);
		$str = strtok($string, "\r\n");
		$pipe[$j] = popen("php core.php $str", 'w');
		hapus();
	}
	$fileDbug = file_get_contents($namaOutputDbug);
	echo "$fileDbug\n";
	echo "[wait process] : [@checker by.osyi cozy]\n\n";
	file_put_contents($namaOutputDbug, "");
	
}
file_put_contents("empas.txt", "");
function hapus(){
	global $namaFile;
	$getsdas = file_get_contents($namaFile);
	$replace =  preg_replace('/^.+\n/', '', $getsdas);
	file_put_contents($namaFile, $replace);
}

?>