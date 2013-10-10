<?
		$title_name = 'Log out';
		include("includes/header.html");
		session_start();
		$old_user = $_SESSION['valid_user'];	