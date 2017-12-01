<?php

	require("../includes/config.php");

	// A user must be connected
	$connected_user = connected_user();
	if ($connected_user === false)
	{
		redirect("index.php");
		exit;
	}


	$id_user = $_SESSION["connected_user"];


	// delete query
	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"]))
	{
		delete_reservation("hotel", $_GET["delete"]);
		redirect("hotel_cart.php");
		exit;
	}


	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["generate_code"]) && strcmp($_GET["generate_code"], "oui") == 0)
	{
		// get all hotel reservation info
		$all_reservation_query = "SELECT * FROM reservation_hotel h INNER JOIN reservation r ON h.id_reservation = r.id WHERE r.id_user=? AND r.validite=0;";
		$result = query($all_reservation_query, $id_user);


		// set code query
		$code_query = "INSERT INTO code_reservation (id_user, type, id_reservation, code) VALUES (?, ?, ?, ?);";

		foreach ($result as $row) 
		{
			query($code_query, $id_user, "hotel", $row["id_reservation"], generate_random_number($id_user, $row["id_reservation"]));
			query("UPDATE reservation SET validite=1 WHERE id=?;", $row["id_reservation"]);
		}


		redirect("all_cart.php");
		exit;
	}



	// perapre query for reserved hotels
	$res_hotel_query = 'SELECT o.nom, o.price_night, r.id AS res_id, h.id_hotel, h.pension, h.nbr_rooms, h.promotion, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_hotel h INNER JOIN hotel o ON r.id = h.id_reservation AND o.id = h.id_hotel WHERE r.id_user = ? AND r.validite = 0;';
	$result = query($res_hotel_query, $id_user);


	$hotel_reservations = [];

	$subtotal = 0;
	$promotions = 0;

	foreach ($result as $hotel_reservation) 
	{
		
		$current_promotion = (($hotel_reservation["price_night"] * $hotel_reservation["promotion"]) / 100) * $hotel_reservation["nbr_jour"];
		$promotions += $current_promotion;

		$total = ($hotel_reservation["price_night"] - (($hotel_reservation["price_night"] * $hotel_reservation["promotion"]) / 100)) * $hotel_reservation["nbr_jour"];

		$subtotal += $hotel_reservation["price_night"] * $hotel_reservation["nbr_jour"];

		// get only the date part
		$only_date = explode(" ", $hotel_reservation["date_debut"])[0];


		// get one image to display back to user
		$one_image_query = "SELECT image FROM hotel_images WHERE id_hotel = ? LIMIT 1;";
		$one_image = query($one_image_query, $hotel_reservation["id_hotel"])[0]["image"];


		$hotel_reservations[] = [
			"hotel_id" => $hotel_reservation["id_hotel"],
			"hotel_nom" => $hotel_reservation["nom"],
			"hotel_price_night" => $hotel_reservation["price_night"],
			"hotel_image" => $one_image,
			"reservartion_id" => $hotel_reservation["res_id"],
			"hotel_pension" => $hotel_reservation["pension"],
			"hotel_rooms" => $hotel_reservation["nbr_rooms"],
			"promotion" => $hotel_reservation["promotion"],
			"date_debut" => $only_date,
			"nbr_jour" => $hotel_reservation["nbr_jour"],
			"total" => $total
		];
	}




	render("hotel_cart.php", ["connected_user" => $connected_user, "reservations" => $hotel_reservations, "subtotal" => $subtotal, "promotions" => $promotions]);


?>