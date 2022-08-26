<?php
	include "controllers/check_auth.php";
	include "../config.php";
	include "controllers/connect.php";

	/* Check table */
	if(!isset($_GET["table"])) {
		return header("Location:contents.php");
	}

	/* Table name */
	$name = $_GET["table"];

	/* Get table */
	$sql =  "SELECT `title`,`name` FROM `tables` WHERE `name`='$name'";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Table inform */
	if(!$table = $result->fetch_assoc()) {
		return header("Location:contents.php?message=Такого раздела не существует");
	}

	/* Inform */
	$head = "Создание записи для раздела \"$table[title]\"";
	$action = "controllers/create_content.php?table=$table[name]";
	$button = "<button>Создать</button>";

	/* Update record */
	$record = [];
	if(isset($_GET["id"])) {
		$table_id = $_GET["id"];

		$head = "Изменение записи для раздела \"$table[title]\"";
		$action = "controllers/update_content.php?table=$table[name]&id=$table_id";
		$button = "<button>Сохранить</button>";

		/* Get record */
		$sql = "SELECT * FROM `$table[name]` WHERE `$table[name]_id`='$table_id'";
		if(!$result = $connect->query($sql)) {
			return die("Error: ". $connect->error);
		}

		/* Record */
		if(!$record = $result->fetch_assoc()) {
			return header("Location:contents.php?r=$table[name]&message=Запись отсутствует");
		}

	}

	/* Get fields */
	$sql = "DESCRIBE `$name`";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Formation of inputs */
	$inputs = "";
	for($i = 0; $i < $result->num_rows; $i++) {
		$row = $result->fetch_array();
		if($i > 0 && $i < $result->num_rows - 2) {
			$type = ($row[1] == "text") ? "text" : "number";
			$inputs .= '<input type="'. $type .'" placeholder="'. $row[0] .'" name="'. $row[0] .'" value="'. $record[$row[0]] .'" required>';
		}
	}

	/* Fields not found */
	if(!$inputs) {
		$inputs = "<p>Поля не найдены</p>";
		$button = "";
	}


	include "header.php";
?>	

<div class="content">

	<div class="head"><?= $head ?></div>
	<form class="w100" action="<?= $action ?>" method="POST">
		<?= $inputs ?>
		<?= $button ?>
	</form>

</div>


<?php include "footer.php"; ?>