<?php
	
	// configuration
	require("../includes/config.php");


	$connected_user = connected_user();
	


	// get different images
	$imgs_query_1 = "SELECT image FROM voiture_images LIMIT 10;";
	$imgs_query_2 = "SELECT image FROM hotel_images LIMIT 10;";
	$imgs_query_3 = "SELECT image FROM circuit_images LIMIT 10;";

	$img_array = [];
	/*
	$result = query($imgs_query_1);
	foreach ($result as $img) 
	{
		array_push($img_array, $img["image"]);
	}

	$result = query($imgs_query_2);
	foreach ($result as $img) 
	{
		array_push($img_array, $img["image"]);
	}

	$result = query($imgs_query_3);
	foreach ($result as $img) 
	{
		array_push($img_array, $img["image"]);
	}
	*/
	
		//$img_array = [];
		array_push($img_array, "images/home2.jpg");
	
	for ($i = 1; $i <= 4; $i++)
		array_push($img_array, "images/index-" . $i . ".jpg");
	

	// circuit part
	if (isset($_GET["depart"]))
	{
		$depart = $_GET["depart"];



		echo '<form id="myForm" action="circuits.php" method="post">
				    <input type="hidden" name="search" value="'.$depart.'">
				</form>
				<script type="text/javascript">
				    document.getElementById("myForm").submit();
				</script>';
	}
	$circuit_depart = ["Sousse", "Hammamet", "Gammart", "Djerba", "Mahdia", "Tozeur", "Sidi Bousaid", "Zaghoune", "Nabeul", "Bizerte"];



	// hotel part
	$hotel_query = "SELECT * FROM hotel LIMIT 3;";
	$hotel_result = query($hotel_query);

	$hotel_array = [];
	foreach ($hotel_result as $hotel) 
	{	

		// get one image to display back to user
		$one_image_query = "SELECT image FROM hotel_images WHERE id_hotel = ? LIMIT 1;";
		$one_image = query($one_image_query, $hotel["id"])[0]["image"];


		$hotel_array[] = [
			"id" => $hotel["id"],
			"nom" => $hotel["nom"],
			"stars" => $hotel["stars"],
			"adresse" => $hotel["adresse"],
			"description" => $hotel["description"],
			"image" => $one_image,
			"price_night" => $hotel["price_night"]
		];
	}

	// voiture part
	$voiture_query = "SELECT * FROM voiture LIMIT 3;";
	$voiture_result = query($voiture_query);


	$voiture_array = [];
	foreach ($voiture_result as $voiture) 
	{	

		// get one image to display back to user
		$one_image_query = "SELECT image FROM voiture_images WHERE id_voiture = ? LIMIT 1;";
		$one_image = query($one_image_query, $voiture["id"])[0]["image"];


		$voiture_array[] = [
			"id" => $voiture["id"],
			"nom" => $voiture["nom"],
			"marque" => $voiture["marque"],
			"puissance" => $voiture["puissance"],
			"description" => $voiture["description"],
			"carburant" => $voiture["carburant"],
			"image" => $one_image,
			"prix" => $voiture["prix"]
		];
	}


	render("index.php", ["connected_user" => $connected_user, "img_array" => $img_array, "circuit_depart" => $circuit_depart, "hotels" => $hotel_array, "voitures" => $voiture_array]);
?>