<?php

	// configuration
	require("../includes/config.php");


	// check if a user is connected.
	if (!isset($_SESSION["connected_admin"]))
	{
		redirect("index.php");
		exit;
	}


	// get admin
	$admin_query = "SELECT * FROM users WHERE id=?";

	$admin = query($admin_query, $_SESSION["connected_admin"])[0];



	// GET Request
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{	


		// modify request
		if (isset($_GET["modify"]))
		{
			// get info of the hotel
			$circuit_query = "SELECT * FROM circuit WHERE id=?";
			$result = query($circuit_query, $_GET["modify"])[0];

			render_admin("add_circuit.php", ["admin" => $admin, "update" => true, "circuit" => $result]);
			exit;
		}


		render_admin("add_circuit.php", ["admin" => $admin]);	
		exit;	
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// get all posted data
		$name = $_POST["circuit_name"]; //required 
		$depart = $_POST["depart"]; // required
		$date_depart = DateTime::createFromFormat("m/j/Y", $_POST["date_depart"]); // required
		$date_arrive = DateTime::createFromFormat("m/j/Y", $_POST["date_arrive"]); // required
		$price = $_POST["prix"]; // required
		$plan = $_POST["plan"]? : "N/A";
		$description = $_POST["description"]? : "N/A";

		// an update request
		if (isset($_POST["update"]))
		{
			// update query
			$update_query = "UPDATE circuit SET nom=?, plan=?, depart=?, date_depart=?, date_arrive=?, prix=?, description=? WHERE id=?;";
			query($update_query, $name, $plan, $depart, $date_depart->format("Y-m-d"), $date_arrive->format("Y-m-d"), $price, $description, $_POST["update"]);

			redirect("admin_modify_circuit.php");
			exit;
		}


		// target_dir
		//$target_dir = "C:/xampp/htdocs/final/public/images/circuits/";
		$target_dir = "/var/www/html/pfe_web/final/public/images/circuits/";


		
		// handle image only if it is uploaded
		if (isset($_FILES["circuit_image"]) && isset($_FILES["circuit_image"]["name"]))
		{	
			// get image name
			$image_name = basename($_FILES["circuit_image"]["name"]);

			// get extension
			$tmp_array = explode(".", $image_name);
			$extension = end($tmp_array);

			// change the image name to name of circuit
			$image_name = preg_replace('/\s+/', '_', $name) . "." . $extension;

			// target file
			$target_file = $target_dir . $image_name;
			
			// upload the image to server
			$done_upload = move_uploaded_file($_FILES["circuit_image"]["tmp_name"], $target_file);


			// TODO: check if the upload was a success
		}

		if (substr(trim($image_name), -1) == '.')
			// default image name;
			$image_name = "default_circuit.jpg";

		// at this point set image
		$image = "images/circuits/" . $image_name;

		
		// insertion query
		$insert_circuit_query = "INSERT INTO circuit (nom, plan, depart, date_depart, date_arrive, prix, description) VALUES (?, ?, ?, CAST(? AS DATE), CAST(? AS DATE), ?, ?);";
		$done = query($insert_circuit_query, $name, $plan, $depart, $date_depart->format("Y-m-d"), $date_arrive->format("Y-m-d"), $price, $description);

		
		if ($done === false) 
		{	
			render_admin("add_circuit.php", ["message" => "Something went wrong. Check if the name already exist!", "admin" => $admin]);
			exit;
		}	

		// get circuit ID:
		$circuit_id_query = "SELECT LAST_INSERT_ID() AS circuit_id;";
		$circuit_id = query($circuit_id_query)[0]["circuit_id"];

		// insert the image into circuit_images
		$circuit_image_query = "INSERT INTO circuit_images (id_circuit, image) VALUES (?, ?);";
		$done = query($circuit_image_query, $circuit_id, $image);


		// redirect to modify hotel
		redirect("admin_modify_circuit.php");
	}
?>