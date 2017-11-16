<?php 
	
	require_once("assets/funcs.php");
	$main = new main;
	$main->connect_db();
	$arr = $main->get_categories();
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
	
	
?>