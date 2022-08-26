<?php
	session_start();
	include "methods.php";

	/* Top */
	if(isset($_SESSION["user_id"])){
		include "admin/top.php";
	}

	/* Get current page */
	$uri = explode("?", $_SERVER["REQUEST_URI"])[0];
	$sql = "SELECT `path` FROM `pages` WHERE `route`='$uri'";

	/* Get page */
	if($page = get_one($sql)) {
		include $page["path"];
	}

	/* Page not found */
	else {
		print("
			<style>body {background-color: #f3f3f3;}</style>
			<div style='display:flex;justify-content:center;align-items:center;height:90vh'>
				<div style='text-align:center;font-family:Arial'>
					<h1>Ошибка 404</h1>
					<h2>Страница не найдена</h2>
				</div>
			</div>
		");
	}

?>