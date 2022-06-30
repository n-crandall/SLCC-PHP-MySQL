<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP - Week 1</title>
</head>
<body>
	<?php
	echo "<h1>Hello Friends!</h1>";

	#new variable
	$greeting = "<h2>Hello World!</h2>";
	echo $greeting;

	#number variables
	$chips = 3;
	$cookies = 7;

        #calculation
	$snacks = $chips + $cookies;
	echo "<h3>You have $chips chips + $cookies cookies = $snacks snacks</h3>";

	#new calculation
	$snacks = $chips * $cookies;
        echo "<h3>You have $chips chips * $cookies cookies = $snacks snacks</h3>";

	?>
</body>
</html>

