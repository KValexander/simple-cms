<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Reserved filenames */
	$reserved = [
		"index.php",
		"methods.php",
		"config.php"
	];

	/* Get data */
	$name 	 = $connect->real_escape_string($_POST["name"]);
	$route 	 = $connect->real_escape_string($_POST["route"]);
	$path 	 = $connect->real_escape_string($_POST["path"]);
	$type 	 = $_POST["type"];
	$content = $_POST["content"];

	/* Check route */
	if($route[0] != "/") {
		$route = "/". $route;
	}

	/* Check route 2 */
	if(strlen($route) > 1) {
		if($route[strlen($route)-1] == "/") {
			$route = substr($route, 0, -1);
		}
	}

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
		return header("Location:../page.php?message=Путь зарезирвирован");
	}

	/* Create page */
	file_put_contents("../../". $path, $content);

	/* SQL */
	$sql = "INSERT INTO `pages`(`name`, `type`, `path`, `route`) VALUES('$name', '$type', '$path', '$route')";

	/* Insert into table pages */
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Redirect */	
	return header("Location:../pages.php?message=Страница создана");