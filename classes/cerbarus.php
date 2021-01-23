<?php

//Cerbarus is the Ancient Greek mythological three-headed dog who prevented unwanted souls entering the underworld.
//This class is dedicated to stopping malicious code being injected either onto user-display or entering the database, as well as basic input checks
class Cerbarus { 

	//using this function so we can escape strings either before displaying them to the browser or sending them to the database
	public static function echoEscaped($input) {
		//htmlentities escapes all characters which have HTML character entity 
		echo htmlentities($input, ENT_QUOTES | ENT_HTML5 | ENT_IGNORE, 'ISO-8859-1', false);
	}

	//using this function so we can escape strings either before displaying them to the browser or sending them to the database
	public static function returnEscaped($input) {
		//htmlentities escapes all characters which have HTML character entity 
		$escapedString = htmlentities($input, ENT_QUOTES | ENT_HTML5 | ENT_IGNORE, 'ISO-8859-1', false);
		return $escapedString;
	}


	// simply checks if the parameter given is a numeric input, accepts strings or numbers
	public static function checkIsNumber($input) {

		if (is_numeric($input) == true) {
			return true;
		} else {
			return false;
		}

	}
}

