<?php
	include "controllers/check_auth.php";
	include "../config.php";
	include "controllers/connect.php";

	/* Get tables */
	$sql = "SELECT `title`,`name` FROM `tables`";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	/* Handling tables data */
	$tables = "";
	while($row = $result->fetch_assoc()) {
		$tables .= '
			<div class="item">
				<div>'. $row["title"] .'</div>
				<div>'. $row["name"] .'</div>
				<div>
					<a onclick="return confirm(\'Вы действительно хотите удалить таблицу? Весь контент, связанный с этой таблицей, так же будет удалён\')" href="controllers/delete_table.php?name='. $row["name"] .'">Удалить</a>
				</div>
			</div>
		';
	}

	/* Tables not found */
	if(!$tables) {
		$tables = '
			<div class="item">
				<div>Таблицы не найдены</div>
			</div>
		';
	}


	include "header.php";
?>	

<div class="content">

	<div class="head">Таблицы</div>
	<a href="table.php">
		<button>Создать таблицу</button>
	</a>
	<p class="red center">Если вы не являетесь разработчиком, лучше избегайте данного раздела</p>
	<div class="table">
		<div class="item">
			<div>Обозначение</div>
			<div>Название таблицы</div>
			<div>Действия</div>
		</div>
		<?= $tables ?>
	</div>

</div>


<?php include "footer.php"; ?>