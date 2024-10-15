<?php
	define ('rdbserver','localhost');
	define ('rdbuname','root');
	define ('rdbpword','');
	define ('rdbdb','ebsurdb2');
	
	$rdb_conn = mysql_connect(rdbserver, rdbuname, rdbpword, rdbdb) or die ('Could not Connect to Database' . mysql_error());
	mysql_select_db(rdbdb, $rdb_conn) or die ('Could not Select Database'.mysql_error());
?>