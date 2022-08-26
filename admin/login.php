<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Вход</title>
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<?php if(isset($_SESSION["user_id"])) include "top.php"; ?>
	<div class="login">
		<div>
			<h2>Вход</h2>
			<form action="controllers/auth.php" method="POST">
				<input type="text" placeholder="Логин" name="login" required>
				<input type="password" placeholder="Пароль" name="password" required>
				<button>Войти</button>
			</form>
		</div>
	</div>
</body>
</html>