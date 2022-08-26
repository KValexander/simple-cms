<?php
	include "config.php";
	include "admin/controllers/connect.php";

	/* Get */
	function get($sql) {
		global $connect;

		/* Get result */
		if(!$result = $connect->query($sql)) {
			return die("Error: ". $connect->error);	
		}

		/* Data */
		$data = [];
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

		/* Return data */
		return $data;
	}

	/* Get one */
	function get_one($sql) {
		global $connect;

		/* Get result */
		if(!$result = $connect->query($sql)) {
			return die("Error: ". $connect->error);	
		}

		/* Return data */
		return ($data = $result->fetch_assoc()) ? $data : [];

	}

	/* Get component from DB */
	function component($name) {

		/* SQL */
		$sql = "SELECT `path` FROM `pages` WHERE `type`='component' AND `name`='$name'";

		/* Out component */
		if($component = get_one($sql)) {
			include $component["path"];
		}

	}
