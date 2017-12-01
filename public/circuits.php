<?php

	require("../includes/config.php");


	// A user must be connected
	$connected_user = connected_user();


	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{	

		// check if a specific circuit is requested
		if (isset($_GET["circuit"]))
		{
			// check if the given id does correspond to a voiture
			$circuit_query = "SELECT * FROM circuit WHERE id=?;";
			$result = query($circuit_query, $_GET["circuit"]);
			if (isset($result[0]))
			{	
				$result = $result[0];
				
				// check the last promotion
				$circuit_promo_query = "SELECT promo FROM promotion_circuit WHERE id_circuit = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
				$promo_result = query($circuit_promo_query, $_GET["circuit"]);

				$promo = 0;
				if (isset($promo_result[0]))
				{
					$promo = $promo_result[0]["promo"];
				}


				// get images for this circuit
				$circuit_imgs_query = "SELECT image FROM circuit_images WHERE id_circuit = ?;";
				$circuit_imgs = query($circuit_imgs_query, $_GET["circuit"]);



				render("specific_circuit.php", ["circuit" => $result, "circuit_imgs" => $circuit_imgs, "connected_user" => $connected_user, "promo" => $promo]);
				exit;
			}
			else 
			{
				// the specified id is not correct
				// redirect to the circuits.php
				redirect("circuits.php");
				exit;
			}		
		}

		// get all circuits
		$circuits_query = "SELECT id, nom, depart, prix FROM circuit;";
		$result = query($circuits_query);	

		$circuits = [];

		foreach ($result as $circuit) {
	

			// get one image to display back to user
			$one_image_query = "SELECT image FROM circuit_images WHERE id_circuit = ? LIMIT 1;";
			$one_image = query($one_image_query, $circuit["id"])[0]["image"];


			// check the last promotion
			$circuit_promo_query = "SELECT promo FROM promotion_circuit WHERE id_circuit = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
			$promo_result = query($circuit_promo_query, $circuit["id"]);

			$promo = 0;
			if (isset($promo_result[0]))
			{
				$promo = $promo_result[0]["promo"];
			}



			$circuits[] = [
				"id" => $circuit["id"],
				"nom" => $circuit["nom"],
				"depart" => $circuit["depart"],
				"image" => $one_image,
				"prix" => $circuit["prix"],
				"promo" => $promo
			];
		}

		// get all the promotions
		$circuits_promotion_query = "SELECT v.id, p.date_deb_promotion, v.nom, p.promo FROM promotion_circuit p INNER JOIN circuit v ON v.id = p.id_circuit WHERE date_fin_promotion IS NULL;";
		$result = query($circuits_promotion_query);	

		$promotions = [];

		foreach ($result as $promotion) {
			

			$promotions[] = [
				"id_circuit" => $promotion["id"],
				"nom_circuit" => $promotion["nom"],
				"promo" => $promotion["promo"],
				"date" => $promotion["date_deb_promotion"]
			];
		}
		


		render("circuits_user.php", ["connected_user" => $connected_user, "circuits" => $circuits, "promotions" => $promotions]);
		exit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// check if we are searching rather than reserving
		if (isset($_POST["search"]))
		{
			// Pepare query
			$search_query = 'SELECT id, nom, depart, prix FROM circuit WHERE CONCAT(nom, plan, depart, description) LIKE "%' . $_POST["search"] . '%";';
			$result = query($search_query);

			$circuits = [];
			if (isset($result[0]) && isset($result[0]["id"]))
			{
				foreach ($result as $circuit) 
				{
						
						// get one image to display back to user
						$one_image_query = "SELECT image FROM circuit_images WHERE id_circuit = ? LIMIT 1;";
						$one_image = query($one_image_query, $circuit["id"])[0]["image"];

					$circuits[] = [
						"id" => $circuit["id"],
						"nom" => $circuit["nom"],
						"depart" => $circuit["depart"],
						"image" => $one_image,
						"prix" => $circuit["prix"]
					];
				}
			}
			render("search_circuit.php", ["connected_user" => $connected_user, "circuits" => $circuits, "query" => $_POST["search"]]);
			exit;
		}

		

		// it was not a search but rather a reservation
		// Need to check if we have a connected user
		if (!connected_user())
		{
			
			$_SESSION["old_url"] = "circuits.php?circuit=" . $_POST["circuit_id"];
			redirect("login.php");
			exit;
		}


		// get all the returned fields
		$nbr_persons = $_POST["nbr_persons"];
		$circuit_id = $_POST["circuit_id"];

		$id_user = $_SESSION["connected_user"];
		
		// get date_depart, date_arrive
		$dates_query = "SELECT date_depart, date_arrive FROM circuit WHERE id=?;";
		$circuit = query($dates_query, $circuit_id)[0];


		// create the reservation query
		$reservation_query = "INSERT INTO reservation (id_user, date_debut, nbr_jour) VALUES (?, ?, ?);";

		// calculate number of days
			
		$date_arrive = DateTime::createFromFormat("Y-m-d H:i:s", $circuit["date_arrive"]);
		$date_depart = DateTime::createFromFormat("Y-m-d H:i:s", $circuit["date_depart"]);

		$nbr_jour = $date_arrive->diff($date_depart)->format("%a");


		query($reservation_query, $id_user, $circuit["date_depart"] ,$nbr_jour);


		// get reservation ID:
		$reservation_id_quer = "SELECT LAST_INSERT_ID() AS res_id;";
		$res_id = query($reservation_id_quer)[0]["res_id"];

		// check promotions
		$circuit_promo_query = "SELECT promo FROM promotion_circuit WHERE id_circuit = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
		$promo_result = query($circuit_promo_query, $circuit_id);

		// create reservation circuit query
		$reser_circuit_query = "INSERT INTO reservation_circuit (id_circuit, id_reservation, promo) VALUES (?, ?, ?);";
		$promo = 0;
		if (isset($promo_result[0]))
		{
			$promo = $promo_result[0]["promo"];
		}

		// execute
		query($reser_circuit_query, $circuit_id, $res_id, $promo);
		

		redirect("circuit_cart.php");
		//render("done_reserving.php", ["connected_user" => $connected_user]);
		exit;
	}
?>