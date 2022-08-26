<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Check GET[name] */
	if(!isset($_GET["name"])) {
		return header("Location:../index.php");
	}

	/* Table name */
	$name = $_GET["name"];

	/* Delete table */
	$sql= "DROP TABLE `$name`";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	/* Delete table name from tables */
	$sql= "DELETE FROM `tables` WHERE `name`='$name'";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	/* Redirect */
	return header("Location:../tables.php?message=Таблица удалена");