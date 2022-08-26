<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Консоль администратора</title>
	<link rel="stylesheet" href="style/style.css">
	<script src="script/script.js"></script>
</head>
<body>
	<?php if(isset($_SESSION["user_id"])) include "top.php"; ?>

	<header>
		<div class="content">
			<div class="dot" id="dot"><p>Меню</p></div>
			<nav>
				<p><a href="/admin">Консоль</a></p>
				<p><a href="/admin/tables.php">Таблицы</a></p>
				<p><a href="/admin/contents.php">Контент</a></p>
				<p><a href="/admin/pages.php">Страницы</a></p>
				<p><a href="/admin/controllers/logout.php">Выйти</a></p>	
			</nav>
		</div>
	</header>

	<div class="message"><?= $_GET["message"] ?></div>
