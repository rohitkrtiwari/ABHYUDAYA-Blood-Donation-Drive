<?php

define('SITE_PATH','http://localhost/covid-helpdesk/');


define('DONOR_VERIFICATION_TOKEN','23b37ba0e052ddc738fb69845e8fbad092c9da23ea0d3145bc3fd8171d2897fff7702d08a7298a29663da27e08a4a44988f2c782674f47da94838fa0');
define('PATIENT_VERIFICATION_TOKEN','80eb6e6b0fa0f281b28567d984f6ae4a1ae63ea1a7497fa87e9012738df0df46380765066c93e94563724f20edfbd5007c0229d8b35aa90b66f697c6');


$conn=mysqli_connect("localhost","root","","covid-helpdesk-database");

function conn(){
	$conn=mysqli_connect("localhost","root","","covid-helpdesk-database");
	if($conn){
		return $conn;
	}
}

?>