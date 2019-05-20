<?php
session_start();
include('connection.php');
if (isset($_SESSION['role'])) {
	
}
else {
    echo "<script>alert('you need to login first');
    window.location.href='../index.php';</script>";	
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>ShareNotes Web App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <style type="text/css">
    	.section
    	{
    		background-color: black;
    	}
        a:hover
        {
            text-decoration: none;
        }
    </style>
</head>
<body class="bg-primary">