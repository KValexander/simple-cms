<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Data */
	$title = $_POST["title"];
	$name = $_POST["name"];
	$primary_key = $name . "_id";
	$fields = "";

	/* Fields */
	if(isset($_POST["fields"])) {
		foreach($_POST["fields"] as $val) {
			$fields .= " $val[name] $val[type],";
		}
	}

	/* SQL */
	$sql = "
		CREATE TABLE $name(
			$primary_key INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			$fields
			created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		);
	";

	/* Create table */
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	/* Insert table name into tables */
	$sql = "INSERT INTO `tables`(`title`,`name`) VALUES('$title','$name')";
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	// /* Redirect */
	return header("Location:../tables.php?message=Таблица создана");

