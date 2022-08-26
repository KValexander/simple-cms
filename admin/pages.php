<?php
	include "controllers/check_auth.php";
	include "../config.php";
	include "controllers/connect.php";

	/* Get pages */
	$sql = "SELECT `page_id`,`name`,`type`,`route` FROM `pages`";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Data sorting */
	$pages = "";
	$components = "";
	while($row = $result->fetch_assoc()) {
			
		/* Pages */
		if($row["type"] == "page") {
			$pages .= '
				<div class="item">
					<div>
						<a href="'. $row["route"] .'">'. $row["name"] .'</a>
					</div>
					<div>'. $row["route"] .'</div>
					<div>
						<a href="page.php?id='. $row["page_id"] .'">Изменить</a> |
						<a onclick="return confirm(\'Вы действительно хотите удалить страницу?\')" href="controllers/delete_page.php?id='. $row["page_id"] .'">Удалить</a>
					</div>
				</div>
			';
		}

		/* Components */
		else if($row["type"] == "component") {
			$components .= '
				<div class="item">
					<div>'. $row["name"] .'</div>
					<div>
						<a href="page.php?t=component&id='. $row["page_id"] .'">Изменить</a> |
						<a onclick="return confirm(\'Вы действительно хотите удалить компонент?\')" href="controllers/delete_page.php?id='. $row["page_id"] .'">Удалить</a>
					</div>
				</div>
			';
		}

	}
	

	/* Pages not found */
	if(!$pages) {
		$pages = '
			<div class="item">
				<div>Страницы не найдены</div>
			</div>
		';
	}

	/* Components not found */
	if(!$components) {
		$components = '
			<div class="item">
				<div>Компоненты не найдены</div>
			</div>
		';
	}

	include "header.php";
?>	

<div class="content">

	<div class="head">Страницы</div>
	<a href="page.php">
		<button>Создать страницу</button>
	</a>
	<p class="red center">Если вы не являетесь разработчиком, лучше избегайте данного раздела</p>

	<div class="table">
		<div class="item">
			<div>Название</div>
			<div>Маршрут</div>
			<div>Действия</div>
		</div>
		<?= $pages ?>
	</div>

	<div class="head">Компоненты</div>
	<a href="page.php?t=component">
		<button>Создать компонент</button>
	</a>
	<div class="table">
		<div class="item">
			<div>Название</div>
			<div>Действия</div>
		</div>
		<?= $components ?>
	</div>

</div>


<?php include "footer.php"; ?>