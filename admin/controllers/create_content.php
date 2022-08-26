<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Check table */
	if(!isset($_GET["table"])) {
		return header("Location:../contents.php");
	}

	/* Check data */
	if(!count($_POST)) {
		return header("Location:../contents.php?message=Данные для создания отсутствуют");
	}

	/* Table */
	$table = $_GET["table"];

	/* Get fields and values */
	$fields = "";
	$values = "";
	foreach($_POST as $key => $val) {
		$fields .= " `$key`,";
		$values .= " '$val',";
	}
	$fields = substr($fields, 0, -1);
	$values = substr($values, 0, -1);

	/* SQL */
	$sql = "INSERT INTO `$table`($fields) VALUES($values)";

	/* Query */
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Redirect */
	return header("Location:../contents.php?r=$table&message=Запись создана");