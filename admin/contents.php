<?php
	include "controllers/check_auth.php";
	include "../config.php";
	include "controllers/connect.php";

	/* Get tables */
	$sql = "SELECT `title`,`name` FROM `tables`";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Options */
	$options = "";
	while($row = $result->fetch_assoc()) {
		$selected = ($_GET["r"] == $row["name"]) ? "selected" : "";
		$options .= '<option value="'. $row["name"] .'" '. $selected .'>'. $row["title"] .'</option>';
	}

	/* Contents */
	$contents = "";
	$result->data_seek(0);
	while($row = $result->fetch_assoc()) {

		/* Get fields */
		$fields = "";
		$sql = "DESCRIBE `$row[name]`";
		$res = $connect->query($sql);
		for($i = 0; $i < $res->num_rows; $i++) {
			$rw = $res->fetch_row();
			if($i > 0 && $i < $res->num_rows - 2) {
				$fields .= '<div>'. $rw[0] .'</div>';
			}
		}

		/* Get records */
		$records = "";
		$sql = "SELECT * FROM `$row[name]`";
		$res = $connect->query($sql);
		for($i = 0; $i < $res->num_rows; $i++) {
			$rw = $res->fetch_row();
			$records .= '<div class="item">';
			for($j = 1; $j < count($rw) - 2; $j++) {
				$records .= '<div>'. $rw[$j] .'</div>';
			}
			$records .= '
					<div>
						<a href="content.php?table='. $row["name"] .'&id='. $rw[0] .'">Изменить</a> |
						<a onclick="return confirm(\'Вы действительно хотите удалить эту запись?\')" href="controllers/delete_content.php?table='. $row["name"] .'&id='. $rw[0] .'">Удалить</a>
					</div>
				</div>
			';
		}

		/* If records not found */
		if(!$records) {
			$records = '
				<div class="item">
					<div>Записи не найдены</div>
				</div>
			';
		}

		/* Contents */
		$display = ($_GET["r"] == $row["name"]) ? "block" : "none";
		$contents .= '
			<div style="display:'. $display .'" id="'. $row["name"] .'">
				<div class="head">'. $row["title"] .'</div>
				<a href="content.php?table='. $row["name"] .'">
					<button>Создать запись</button>
				</a>
				<div class="table">
					<div class="item">
						'. $fields .'
						<div>Действия</div>
					</div>
					'. $records .'
				</div>
			</div>
		';

	}

	include "header.php";
?>	

<div class="content">

	<div class="head">Управление контентом</div>
	<select onchange="change_content(this.value)">
		<option selected disabled>Выберите раздел</option>
		<?= $options ?>
	</select>

	<div id="contents">
		<?= $contents ?>
	</div>



</div>


<?php include "footer.php"; ?>