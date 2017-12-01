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
		// get voiture id 
		$id_voiture = $_GET["delete"];

		delete_it("voiture", $id_voiture);

		redirect("admin_modify_voiture.php");
		exit;
	}





	// get all hotels
	$voitures_query = "SELECT * FROM voiture;";
	$result = query($voitures_query);	

	$voitures = [];

	foreach ($result as $voiture) {
		

		$voitures[] = [
			"id" => $voiture["id"],
			"nom" => $voiture["nom"],
			"marque" => $voiture["marque"],
			"puissance" => $voiture["puissance"],
			"carburant" => $voiture["carburant"],
			"prix" => $voiture["prix"],
			"description" => $voiture["description"]
		];
	}


	render_admin("voitures.php", ["admin" => $admin, "voitures" => $voitures]);
?>