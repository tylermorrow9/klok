<?php 
	#used to expose error message via URL
	
	$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

	if ($msg != "") {
		echo $msg."<br />";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Payroll Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- external links -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script type="text/javascript" src="js/sha256.js"></script>
	<link rel="stylesheet" type="text/css" href="css/breadcrumbs.css">
	
	<style>
		.navbar {
			overflow: hidden;
			background-color: #333;
			font-family: Arial, Helvetica, sans-serif;
		}

		.navbar a {
			float: left;
			font-size: 16px;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		.dropdown {
			float: left;
			overflow: hidden;
		}

		.dropdown .dropbtn {
			font-size: 16px;    
			border: none;
			outline: none;
			color: white;
			padding: 14px 16px;
			background-color: inherit;
			font-family: inherit;
			margin: 0;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
			top: 5.57%;
		}

		.dropdown-content a {
			float: none;
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align: left;
		}

		.dropdown-content a:hover {
			background-color: #ddd;
		}

		.dropdown:hover .dropdown-content {
			display: block;
		}
	</style>
</head>
