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


	// check if an admin is connected.
	if (!isset($_SESSION["connected_admin"]))
	{
		redirect("index.php");
		exit;
	}


	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		// get ids of hotels
		$ids_hotels_query = "SELECT id FROM hotel;";
		$result_hotels = query($ids_hotels_query);


		// get ids of voiture
		$ids_voiture_query = "SELECT id FROM voiture;";
		$result_voitures = query($ids_voiture_query);


		// get ids of circuit
		$ids_circuit_query = "SELECT id FROM circuit;";
		$result_circuits = query($ids_circuit_query);

		render_admin("create_promotion.php", ["admin" => $admin, "ids_hotels" => $result_hotels, "ids_voitures" => $result_voitures, "ids_circuits" => $result_circuits]);
		exit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		// Hotel
		if (isset($_POST["id_hotel"]))
		{	
			// get id and promo
			$id = $_POST["id_hotel"];
			$promo = $_POST["hotel_promo"];

			// set and execute query
			$hotel_promo_query = "INSERT INTO promotion_hotel (id_hotel, promo) VALUES (?, ?);";
			query($hotel_promo_query, $id, $promo);

		}
		else if (isset($_POST["id_voiture"]))
		{
			// get id and promo
			$id = $_POST["id_voiture"];
			$promo = $_POST["voiture_promo"];

			// set and execute query
			$voiture_promo_query = "INSERT INTO promotion_voiture (id_voiture, promo) VALUES (?, ?);";
			query($voiture_promo_query, $id, $promo);
		}
		else if (isset($_POST["id_circuit"]))
		{
			// get id and promo
			$id = $_POST["id_circuit"];
			$promo = $_POST["circuit_promo"];

			// set and execute query
			$circuit_promo_query = "INSERT INTO promotion_circuit (id_circuit, promo) VALUES (?, ?);";
			query($circuit_promo_query, $id, $promo);
		}		

		// done
		redirect("admin_create_promotion.php");
		exit;
	}
?>