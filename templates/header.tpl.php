<!DOCTYPE html>
<html>
<head>

	<title>Portfolio Project</title>
	<link rel="stylesheet" type="text/css" href="/css/stylesheet.css">

</head>
<body>

<?php if (isset($_GET['type'])) {
	switch ($_GET['type']) {
	    case 'mens':
	        $brand = 'mens';
	        break;
	    case 'ladies':
	        $brand = 'ladies';
	        break;
	    case 'boys':
	        $brand = 'boys';
	        break;
	    case 'girls':
	        $brand = 'girls';
	        break; 
	    default:  	
		$brand = 'main';
	}
} else {
	$brand = 'product';
}

?>

<nav class="navbar <?php Cerbarus::echoEscaped($brand); ?>">
	<div class="container <?php Cerbarus::echoEscaped($brand); ?>">
		<a class="navbar-brand" href="/index.php"><img src="/images/logo/<?php Cerbarus::echoEscaped($brand); ?>.png"></a>
	</div>
</nav>