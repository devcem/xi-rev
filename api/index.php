<?php

	include '../core.php';

	$request = explode('.', @$_GET['request']);
	$route   = $request[0];
	$action  = $request[1];
	$data    = array();
	$form    = @$_POST;

	$output = array(
		'message' => array('error' => false, 'text' => ''),
		'data' => array()
	);

	//Account route
	if($route == 'account'){
		if($action == 'login'){

			//Remember cookie on login form
			if(@$form['remember'] == 'true'){
				setcookie('cookie_global_username', $form['username']);
				setcookie('cookie_global_password', $form['password']);
				setcookie('cookie_global_remember', 'true');
			}else{
				setcookie('cookie_global_username', '', time()-3600);
				setcookie('cookie_global_password', '', time()-3600);
				setcookie('cookie_global_remember', '', time()-3600);
			}

			$login = $db->select('accounts', "username = '".$form['username']."' and password = '".md5($form['password'])."'", '*');

			if(@$login[0]){
				$output['message']['text']  = 'Redirecting....';
				$_SESSION['user_id']  = $login[0]['id'];
				$_SESSION['username'] = $login[0]['username'];
			}else{
				$output['message']['error'] = true;
				$output['message']['text']  = 'Username or password doesn\'t match.';
			}
		}
	}

	//Cookie route
	if($route == 'cookie'){
		if($action == 'global'){
			$data = @$_COOKIE;
		}
	}

	//Pass data into output
	$output['data'] = $data;

	header('Content-Type: application/json');
	echo json_encode($output);