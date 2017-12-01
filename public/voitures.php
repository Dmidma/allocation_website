<?php

	require("../includes/config.php");

	// A user must be connected
	$connected_user = connected_user();


	
	
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{	

		// check if a specific voiture is requested
		if (isset($_GET["voiture"]))
		{	


			// check if the given id does correspond to a voiture
			$voiture_query = "SELECT * FROM voiture WHERE id=?;";
			$result = query($voiture_query, $_GET["voiture"]);
			if (isset($result[0]))
			{	
				$result = $result[0];
				
				// check the last promotion
				$voiture_promo_query = "SELECT promo FROM promotion_voiture WHERE id_voiture = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
				$promo_result = query($voiture_promo_query, $_GET["voiture"]);

				$promo = 0;
				if (isset($promo_result[0]))
				{
					$promo = $promo_result[0]["promo"];
				}


				// get images for this car
				$voiture_imgs_query = "SELECT image FROM voiture_images WHERE id_voiture = ?;";
				$voiture_imgs = query($voiture_imgs_query, $_GET["voiture"]);


				render("specific_voiture.php", ["voiture" => $result, "voiture_imgs" => $voiture_imgs, "connected_user" => $connected_user, "promo" => $promo]);
				exit;
			}
			else 
			{

				// the specified id is not correct
				// redirect to the voitures.php
				redirect("voitures.php");
				exit;
			}		
		}

		// get all voitures
		$voitures_query = "SELECT id, nom, puissance, carburant, prix FROM voiture;";
		$result = query($voitures_query);	

		$voitures = [];

		foreach ($result as $voiture) {
			

			// get one image to display back to user
			$one_image_query = "SELECT image FROM voiture_images WHERE id_voiture = ? LIMIT 1;";
			$one_image = query($one_image_query, $voiture["id"])[0]["image"];


			// check the last promotion
			$voiture_promo_query = "SELECT promo FROM promotion_voiture WHERE id_voiture = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
			$promo_result = query($voiture_promo_query, $voiture["id"]);

			$promo = 0;
			if (isset($promo_result[0]))
			{
				$promo = $promo_result[0]["promo"];
			}


			$voitures[] = [
				"id" => $voiture["id"],
				"nom" => $voiture["nom"],
				"prix" => $voiture["prix"],
				"puissance" => $voiture["puissance"],
				"image" => $one_image,
				"carburant" => $voiture["carburant"],
				"promo" => $promo
			];
		}

		// get all the promotions
		$voitures_promotion_query = "SELECT v.id, p.date_deb_promotion, v.nom, p.promo FROM promotion_voiture p INNER JOIN voiture v ON v.id = p.id_voiture WHERE date_fin_promotion IS NULL;";
		$result = query($voitures_promotion_query);	

		$promotions = [];

		foreach ($result as $promotion) {
			

			$promotions[] = [
				"id_voiture" => $promotion["id"],
				"nom_voiture" => $promotion["nom"],
				"promo" => $promotion["promo"],
				"date" => $promotion["date_deb_promotion"]
			];
		}
		


		render("voitures_user.php", ["connected_user" => $connected_user, "voitures" => $voitures, "promotions" => $promotions]);
		exit;
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// check if we are searching rather than reserving
		if (isset($_POST["search"]))
		{
			// Pepare query
			$search_query = 'SELECT id, nom, marque, puissance, carburant FROM voiture WHERE CONCAT(nom, marque, carburant) LIKE "%' . $_POST["search"] . '%";';
			$result = query($search_query);

			$voitures = [];
			if (isset($result[0]) && isset($result[0]["id"]))
			{
				foreach ($result as $voiture) 
				{
				
					// get one image to display back to user
					$one_image_query = "SELECT image FROM voiture_images WHERE id_voiture = ? LIMIT 1;";
					$one_image = query($one_image_query, $voiture["id"])[0]["image"];

					$voitures[] = [
						"id" => $voiture["id"],
						"nom" => $voiture["nom"],
						"marque" => $voiture["marque"],
						"puissance" => $voiture["puissance"],
						"image" => $one_image,
						"carburant" => $voiture["carburant"]
					];
				}
			}
			render("search_voiture.php", ["connected_user" => $connected_user, "voitures" => $voitures, "query" => $_POST["search"]]);
			exit;
		}

		// it was not a search but rather a reservation
		// Need to check if we have a connected user
		if (!connected_user())
		{
			$_SESSION["old_url"] = "voitures.php?voiture=" . $_POST["voiture_id"];

			redirect("login.php");
			exit;
		}





		// get all the returned fields
		$date_in = DateTime::createFromFormat("m/j/Y", $_POST["date_in"]);
		$date_out = DateTime::createFromFormat("m/j/Y", $_POST["date_out"]);
			

		// check dates here
		$today = new DateTime();

		if ($date_in > $date_out || $date_in < $today)
		{
			redirect("voitures.php?no=1&voiture=" . $_POST["voiture_id"]);
			exit;
		}


		$voiture_id = $_POST["voiture_id"];

		$id_user = $_SESSION["connected_user"];
		
		// create the reservation query
		$reservation_query = "INSERT INTO reservation (id_user, date_debut, nbr_jour) VALUES (?, CAST(? AS DATE), ?);";

		// calculate number of days
		$nbr_jour = $date_out->diff($date_in)->format("%a");
		query($reservation_query, $id_user, $date_in->format("Y-m-d"), $nbr_jour);


		// get reservation ID:
		$reservation_id_quer = "SELECT LAST_INSERT_ID() AS res_id;";
		$res_id = query($reservation_id_quer)[0]["res_id"];

		// check promotions
		$voiture_promo_query = "SELECT promo FROM promotion_voiture WHERE id_voiture = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
		$promo_result = query($voiture_promo_query, $voiture_id);

		// create reservation voiture query
		$reser_voiture_query = "INSERT INTO reservation_voiture (id_voiture, id_reservation, promo) VALUES (?, ?, ?);";
		$promo = 0;
		if (isset($promo_result[0]))
		{
			$promo = $promo_result[0]["promo"];
		}

		// execute
		query($reser_voiture_query, $voiture_id, $res_id, $promo);
		

		redirect("voiture_cart.php");
		//render("done_reserving.php", ["connected_user" => $connected_user]);
		exit;
	}
?>