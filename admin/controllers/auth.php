<?php
	session_start();

	include "../../config.php";
	include "connect.php";

	/* Get data */
	$login = $_POST["login"];
	$password = $_POST["password"];

	/* Sql */
	$sql = "SELECT * FROM `users` WHERE `login`='". $login ."'";

	/* Check query */
	if($result = $connect->query($sql)) {
		$user = $result->fetch_assoc();

		/* Check password */
		if($user["password"] == $password) {

			/* Session */
			$_SESSION["user_id"] = $user["user_id"];

			return header("Location:../index.php");
		}

	}

	return header("Location:../login.php?message=Ошибка логина или пароля");
