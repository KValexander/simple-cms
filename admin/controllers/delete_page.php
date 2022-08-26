<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Check id */
	if(!isset($_GET["id"])) {
		return header("Location:../pages.php");
	}

	/* Page id */
	$page_id = $_GET["id"];

	/* Get page */
	$sql = "SELECT * FROM `pages` WHERE `page_id`='$page_id'";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Page */
	if(!$page = $result->fetch_assoc()) {
		return header("Location:../pages.php?message=Страница отсутствует");
	}

	/* Delete file */
	if(!unlink("../../". $page["path"])) {
		return header("Location:../pages.php?message=Ошибка удаления страницы");
	}

	/* Delete page from pages */
	$sql = "DELETE FROM `pages` WHERE `page_id`='$page_id'";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Redirect */
	return header("Location:../pages.php?message=Страница удалена");