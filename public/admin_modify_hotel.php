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



	// a delete request have been issued
	if (isset($_GET["delete"]))
	{	
		// get hotel id 
		$id_hotel = $_GET["delete"];


		delete_it("hotel", $id_hotel);

		redirect("admin_modify_hotel.php");
		exit;
	}


	// get all hotels
	$hotels_query = "SELECT * FROM hotel;";
	$result = query($hotels_query);	

	$hotels = [];

	foreach ($result as $hotel) {
		

		$hotels[] = [
			"id" => $hotel["id"],
			"nom" => $hotel["nom"],
			"star" => $hotel["stars"],
			"adresse" => $hotel["adresse"],
			"description" => $hotel["description"],
			"latitude" => $hotel["latitude"],
			"longitude" => $hotel["longitude"]
		];
	}


	render_admin("hotels_admin.php", ["admin" => $admin, "hotels" => $hotels]);
?>