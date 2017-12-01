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
		delete_reservation("voiture", $_GET["delete"]);
		redirect("voiture_cart.php");
		exit;
	}

	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["generate_code"]) && strcmp($_GET["generate_code"], "oui") == 0)
	{
		// get all hotel reservation info
		$all_reservation_query = "SELECT * FROM reservation_voiture h INNER JOIN reservation r ON h.id_reservation = r.id WHERE r.id_user=? AND r.validite=0;";
		$result = query($all_reservation_query, $id_user);


		// set code query
		$code_query = "INSERT INTO code_reservation (id_user, type, id_reservation, code) VALUES (?, ?, ?, ?);";

		foreach ($result as $row) 
		{
			query($code_query, $id_user, "voiture", $row["id_reservation"], generate_random_number($id_user, $row["id_reservation"]));
			query("UPDATE reservation SET validite=1 WHERE id=?;", $row["id_reservation"]);
		}


		redirect("all_cart.php");
		exit;
	}


	// perapre query for reserved voiture
	$res_voiture_query = 'SELECT o.nom, o.prix, r.id AS res_id, h.id_voiture, h.promo, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_voiture h INNER JOIN voiture o ON r.id = h.id_reservation AND o.id = h.id_voiture WHERE r.id_user = ? AND r.validite = 0;';
	$result = query($res_voiture_query, $id_user);


	$voiture_reservations = [];

	$subtotal = 0;
	$promotions = 0;

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




	render("voiture_cart.php", ["connected_user" => $connected_user, "reservations" => $voiture_reservations, "subtotal" => $subtotal, "promotions" => $promotions]);
?>