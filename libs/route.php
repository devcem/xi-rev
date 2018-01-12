<?php

	function route($URI){
		$output   = array();
		$URI      = urldecode($URI);
		$explode  = explode('?', $URI);
		$explode  = explode('/', $explode[0]);

		$output['request'] = @$explode[2];
		$output['action']  = @$explode[3];

		return $output;
	}