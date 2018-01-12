<?php

	session_start();

	date_default_timezone_set('Europe/Istanbul');

	include('libs/pdo.php');
    include('libs/conf.php');
    include('libs/language.php');
    include('libs/functions.php');

	$page = @$_GET['page'] ? $_GET['page'] : 'project.index';
	$auth = @$_SESSION['user_id'];

	if(!$auth){
		$page = 'login';
	}