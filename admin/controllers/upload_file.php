<?php
	include "check_auth.php";
	include "../../config.php";
	include "connect.php";

	/* Check */
	if(!isset($_FILES["file"])) {
		return header("Location:../index.php");
	}

	/* Getting the file extension */
	$extension = explode(".", $_FILES["file"]["name"]);
	$extension = $extension[count($extension)-1];

	/* Filename */
	$filename = "1". time() .".". $extension;
	$path = "/admin/uploads/". $filename;

	/* Uploading a file to the server */
	if(!move_uploaded_file($_FILES["file"]["tmp_name"], "../../". $path)) {
		return header("Location:../index.php?message=Произошла ошибка с загрузкой файла на сервер");
	}

	/* SQL */
	$sql = "INSERT INTO `files`(`name`, `path`) VALUES('$filename', '$path')";
	
	/* Query */
	if(!$connect->query($sql)) {
		return die("Error: ". $connect->error);	
	}

	/* Redirect */
	return header("Location:../index.php?message=Файл добавлен");