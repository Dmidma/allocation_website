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



	// load all hotels ids
	$hotels_query = "SELECT id, nom FROM hotel;";
	$result = query($hotels_query);
	
	$hotels = [];
	
	foreach ($result as $hotel) {

		$hotels[] = [
			"id" => $hotel["id"],
			"nom" => $hotel["nom"]
		];
	}

	$show_images = false;
	$hotel_images = [];
	$current_hotel_id = 0;
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_hotel"]))
	{	

		$show_images = true;

		
		

		$id_hotel = $_GET["id_hotel"];

		// hotel images query
		$hotel_imgs_query = "SELECT i.id, i.image FROM hotel_images i INNER JOIN hotel h ON i.id_hotel = h.id WHERE h.id = ?;";
		$result = query($hotel_imgs_query, $id_hotel);

		foreach ($result as $hotel_image) 
		{
			$hotel_images[] = [
				"id" => $hotel_image["id"],
				"image" => $hotel_image["image"]
			];
		}


		$current_hotel_id = $id_hotel;

	}
	else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"]))
	{
		delete_image("hotel", $_GET["delete"]);
		redirect("admin_images_hotel.php");
		exit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// check if the admin added a new picture
		if (isset($_POST["to_hotel_id"]))
		{

			// adding a new picture

			// target_dir
			$target_dir = "/var/www/html/pfe_web/final/public/images/hotels/";
			
			

			// get name of the current hotel
			$hotel_name = query("SELECT nom FROM hotel WHERE id=?;", $_POST["to_hotel_id"])[0]["nom"];

			
			// must append a number to the new image name


	
			// get image name
			$image_name = basename($_FILES["hotel_image"]["name"]);

			// get extension
			$tmp_array = explode(".", $image_name);
			$extension = end($tmp_array);

			// change the image name to name of hotel
			$image_name = preg_replace('/\s+/', '_', $hotel_name);

			


			// insert the image into hotel_images
			$hotel_image_query = "INSERT INTO hotel_images (id_hotel, image) VALUES (?, ?);";
			query($hotel_image_query, $_POST["to_hotel_id"], "tmp_name");

			// get last inserted id
			$hotel_image_id_query = "SELECT LAST_INSERT_ID() AS hotel_img_id;";
			$hotel_img_id = query($hotel_image_id_query)[0]["hotel_img_id"];

			// set the right image name
			$image_name  = $image_name . "_" . $hotel_img_id . "." . $extension;


			// at this point set image
			$image = "images/hotels/" . $image_name;


			// upload after fixing name
			
			// target file
			$target_file = $target_dir . $image_name;
			
			// upload the image to server
			$done_upload = move_uploaded_file($_FILES["hotel_image"]["tmp_name"], $target_file);




			query("UPDATE hotel_images SET image = ? WHERE id = ?", $image, $hotel_img_id);
			

			// redirect to the same page
			redirect("admin_images_hotel.php");
			exit;
		}
	}





	render_admin("admin_images_hotel.php", ["admin" => $admin, "hotels" => $hotels, "show_images" => $show_images, "hotel_images" => $hotel_images, "current_hotel_id" => $current_hotel_id]);
	exit;
?>