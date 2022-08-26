<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Check */
	if(!isset($_GET["id"])) {
		return header("Location:../index.php");
	}

	/* File id */
	$file_id = $_GET["id"];

	/* Get filename */
	$sql = "SELECT `name` FROM `files` WHERE `file_id`='$file_id'";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	/* Filename */
	if(!$filename = $result->fetch_assoc()) {
		return header("Location:../index.php?message=Файл отсутствует");
	}

	/* Delete file on server */
	if(!unlink("../uploads/".$filename["name"])) {
		return header("Location:../index.php?message=Ошибка удаления файла на сервере");
	}

	/* Delete file in database */
	$sql = "DELETE FROM `files` WHERE `file_id`='$file_id'";
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	/* Redirect */
	return header("Location:../index.php?message=Файл удалён");