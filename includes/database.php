<?php
//try to connect to the database server
//$config brings the information from config.php file
$connection = new PDO($config['database']['connection_string'], $config['database']['username'], $config['database']['password']); 


//PDO is a library for connecting to databases
// here we are creating a function called database_query. We let the script know that the variables $query and $params are strings. 
function database_query(string $query, $params = []) {
	global $connection; //the global function makes the whole website connect to the database

	//prepare an exectute the string passed as $query
	$statement = $connection->prepare($query);
		
	if ($statement == false) {
	    echo "\nPDO::errorInfo():\n";
	    print_r($connection->errorInfo());
	    exit;
	}		
	if ($statement->execute($params) == false) {
	    echo "\nPDOStatement::errorInfo():\n";
	    print_r($statement->errorInfo());
	    exit;
	}
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$statement->closeCursor(); 
	return $result;
}

