<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Check id */
	if(!isset($_GET["id"])) {
		return header("Location:/admin/pages.php?message=Такой страницы не существует");
	}

	/* Get data */
	$page_id = $_GET["id"];
	$name 	 = $connect->real_escape_string($_POST["name"]);
	$route 	 = $connect->real_escape_string($_POST["route"]);
	$past_path = $_POST["past_path"];
	$path 	 = $_POST["path"];
	$type 	 = $_POST["type"];
	$content = $_POST["content"];

	/* Check route */
	if($route[0] != "/") {
		$route = "/".$route;
	}

	/* Check route 2 */
	if(strlen($route) > 1) {
		if($route[strlen($route)-1] == "/") {
			$route = substr($route, 0, -1);
		}
	}

	/* The path does not change */
	if(!$path) {
		$path = $past_path;
	}

	/* Path is change */
	else {
		if($path != $past_path) {
			/* Reserved filenames */
			$reserved = [
				"index.php",
				"methods.php"
			];

			/* Check path */
			if($path[0] == "/") {
				$path = substr($path, 1);
			}

			/* Check path extension */
			$check = explode(".", $path);
			if($check[count($check) - 1] != "php") {
				$path = $path .".php";
			}

			/* Check path 2 */
			$check = explode("/", $path);
			if(in_array($path, $reserved) || $check[0] == "admin") {
				return header("Location:../page.php?id=$page_id&message=Путь зарезирвирован");
			}
			
			/* Delete page by previous path */
			unlink("../../". $past_path);
		}
	}

	/* Update page */
	file_put_contents("../../". $path, $content);

	/* SQL */
	$sql = "UPDATE `pages` SET `name`='$name',`type`='$type',`path`='$path',`route`='$route' WHERE `page_id`='$page_id'";

	/* Insert into table pages */
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Redirect */	
	return header("Location:/admin/pages.php?message=Страница изменена");