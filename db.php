<?php 
	$dbconn4 = "host=localhost dbname=postgres user=postgres password=";
	$link = pg_connect($dbconn4);
	if (!$link){
		die('Connect error');
		
	}
	    

 ?>