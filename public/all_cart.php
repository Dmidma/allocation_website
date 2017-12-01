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

	


	// a delete request have been issued
	if (isset($_GET["delete"]))
	{	
		// delete it
		delete_all($_GET["delete"]);

		redirect("all_cart.php");
		exit;

	}



	/*
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



	// perapre query for reserved voiture
	$res_voiture_query = 'SELECT o.nom, o.prix, r.id AS res_id, h.id_voiture, h.promo, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_voiture h INNER JOIN voiture o ON r.id = h.id_reservation AND o.id = h.id_voiture WHERE r.id_user = ? AND r.validite = 0;';
	$result = query($res_voiture_query, $id_user);


	$voiture_reservations = [];

	foreach ($result as $voiture_reservation) 
	{
		
		$current_promotion = (($voiture_reservation["prix"] * $voiture_reservation["promo"]) / 100) * $voiture_reservation["nbr_jour"];
		$promotions += $current_promotion;

		$total = ($voiture_reservation["prix"] - (($voiture_reservation["prix"] * $voiture_reservation["promo"]) / 100)) * $voiture_reservation["nbr_jour"];

		$subtotal += $voiture_reservation["prix"] * $voiture_reservation["nbr_jour"];


		// get only the date part
		$only_date = explode(" ", $voiture_reservation["date_debut"])[0];


		// get one image to display back to user
		$one_image_query = "SELECT image FROM voiture_images WHERE id_voiture = ? LIMIT 1;";
		$one_image = query($one_image_query, $voiture_reservation["id_voiture"])[0]["image"];


		$voiture_reservations[] = [
			"voiture_id" => $voiture_reservation["id_voiture"],
			"voiture_nom" => $voiture_reservation["nom"],
			"voiture_prix" => $voiture_reservation["prix"],
			"voiture_image" => $one_image,
			"reservartion_id" => $voiture_reservation["res_id"],
			"promotion" => $voiture_reservation["promo"],
			"date_debut" => $only_date,
			"nbr_jour" => $voiture_reservation["nbr_jour"],
			"total" => $total
		];
	}



	
	// perapre query for reserved circuit
	$res_circuit_query = 'SELECT o.nom, o.prix, r.id AS res_id, h.id_circuit, h.promo, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_circuit h INNER JOIN circuit o ON r.id = h.id_reservation AND o.id = h.id_circuit WHERE r.id_user = ? AND r.validite = 0;';
	$result = query($res_circuit_query, $id_user);


	$circuit_reservations = [];


	foreach ($result as $circuit_reservation) 
	{
		
		$current_promotion = (($circuit_reservation["prix"] * $circuit_reservation["promo"]) / 100) * $circuit_reservation["nbr_jour"];
		$promotions += $current_promotion;

		$total = ($circuit_reservation["prix"] - (($circuit_reservation["prix"] * $circuit_reservation["promo"]) / 100)) * $circuit_reservation["nbr_jour"];

		$subtotal += $circuit_reservation["prix"] * $circuit_reservation["nbr_jour"];


		// get only the date part
		$only_date = explode(" ", $circuit_reservation["date_debut"])[0];


		// get one image to display back to user
		$one_image_query = "SELECT image FROM circuit_images WHERE id_circuit = ? LIMIT 1;";
		$one_image = query($one_image_query, $circuit_reservation["id_circuit"])[0]["image"];

		$circuit_reservations[] = [
			"circuit_id" => $circuit_reservation["id_circuit"],
			"circuit_nom" => $circuit_reservation["nom"],
			"circuit_prix" => $circuit_reservation["prix"],
			"circuit_image" => $one_image,
			"reservartion_id" => $circuit_reservation["res_id"],
			"promotion" => $circuit_reservation["promo"],
			"date_debut" => $only_date,
			"nbr_jour" => $circuit_reservation["nbr_jour"],
			"total" => $total
		];
	}	
	



	*/


	$hotel_reservations = [];
	$circuit_reservations = [];
	$voiture_reservations = [];
	$subtotal = 0;
	$promotions = 0;
	

	// get all available codes for this user
	$codes_query = "SELECT * FROM code_reservation WHERE id_user=?;";
	$result = query($codes_query, $id_user);


	$codes = [];
	foreach ($result as $row) 
	{
		
		switch ($row["type"]) 
		{
			case 'hotel':
				$needed_query = 'SELECT h.nom AS nom, ((h.price_night * rh.nbr_rooms) - (((h.price_night * rh.nbr_rooms) * rh.promotion) / 100)) * r.nbr_jour AS prix FROM reservation r INNER JOIN reservation_hotel rh ON r.id = rh.id_reservation INNER JOIN hotel h ON h.id = rh.id_hotel WHERE r.id = ?;';
			break;
			
			case 'voiture':
				$needed_query = 'SELECT h.nom AS nom, ((h.prix) - (((h.prix) * rh.promo) / 100)) * r.nbr_jour AS prix FROM reservation r INNER JOIN reservation_voiture rh ON r.id = rh.id_reservation INNER JOIN voiture h ON h.id = rh.id_voiture WHERE r.id = ?;';
			break;

			case 'circuit':
				$needed_query = 'SELECT h.nom AS nom, ((h.prix) - (((h.prix) * rh.promo) / 100)) * rh.nbr_people AS prix FROM reservation r INNER JOIN reservation_circuit rh ON r.id = rh.id_reservation INNER JOIN circuit h ON h.id = rh.id_circuit WHERE r.id = ?;';
			break;
		}

		$needed_result = query($needed_query, $row["id_reservation"])[0];

		$codes[] = [
			"code" => $row["code"],
			"nom" => $needed_result["nom"],
			"prix" => $needed_result["prix"],
			"id_reservation" => $row["id_reservation"]

		];
	}




	render("all_cart.php", ["connected_user" => $connected_user, "hotel_reservations" => $hotel_reservations, "voiture_reservations" => $voiture_reservations, "circuit_reservations" => $circuit_reservations, "subtotal" => $subtotal, "promotions" => $promotions, "codes" => $codes]);
?>