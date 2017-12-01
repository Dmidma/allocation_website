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



	// load all circuits ids
	$circuits_query = "SELECT id, nom FROM circuit;";
	$result = query($circuits_query);
	
	$circuits = [];
	
	foreach ($result as $circuit) {

		$circuits[] = [
			"id" => $circuit["id"],
			"nom" => $circuit["nom"]
		];
	}

	$show_images = false;
	$circuit_images = [];
	$current_circuit_id = 0;
	if ($_SERVER["REQUEST_METHOD"] == "GET"	&& isset($_GET["id_circuit"]))
	{	

		$show_images = true;

		

		$id_circuit = $_GET["id_circuit"];

		// circuit images query
		$circuit_imgs_query = "SELECT i.id, i.image FROM circuit_images i INNER JOIN circuit h ON i.id_circuit = h.id WHERE h.id = ?;";
		$result = query($circuit_imgs_query, $id_circuit);

		foreach ($result as $circuit_image) 
		{
			$circuit_images[] = [
				"id" => $circuit_image["id"],
				"image" => $circuit_image["image"]
			];
		}


		$current_circuit_id = $id_circuit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"]))
	{
		delete_image("circuit", $_GET["delete"]);
		redirect("admin_images_circuit.php");
		exit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// check if the admin added a new picture
		if (isset($_POST["to_circuit_id"]))
		{

			// adding a new picture

			// target_dir
			$target_dir = "/var/www/html/pfe_web/final/public/images/circuits/";
			
			

			// get name of the current circuit
			$circuit_name = query("SELECT nom FROM circuit WHERE id=?;", $_POST["to_circuit_id"])[0]["nom"];

			
			// must append a number to the new image name


	
			// get image name
			$image_name = basename($_FILES["circuit_image"]["name"]);

			// get extension
			$tmp_array = explode(".", $image_name);
			$extension = end($tmp_array);

			// change the image name to name of circuit
			$image_name = preg_replace('/\s+/', '_', $circuit_name);

			


			// insert the image into circuit_images
			$circuit_image_query = "INSERT INTO circuit_images (id_circuit, image) VALUES (?, ?);";
			query($circuit_image_query, $_POST["to_circuit_id"], "tmp_name");

			// get last inserted id
			$circuit_image_id_query = "SELECT LAST_INSERT_ID() AS circuit_img_id;";
			$circuit_img_id = query($circuit_image_id_query)[0]["circuit_img_id"];

			// set the right image name
			$image_name  = $image_name . "_" . $circuit_img_id . "." . $extension;


			// at this point set image
			$image = "images/circuits/" . $image_name;


			// upload after fixing name
			
			// target file
			$target_file = $target_dir . $image_name;
			
			// upload the image to server
			$done_upload = move_uploaded_file($_FILES["circuit_image"]["tmp_name"], $target_file);




			query("UPDATE circuit_images SET image = ? WHERE id = ?", $image, $circuit_img_id);
			

			// redirect to the same page
			redirect("admin_images_circuit.php");
			exit;
		}
		
	}





	render_admin("admin_images_circuit.php", ["admin" => $admin, "circuits" => $circuits, "show_images" => $show_images, "circuit_images" => $circuit_images, "current_circuit_id" => $current_circuit_id]);
	exit;
?>