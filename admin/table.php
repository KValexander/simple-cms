<?php 
	include "controllers/check_auth.php";
	include "header.php";
?>

<div class="content">

	<div class="head">Создание таблицы</div>
	<p>Первичный ключ создаётся автоматически: <br><b>название таблицы + _id</b></p>

	<form class="w100" action="controllers/create_table.php" method="POST">
		
		<div class="triple">
			<input type="text" placeholder="Обозначение" name="title" required>
			<input type="text" placeholder="Название таблицы" name="name" required>
			<input type="button" onclick="add_field()" value="Добавить поле">
		</div>

		<div class="fields"></div>
		
		<button>Создать таблицу</button>

	</form>

</div>

<?php include "footer.php"; ?>