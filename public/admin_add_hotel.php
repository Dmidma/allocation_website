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
			$hotel_query = "SELECT * FROM hotel WHERE id=?";
			$result = query($hotel_query, $_GET["modify"])[0];

			render_admin("add_hotel.php", ["admin" => $admin, "update" => true, "hotel" => $result]);
			exit;
		}


		render_admin("add_hotel.php", ["admin" => $admin]);	
		exit;	
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		// get all form fields
		$name = $_POST["hotel_name"]; // required
		$stars = $_POST["stars"];
		$address = $_POST["address"]; // required
		$price = $_POST["price"]; // required
		$latitude = $_POST["latitude"]? : "N/A";
		$longitude = $_POST["longitude"]? :"N/A";
		$description = $_POST["description"]? : "N/A";
		
		// an update request
		if (isset($_POST["update"]))
		{
			// update query
			$update_query = "UPDATE hotel SET nom=?, stars=?, adresse=?, description=?, latitude=?, longitude=?, price_night=? WHERE id=?;";
			query($update_query, $name, $stars, $address, $description, $latitude, $longitude, $price, $_POST["update"]);

			redirect("admin_modify_hotel.php");
			exit;
		}



		// target_dir
		$target_dir = "/var/www/html/pfe_web/final/public/images/hotels/";
		
		

		
		// handle image only if it is uploaded
		if (isset($_FILES["hotel_image"]["name"]))
		{	
			// get image name
			$image_name = basename($_FILES["hotel_image"]["name"]);

			// get extension
			$tmp_array = explode(".", $image_name);
			$extension = end($tmp_array);

			// change the image name to name of hotel
			$image_name = preg_replace('/\s+/', '_', $name) . "." . $extension;

			// target file
			$target_file = $target_dir . $image_name;
			
			// upload the image to server
			$done_upload = move_uploaded_file($_FILES["hotel_image"]["tmp_name"], $target_file);


			// TODO: check if the upload was a success
		}

		if (substr(trim($image_name), -1) == '.')
			// default image name;
			$image_name = "default_hotel.jpg";


		// at this point set image
		$image = "images/hotels/" . $image_name;

		
		// insertion query
		$insert_hotel_query = "INSERT INTO hotel (nom, stars, adresse, description, latitude, longitude, price_night) VALUES (?, ?, ?, ?, ?, ?, ?);";
		$done = query($insert_hotel_query, $name, $stars, $address, $description, $latitude, $longitude, $price);

		
		if ($done === false) 
		{	
			render_admin("add_hotel.php", ["message" => "Something went wrong. Check if the name already exist!", "admin" => $admin]);
			exit;
		}	

		// get hotel ID:
		$hotel_id_query = "SELECT LAST_INSERT_ID() AS hotel_id;";
		$hotel_id = query($hotel_id_query)[0]["hotel_id"];

		// insert the image into hotel_images
		$hotel_image_query = "INSERT INTO hotel_images (id_hotel, image) VALUES (?, ?);";
		query($hotel_image_query, $hotel_id, $image);



		// redirect to modify hotel
		redirect("admin_modify_hotel.php");
	}
?>