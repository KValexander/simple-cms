<?php
	/* Include check auth */
	include "check_auth.php";

	/* Delete session */
	unset($_SESSION["user_id"]);

	return header("Location:../../");