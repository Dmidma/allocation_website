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
		delete_reservation("circuit", $_GET["delete"]);
		redirect("circuit_cart.php");
		exit;
	}


	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["generate_code"]) && strcmp($_GET["generate_code"], "oui") == 0)
	{
		// get all hotel reservation info
		$all_reservation_query = "SELECT * FROM reservation_circuit h INNER JOIN reservation r ON h.id_reservation = r.id WHERE r.id_user=? AND r.validite=0;";
		$result = query($all_reservation_query, $id_user);


		// set code query
		$code_query = "INSERT INTO code_reservation (id_user, type, id_reservation, code) VALUES (?, ?, ?, ?);";

		foreach ($result as $row) 
		{
			query($code_query, $id_user, "circuit", $row["id_reservation"], generate_random_number($id_user, $row["id_reservation"]));
			query("UPDATE reservation SET validite=1 WHERE id=?;", $row["id_reservation"]);
		}


		redirect("all_cart.php");
		exit;
	}

	// perapre query for reserved circuit
	$res_circuit_query = 'SELECT o.nom, o.prix, r.id AS res_id, h.id_circuit, h.promo, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_circuit h INNER JOIN circuit o ON r.id = h.id_reservation AND o.id = h.id_circuit WHERE r.id_user = ? AND r.validite = 0;';
	$result = query($res_circuit_query, $id_user);


	$circuit_reservations = [];

	$subtotal = 0;
	$promotions = 0;

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




	render("circuit_cart.php", ["connected_user" => $connected_user, "reservations" => $circuit_reservations, "subtotal" => $subtotal, "promotions" => $promotions]);
?>