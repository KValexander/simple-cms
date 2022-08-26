<?php
	include "controllers/check_auth.php";
	include "../config.php";
	include "controllers/connect.php";

	$files = "";

	/* Get files */
	$sql = "SELECT `file_id`,`name`,`path` FROM `files`";
	if(!$result = $connect->query($sql)) {
		return die("Error: ". $connect->error);
	}

	/* Handling files data */
	$files = "";
	while($row = $result->fetch_assoc()) {
		$files .= '
			<div class="item">
				<div><a href="'. $row["path"] .'" target="_blank">'. $row["path"] .'</a></div>
				<div>
					<a onclick="return confirm(\'Вы действительно хотите удалить файл?\')" href="controllers/delete_file.php?id='. $row["file_id"] .'">Удалить</a>
				</div>
			</div>
		';
	}

	/* Files not found */
	if(!$files) {
		$files = '
			<div class="item">
				<div>Файлы не найдены</div>
			</div>
		';
	}

	include "header.php";
?>	

<div class="content">

	<div class="head">Добавление файла на сервер</div>
	<form class="w100" enctype="multipart/form-data" action="controllers/upload_file.php" method="POST">
		<div class="line">
			<input type="file" name="file" required>
			<button>Добавить файл</button>
		</div>
	</form>

	<div class="head">Файлы на сервере</div>
	<div class="table">
		<div class="item">
			<div>Путь от корня</div>
			<div>Действия</div>
		</div>
		<?= $files ?>
	</div>

</div>


<?php include "footer.php"; ?>