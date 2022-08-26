<?php
	/* Connect to database */
	$connect = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
	$connect->set_charset("utf8");

	/* Check error */
	if($connect->connect_error) {
		return die("Connect error: ". $connect->connect_error);
	}
