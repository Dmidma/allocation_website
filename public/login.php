<?php
	
	// configuration
	require("../includes/config.php");

	$connected_user = connected_user();

	// GET Request
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		render("login.php", ["connected_user" => $connected_user]);
		exit;	
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST["username"];
		$password = $_POST["password"];


		// check if the user does exist
		$deos_exist = query("SELECT COUNT(id) AS nbr FROM users WHERE user_name=?", $username)[0];


		if ($deos_exist["nbr"] != 1)
		{
			render("login.php", ["connected_user" => $connected_user, "message" => "Invalide Username/Password! Please retry."]);
			exit;
		}
	
		// get the founded user
		$get_user = "SELECT id, admin, password FROM users WHERE user_name=?";

		$user = query($get_user, $username)[0];

		// check password
		if ($password != $user["password"])
		{
			render("login.php", ["connected_user" => $connected_user, "message" => "Invalide Username/Password! Please retry."]);
			exit;
		}

		// check if the connected user is an admin
		if ($user["admin"] == 1)
		{	
			// set admin in session
			$_SESSION["connected_admin"] = $user["id"];

			// redirect to the admin page
			redirect("admin.php");
			exit;
		}

		// A normal user
		$_SESSION["connected_user"] = $user["id"];


		if (isset($_SESSION["old_url"]))
		{
			$to_go_url = $_SESSION["old_url"];
			$_SESSION["old_url"] = "";
			redirect($to_go_url);
			exit;
		}



		redirect("index.php");
	}

	
	
?>