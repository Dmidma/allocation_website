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
			$voiture_query = "SELECT * FROM voiture WHERE id=?";
			$result = query($voiture_query, $_GET["modify"])[0];

			render_admin("add_voiture.php", ["admin" => $admin, "update" => true, "voiture" => $result]);
			exit;
		}


		render_admin("add_voiture.php", ["admin" => $admin]);	
		exit;	
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	

		// get all form fields
		$name = $_POST["name"]; // required
		$marque = $_POST["marque"]; // required
		$puissance = $_POST["puissance"]; // required
		
		// set carburant
		$carburant = $_POST["carburant"];
		switch ($carburant) {
			case 1:
				$carburant = "Sans Plomb";
				break;
			
			case 2:
				$carburant = "Gazoil 50";
				break;

			case 3:	
				$carburant = "Gazoil";
				break;
		}


		$prix = $_POST["prix"]; // required
		$description = $_POST["description"]? : "N/A";



		// an update request
		if (isset($_POST["update"]))
		{
			// update query
			$update_query = "UPDATE voiture SET nom=?, marque=?, puissance=?, carburant=?, prix=?, description=? WHERE id=?;";
			query($update_query, $name, $marque, $puissance, $carburant, $prix, $description, $_POST["update"]);

			redirect("admin_modify_voiture.php");
			exit;
		}




		// target_dir
		$target_dir = "/var/www/html/pfe_web/final/public/images/voitures/";
		
		

		
		// handle image only if it is uploaded
		if (isset($_FILES["car_image"]["name"]))
		{	
			// get image name
			$image_name = basename($_FILES["car_image"]["name"]);

			// get extension
			$tmp_array = explode(".", $image_name);
			$extension = end($tmp_array);

			// change the image name to name of hotel
			$image_name = preg_replace('/\s+/', '_', $name) . "." . $extension;

			// target file
			$target_file = $target_dir . $image_name;
			
			// upload the image to server
			$done_upload = move_uploaded_file($_FILES["car_image"]["tmp_name"], $target_file);


			// TODO: check if the upload was a success
		}

		if (substr(trim($image_name), -1) == '.')
			// default image name;
			$image_name = "default_voiture.jpg";

		// at this point set image
		$image = "images/voitures/" . $image_name;

		
		// insertion query
		$insert_voiture_query = "INSERT INTO voiture (nom, marque, puissance, carburant, description, prix) VALUES (?, ?, ?, ?, ?, ?);";
		$done = query($insert_voiture_query, $name, $marque, $puissance, $carburant, $description, $prix);

		
		if ($done === false) 
		{	
			render_admin("add_voiture.php", ["message" => "Something went wrong. Check if the name already exist!", "admin" => $admin]);
			exit;
		}	

		// get voiture ID:
		$voiture_id_query = "SELECT LAST_INSERT_ID() AS voiture_id;";
		$voiture_id = query($voiture_id_query)[0]["voiture_id"];

		// insert the image into hotel_images
		$voiture_image_query = "INSERT INTO voiture_images (id_voiture, image) VALUES (?, ?);";
		$done = query($voiture_image_query, $voiture_id, $image);


		// redirect to modify hotel
		redirect("admin_modify_voiture.php");
	}
?>