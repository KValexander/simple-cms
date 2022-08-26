<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Check table */
	if(!isset($_GET["table"])) {
		return header("Location:../contents.php");
	}

	/* Check id */
	if(!isset($_GET["id"])) {
		return header("Location:../contents.php?r=$_GET[table]");
	}

	/* Data */
	$table = $_GET["table"];
	$table_id = $_GET["id"];

	/* Get data */
	$sets = "";
	foreach($_POST as $key => $val) {
		$sets .= " `$key`='$val',";
	}
	$sets = substr($sets, 0, -1);

	/* SQL */
	$sql = "UPDATE `$table` SET $sets WHERE `". $table ."_id`='$table_id'";

	/* Query */
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Redirect */
	return header("Location:../contents.php?r=$table&message=Запись изменена");