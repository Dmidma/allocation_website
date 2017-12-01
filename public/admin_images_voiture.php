<?php

	// configuration
	require("../includes/config.php");


	// check if an admin is connected.
	if (!isset($_SESSION["connected_admin"]))
	{
		redirect("index.php");
		exit;
	}

	// get admin
	$admin_query = "SELECT * FROM users WHERE id=?";
	$admin = query($admin_query, $_SESSION["connected_admin"])[0];




	// load all voitures ids
	$voitures_query = "SELECT id, nom FROM voiture;";
	$result = query($voitures_query);
	
	$voitures = [];
	
	foreach ($result as $voiture) {

		$voitures[] = [
			"id" => $voiture["id"],
			"nom" => $voiture["nom"]
		];
	}

	$show_images = false;
	$voiture_images = [];
	$current_voiture_id = 0;
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_voiture"]))
	{	

		$show_images = true;

		$id_voiture = $_GET["id_voiture"];

		// voiture images query
		$voiture_imgs_query = "SELECT i.id, i.image FROM voiture_images i INNER JOIN voiture h ON i.id_voiture = h.id WHERE h.id = ?;";
		$result = query($voiture_imgs_query, $id_voiture);

		foreach ($result as $voiture_image) 
		{
			$voiture_images[] = [
				"id" => $voiture_image["id"],
				"image" => $voiture_image["image"]
			];
		}


		$current_voiture_id = $id_voiture;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"]))
	{
		delete_image("voiture", $_GET["delete"]);
		redirect("admin_images_voiture.php");
		exit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
		// check if the admin added a new picture
		if (isset($_POST["to_voiture_id"]))
		{

			// adding a new picture

			// target_dir
			$target_dir = "/var/www/html/pfe_web/final/public/images/voitures/";
			
			

			// get name of the current voiture
			$voiture_name = query("SELECT nom FROM voiture WHERE id=?;", $_POST["to_voiture_id"])[0]["nom"];

			
			// must append a number to the new image name


	
			// get image name
			$image_name = basename($_FILES["voiture_image"]["name"]);

			// get extension
			$tmp_array = explode(".", $image_name);
			$extension = end($tmp_array);

			// change the image name to name of voiture
			$image_name = preg_replace('/\s+/', '_', $voiture_name);

			


			// insert the image into voiture_images
			$voiture_image_query = "INSERT INTO voiture_images (id_voiture, image) VALUES (?, ?);";
			query($voiture_image_query, $_POST["to_voiture_id"], "tmp_name");

			// get last inserted id
			$voiture_image_id_query = "SELECT LAST_INSERT_ID() AS voiture_img_id;";
			$voiture_img_id = query($voiture_image_id_query)[0]["voiture_img_id"];

			// set the right image name
			$image_name  = $image_name . "_" . $voiture_img_id . "." . $extension;


			// at this point set image
			$image = "images/voitures/" . $image_name;


			// upload after fixing name
			
			// target file
			$target_file = $target_dir . $image_name;
			
			// upload the image to server
			$done_upload = move_uploaded_file($_FILES["voiture_image"]["tmp_name"], $target_file);




			query("UPDATE voiture_images SET image = ? WHERE id = ?", $image, $voiture_img_id);
			

			// redirect to the same page
			redirect("admin_images_voiture.php");
			exit;
		}
	}





	render_admin("admin_images_voiture.php", ["admin" => $admin, "voitures" => $voitures, "show_images" => $show_images, "voiture_images" => $voiture_images, "current_voiture_id" => $current_voiture_id]);
	exit;
?>