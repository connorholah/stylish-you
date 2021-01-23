<?php

require $_SERVER['DOCUMENT_ROOT'] . '../includes/common.php';

//getting a list of all product types for form dropdowns
$allProducts         = database_query('SELECT * FROM [ourProducts];');
$allProductColours   = database_query('SELECT DISTINCT o_colour FROM [ourProducts];');
$allProductBrands    = database_query('SELECT DISTINCT o_brand FROM [ourProducts];');
$allProductTypes     = database_query('SELECT DISTINCT o_productType FROM [ourProducts];');
$allProductLocations = database_query('SELECT DISTINCT o_location FROM [ourProducts];');
$allProductGenders   = database_query('SELECT DISTINCT o_gender FROM [ourProducts];');

$queryString = "";
$searchResults = "";
$validation = array();

//sorting form submission
if (isset($_POST['isSent'])) {


	//processing product type
	if (isset($_POST['isSent']) && (($_GET['type'] == 'mens') || ($_GET['type'] == 'womens') || ($_GET['type'] == 'boys') || ($_GET['type'] == 'girls'))) {
		$queryParams['productGender'] = '(o_gender = \'' . Cerbarus::returnEscaped($_GET['type']) . '\')';
	}

	//processing product type
	if (isset($_POST['productType'])) {
		$queryParams['productType'] = '(o_productType = \'' . Cerbarus::returnEscaped($_POST['productType']) . '\')';
	}

	//processing product size
	if (isset($_POST['productSize'])) {
		if (($_GET['type'] == 'product') || ($_GET['type'] == 'brand')) {
			$queryParams['productSize'] = '(o_ladiesSizes LIKE \'%/' . Cerbarus::returnEscaped($_POST['productSize']) . '/%\' OR o_mensSizes LIKE \'%/' . Cerbarus::returnEscaped($_POST['productSize']) . '/%\' OR o_boysSizes LIKE \'%/' . Cerbarus::returnEscaped($_POST['productSize']) . '/%\' OR o_girlsSizes LIKE \'%/' . Cerbarus::returnEscaped($_POST['productSize']) . '/%\')';
		} else {
			$queryParams['productSize'] = '(o_' . Cerbarus::returnEscaped($_GET['type']) . 'Sizes LIKE \'%/' . Cerbarus::returnEscaped($_POST['productSize']) . '/%\')';
		}
	}

	//processing product colour
	if (isset($_POST['productColour'])) {
		$queryParams['productColour'] = '(o_colour = \'' . Cerbarus::returnEscaped($_POST['productColour']) . '\')';
	}

	//processing minimum price
	if (isset($_POST['productMinPrice']) && (empty($_POST['productMinPrice']) == false)) {
		if (Cerbarus::checkIsNumber($_POST['productMinPrice']) == true) {
			$queryParams['productMinPrice'] = '(o_price >= ' . Cerbarus::returnEscaped($_POST['productMinPrice']) . ')';
		} else {
			$validation['minPrice'] = "Please enter numbers only in the minimum price field.";
		}
	}

	//processing maximum price
	if (isset($_POST['productMaxPrice']) && (empty($_POST['productMaxPrice']) == false)) {
		if (Cerbarus::checkIsNumber($_POST['productMaxPrice']) == true) {
			$queryParams['productMaxPrice'] = '(o_price <= ' . Cerbarus::returnEscaped($_POST['productMaxPrice']) . ')';
		} else {
			$validation['maxPrice'] = "Please enter numbers only in the maximum price field.";
		}
	}

	//processing product brand
	if (isset($_POST['productBrand'])) {
		$queryParams['productBrand'] = '(o_brand = \'' . Cerbarus::returnEscaped($_POST['productBrand']) . '\')';
	}

	//processing store location
	if (isset($_POST['productLocation'])) {
		$queryParams['productLocation'] = '(o_location = \'' . Cerbarus::returnEscaped($_POST['productLocation']) . '\')';
	}

	//processing product gender
	if (isset($_POST['productGender'])) {
		$queryParams['productGender'] = '(o_gender = \'' . Cerbarus::returnEscaped($_POST['productGender']) . '\')';
	}

	//checking validation before searching
	if (empty($validation)) {
		$searchString = "SELECT * FROM [ourProducts] WHERE (";
		$queryString = "";

		foreach ($queryParams as $queryParam) { 
			$queryString = $queryString . ' AND ' . $queryParam;
		}

		$queryString = trim(substr($queryString, 5));
		$queryString = $searchString . ' ' . $queryString . ')';

		$searchResults = database_query($queryString);

	}

}

//pull in the correct form template
if (isset($_GET['type'])) {
	switch ($_GET['type']) {
	    case 'mens':
	        $searchTemplate = 'gender-search';
	        break;
	    case 'ladies':
	        $searchTemplate = 'gender-search';
	        break;
	    case 'boys':
	        $searchTemplate = 'gender-search';
	        break;
	    case 'girls':
	        $searchTemplate = 'gender-search';
	        break;
	    case 'brand':
	        $searchTemplate = 'brand-search';
	        break;
	    case 'product':
	        $searchTemplate = 'product-search';
	        break;  
	    default:  	
		$searchTemplate = 'empty-search';
	}
} else {
	$searchTemplate = 'empty-search';
}



template('search', array(
	'allProductBrands'    => $allProductBrands,
	'allProductColours'   => $allProductColours,
	'allProductGenders'   => $allProductGenders,
	'allProductLocations' => $allProductLocations,
	'allProducts'         => $allProducts,
	'allProductTypes'     => $allProductTypes,
	'queryString'         => $queryString,
	'searchResults'       => $searchResults,
	'searchTemplate'      => $searchTemplate,
	'validation'          => $validation,
));
