<?php
	
	// configuration
	require("../includes/config.php");

	// check the connected_user
	$connected_user = connected_user();

	// GET Request
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		render("signup.php", ["connected_user" => $connected_user]);
		exit;	
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	

		// get all form inputs
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$cin = $_POST["cin"];
		$adresse = $_POST["adresse"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$confirmation = $_POST["confirm"];
		$num_tel = $_POST["num_tel"];
	
	
		if (!is_numeric($cin) || !is_numeric($num_tel))
		{
			render("signup.php", ["message" => "CIN et Tel ne doivent pas contenir des lettres.", "connected_user" => $connected_user]);
			exit;
		}

		// check if the username is unique
		$username_check = "SELECT COUNT(id) AS nbr FROM users WHERE user_name=?";
		$nbr_username = query($username_check, $username)[0]["nbr"];
		if ($nbr_username != 0)
		{
			render("signup.php", ["message" => "User Name already exists!", "connected_user" => $connected_user]);
			exit;
		}

		// check if the CIN is unique
		$cin_check = "SELECT COUNT(id) AS nbr FROM users WHERE cin=?";
		$nbr_cin = query($username_check, $cin)[0]["nbr"];
		if ($nbr_username != 0)
		{
			render("signup.php", ["message" => "CIN already exists!", "connected_user" => $connected_user]);
			exit;
		}		


		// test if the passward and confirmation does match
		if ($password != $confirmation)
		{
			render("signup.php", ["message" => "Password and confirmation does not match!", "connected_user" => $connected_user]);
			exit;
		}

		// Insert user
		$insertion_query = "INSERT INTO users (nom, prenom, CIN, adresse, user_name, password, num_tel) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$insert_result = query($insertion_query, $nom, $prenom, $cin, $adresse, $username, $password, $num_tel);
		if ($insertion_query == false)
		{
			render("signup.php", ["message" => "Somehing went wrong :( Please Repeat!", "connected_user" => $connected_user]);
			exit;
		}


		// the user have been added
		redirect("login.php");
		exit;
	}
?>