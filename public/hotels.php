<?php

	require("../includes/config.php");

	
	// A user must be connected
	$connected_user = connected_user();



	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{	

		// check if a specific hotel is requested
		if (isset($_GET["hotel"]))
		{
			// check if the given id does correspond to a hotel
			$hotel_query = "SELECT * FROM hotel WHERE id=?;";
			$result = query($hotel_query, $_GET["hotel"]);
			if (isset($result[0]))
			{	
				$result = $result[0];
				
				// check the last promotion
				$hotel_promo_query = "SELECT promo FROM promotion_hotel WHERE id_hotel = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
				$promo_result = query($hotel_promo_query, $_GET["hotel"]);

				$promo = 0;
				if (isset($promo_result[0]))
				{
					$promo = $promo_result[0]["promo"];
				}


				// get images for this hotel
				$hotel_imgs_query = "SELECT image FROM hotel_images WHERE id_hotel = ?;";
				$hotel_imgs = query($hotel_imgs_query, $_GET["hotel"]);



				render("specific_hotel.php", ["hotel" => $result, "hotel_imgs" => $hotel_imgs, "connected_user" => $connected_user, "promo" => $promo]);
				exit;
			}
			else 
			{

				// the specified id is not correct
				// redirect to the hotels.php
				redirect("hotels.php");
				exit;
			}		
		}

		// get all hotels
		$hotels_query = "SELECT * FROM hotel;";
		$result = query($hotels_query);	

		$hotels = [];

		foreach ($result as $hotel) {
			

			// get one image to display back to user
			$one_image_query = "SELECT image FROM hotel_images WHERE id_hotel = ? LIMIT 1;";
			$one_image = query($one_image_query, $hotel["id"])[0]["image"];

			// check the last promotion
			$hotel_promo_query = "SELECT promo FROM promotion_hotel WHERE id_hotel = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
			$promo_result = query($hotel_promo_query, $hotel["id"]);

			$promo = 0;
			if (isset($promo_result[0]))
			{
				$promo = $promo_result[0]["promo"];
			}



			$hotels[] = [
				"id" => $hotel["id"],
				"nom" => $hotel["nom"],
				"stars" => $hotel["stars"],
				"price_night" => $hotel["price_night"],
				"description" => $hotel["description"],
				"latitude" => $hotel["latitude"],
				"longitude" => $hotel["longitude"],
				"image" => $one_image,
				"promo" => $promo
			];
		}



		// get all the promotions
		$hotels_promotion_query = "SELECT h.id, p.date_deb_promotion, h.nom, p.promo FROM promotion_hotel p INNER JOIN hotel h ON h.id = p.id_hotel WHERE date_fin_promotion IS NULL;";
		$result = query($hotels_promotion_query);	

		$promotions = [];

		foreach ($result as $promotion) {
			

			$promotions[] = [
				"id_hotel" => $promotion["id"],
				"nom_hotel" => $promotion["nom"],
				"promo" => $promotion["promo"],
				"date" => $promotion["date_deb_promotion"]
			];
		}
		


		render("hotels_user.php", ["connected_user" => $connected_user, "hotels" => $hotels, "promotions" => $promotions]);
	}
	else if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// check if we are searching rather than reserving
		if (isset($_POST["search"]))
		{
			// Pepare query
			$search_query = 'SELECT * FROM hotel WHERE CONCAT(nom, adresse) LIKE "%' . $_POST["search"] . '%";';
			$result = query($search_query);

			$hotels = [];
			if (isset($result[0]) && isset($result[0]["id"]))
			{
				foreach ($result as $hotel) 
				{
					
					// get one image to display back to user
					$one_image_query = "SELECT image FROM hotel_images WHERE id_hotel = ? LIMIT 1;";
					$one_image = query($one_image_query, $hotel["id"])[0]["image"];

					$hotels[] = [
						"id" => $hotel["id"],
						"nom" => $hotel["nom"],
						"stars" => $hotel["stars"],
						"adresse" => $hotel["adresse"],
						"description" => $hotel["description"],
						"latitude" => $hotel["latitude"],
						"longitude" => $hotel["longitude"],
						"image" => $one_image
					];
				}
			}
			render("search_hotel.php", ["connected_user" => $connected_user, "hotels" => $hotels, "query" => $_POST["search"]]);
			exit;
		}

		// it was not a search but rather a reservation
		// Need to check if we have a connected user
		if (!connected_user())
		{	
			$_SESSION["old_url"] = "hotels.php?hotel=" . $_POST["hotel_id"];

			redirect("login.php");
			exit;
		}


		// get all the returned fields
		$check_in_date = DateTime::createFromFormat("m/j/Y", $_POST["check_in"]);
		$check_out_date = DateTime::createFromFormat("m/j/Y", $_POST["check_out"]);


		// check dates here
		$today = new DateTime();

		if ($check_in_date > $check_out_date || $check_in_date < $today)
		{
			redirect("hotels.php?no=1&hotel=" . $_POST["hotel_id"]);
			exit;
		}



		$rooms = $_POST["rooms"];
		$pension = $_POST["pension"];
		$hotel_id = $_POST["hotel_id"];

		$id_user = $_SESSION["connected_user"];
		
		// create the reservation query
		$reservation_query = "INSERT INTO reservation (id_user, date_debut, nbr_jour) VALUES (?, CAST(? AS DATE), ?);";

		// calculate number of days
		$nbr_jour = $check_out_date->diff($check_in_date)->format("%a");
		query($reservation_query, $id_user, $check_in_date->format("Y-m-d"), $nbr_jour);


		// get reservation ID:
		$reservation_id_quer = "SELECT LAST_INSERT_ID() AS res_id;";
		$res_id = query($reservation_id_quer)[0]["res_id"];

		// check promotions
		$hotel_promo_query = "SELECT promo FROM promotion_hotel WHERE id_hotel = ? AND date_fin_promotion IS NULL ORDER BY date_deb_promotion DESC LIMIT 1;";
		$promo_result = query($hotel_promo_query, $hotel_id);

		// create reservation hotel query
		$reser_hotel_query = "INSERT INTO reservation_hotel (id_hotel, id_reservation, pension, nbr_rooms, promotion) VALUES (?, ?, ?, ?, ?);";
		$promo = 0;
		if (isset($promo_result[0]))
		{
			$promo = $promo_result[0]["promo"];
		}

		// execute
		query($reser_hotel_query, $hotel_id, $res_id, $pension, $rooms, $promo);
		

		redirect("hotel_cart.php");
		//render("done_reserving.php", ["connected_user" => $connected_user]);
		exit;
	}
?>