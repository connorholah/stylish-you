<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//database connection
include $_SERVER['DOCUMENT_ROOT'] . '../includes/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '../includes/database.php';

//classes
include $_SERVER['DOCUMENT_ROOT'] . '../classes/cerbarus.php';

//template allows a cleaner separation of HTML and PHP
function template(string $template, array $data = []) {

	//if there is a collision, EXTR_SKIP will not overwrite the already existing variable 
	extract($data, EXTR_SKIP);

	//		
	$e = function($var, $default = '') use ($data) {

		if (array_key_exists($var, $data)) {
			return htmlentities($data[$var]);		
		}
		return htmlentities($default);	

	};

	include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.tpl.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/templates/' . $template . '.tpl.php';
	include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.tpl.php';

}