<?php

	$db = new db("mysql:host=127.0.0.1;dbname=", "root", "");
	$db->setErrorCallbackFunction("error");