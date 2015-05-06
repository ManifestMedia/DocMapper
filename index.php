<?php
require_once("lib/router.php");

try{
	$index = new Router();
	$index->init();
	$index->load_template();
}
catch (Exception $e){
	echo $e->getMessage();
		exit();
}
?>