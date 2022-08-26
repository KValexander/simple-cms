<?php
	include "controllers/check_auth.php";
	include "../config.php";
	include "controllers/connect.php";

	$head = "Создание страницы";
	$button = "Создать";
	$action = "controllers/create_page.php";
	$type = "page";
	$page = [];

	/* Update page */
	if(isset($_GET["id"])) {

		$page_id = $_GET["id"];
		$head = "Изменение страницы";
		$button = "Сохранить";

		/* Get page */
		$sql = "SELECT `page_id`,`name`,`type`,`path`,`route` FROM `pages` WHERE `page_id`='$page_id'";
		if(!$result = $connect->query($sql)) {
			return die("Error: ". $connect->error);
		}

		/* Page */
		if(!$page = $result->fetch_assoc()){
			return header("Location:pages.php?message=Такой страницы не существует");
		};
		$action = "controllers/update_page.php?id=". $page["page_id"];

	}

	/* Component */
	if(isset($_GET["t"])) {
		if($_GET["t"] == "component") {
			$type = "component";
			$head = "Создание компонента";
			if(isset($_GET["id"])) {
				$head = "Изменение компонента";
			}
		}
	}

	include "header.php";
?>

<div class="content">

	<div class="head"><?= $head  ?></div>
	
	<form class="w100" action="<?= $action ?>" method="POST">
		<div class="line">
			<input type="text" placeholder="Название" name="name" value="<?= $page["name"] ?>" required>
			<?php
				if($type == "page") {
					print('<input type="text" placeholder="Маршрут" name="route" value="'. $page["route"] .'" required>');
				}
			?>
		</div>

		<?php
			/* Update */
			if(isset($_GET["id"])) {
				printf('
					<input type="hidden" name="past_path" value="%s">
					<div class="line">
						<input type="text" placeholder="Путь до файла от корня" name="path" value="%s" disabled required>
						<input type="button" onclick="change_path()" value="Изменить путь">
					</div>
				', $page["path"], $page["path"]);
			}
			/* Create */
			else {
				print('<input type="text" placeholder="Путь до файла от корня" name="path" required>');
			}
		?>

		<textarea placeholder="Страница" name="content" required><?php
			if(is_file("../". $page["path"])) {
				echo file_get_contents("../". $page["path"]);
			}
		?></textarea>
		<button name="type" value="<?= $type ?>"><?= $button ?></button>
	</form>

</div>

<?php include "footer.php" ?>