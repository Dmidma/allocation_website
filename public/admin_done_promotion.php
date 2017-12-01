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


	// query for hotel promos
	$promos_hotels_query = "SELECT p.id_hotel, p.promo, p.date_deb_promotion, p.date_fin_promotion, h.nom FROM promotion_hotel p INNER JOIN hotel h ON p.id_hotel = h.id WHERE date_fin_promotion IS NOT NULL;";
	$result_hotels = query($promos_hotels_query);


	$hotels_promos = [];

	foreach ($result_hotels as $row) {
		
		$hotels_promos[] = [
			"id_hotel" => $row["id_hotel"],
			"promo" => $row["promo"],
			"nom_hotel" => $row["nom"],
			"date_deb_promotion" => $row["date_deb_promotion"],
			"date_fin_promotion" => $row["date_fin_promotion"]
		];
	}



	// select * from promotion_voiture p INNER JOIN voiture v ON p.id_voiture = v.id;


	// query for voiture promos
	$promos_voiture_query = "SELECT p.id_voiture, p.promo, p.date_deb_promotion, p.date_fin_promotion, v.nom FROM promotion_voiture p INNER JOIN voiture v ON p.id_voiture = v.id WHERE date_fin_promotion IS NOT NULL;";
	$result_voitures = query($promos_voiture_query);


	$voitures_promos = [];

	foreach ($result_voitures as $row) {
		
		$voitures_promos[] = [
			"id_voiture" => $row["id_voiture"],
			"promo" => $row["promo"],
			"nom_voiture" => $row["nom"],
			"date_deb_promotion" => $row["date_deb_promotion"],
			"date_fin_promotion" => $row["date_fin_promotion"]
		];
	}


	// query for circuit promos
	$promos_circuit_query = "SELECT p.id_circuit, p.promo, p.date_deb_promotion, p.date_fin_promotion, v.nom FROM promotion_circuit p INNER JOIN circuit v ON p.id_circuit = v.id WHERE date_fin_promotion IS NOT NULL;";
	$result_circuits = query($promos_circuit_query);


	$circuits_promos = [];

	foreach ($result_circuits as $row) {
		
		$circuits_promos[] = [
			"id_circuit" => $row["id_circuit"],
			"promo" => $row["promo"],
			"nom_circuit" => $row["nom"],
			"date_deb_promotion" => $row["date_deb_promotion"],
			"date_fin_promotion" => $row["date_fin_promotion"]
		];
	}




	render_admin("done_promotions.php", ["admin" => $admin, "hotels_promos" => $hotels_promos, "voitures_promos" => $voitures_promos, "circuits_promos" => $circuits_promos]);	
?>