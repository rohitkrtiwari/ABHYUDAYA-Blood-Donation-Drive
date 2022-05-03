<?php 

$request=$_SERVER['REQUEST_URI'];
$router = str_replace('/covid-helpdesk','',$request);

if($router=='/' or $router=='/index' or $router=='/home' or $router=='/index.php')
{
	include('home.php');
}

elseif($router == '/donate')
{
	include('donate.php');
}

elseif($router == '/patient')
{
	include('patient.php');
}

elseif($router == '/thank-you')
{
	include('thank-you.php');
}

elseif($router == '/run_script')
{
	include('run_script.php');
}

?>