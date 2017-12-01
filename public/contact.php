<?php

	require("../includes/config.php");

	
	// A user must be connected
	$connected_user = connected_user();

	$message = false;

	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{	

		render("contact.php", ["connected_user" => $connected_user, "message" => $message]);
		exit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		

		// get all form input
		$nom = $_POST["nom"];
		$email = $_POST["email"];
		$sujet = $_POST["sujet"];
		$message = $_POST["message"];

		// set and execute the query
		$insert_query = "INSERT INTO contactez_nous (nom, email, sujet, message) VALUES (?, ?, ?, ?);";
		query($insert_query, $nom, $email, $sujet, $message);

		$message = true;	

		render("contact.php", ["connected_user" => $connected_user, "message" => $message]);
		exit;
	}
?>