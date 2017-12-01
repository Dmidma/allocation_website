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


	// get all other users
	$users_query = "SELECT id, user_name FROM users WHERE id!=?";
	$result = query($users_query, $_SESSION["connected_admin"]);	

	$users = [];

	foreach ($result as $user) {

		$users[] = [
			"id" => $user["id"],
			"user_name" => $user["user_name"]
		];
	}

	
	$cart = false;
	$hotel_reservations = [];
	$voiture_reservations = [];
	$circuit_reservations = [];
	$subtotal = 0;
	$promotions = 0;
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		// check if the user id was posted
		if (isset($_POST["id_user"]))
		{
			// use the same method you used to populate the user's cart
			$cart = true;

			$id_user = $_POST["id_user"];


			// perapre query for reserved hotels
			$res_hotel_query = 'SELECT o.nom, o.price_night, r.id AS res_id, h.id_hotel, h.pension, h.nbr_rooms, h.promotion, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_hotel h INNER JOIN hotel o ON r.id = h.id_reservation AND o.id = h.id_hotel WHERE r.id_user = ? AND r.validite = 1';
			$result = query($res_hotel_query, $id_user);


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


				// get the generated code
				$code = query("SELECT code FROM code_reservation WHERE id_reservation=?;", $hotel_reservation["res_id"])[0]["code"];


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
					"total" => $total,
					"code" => $code
				];
			}



			// perapre query for reserved voiture
			$res_voiture_query = 'SELECT o.nom, o.prix, r.id AS res_id, h.id_voiture, h.promo, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_voiture h INNER JOIN voiture o ON r.id = h.id_reservation AND o.id = h.id_voiture WHERE r.id_user = ? AND r.validite = 1;';
			$result = query($res_voiture_query, $id_user);


			

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


				// get the generated code
				$code = query("SELECT code FROM code_reservation WHERE id_reservation=?;", $voiture_reservation["res_id"])[0]["code"];


				$voiture_reservations[] = [
					"voiture_id" => $voiture_reservation["id_voiture"],
					"voiture_nom" => $voiture_reservation["nom"],
					"voiture_prix" => $voiture_reservation["prix"],
					"voiture_image" => $one_image,
					"reservartion_id" => $voiture_reservation["res_id"],
					"promotion" => $voiture_reservation["promo"],
					"date_debut" => $only_date,
					"nbr_jour" => $voiture_reservation["nbr_jour"],
					"total" => $total,
					"code" => $code
				];
			}



			// perapre query for reserved circuit
			$res_circuit_query = 'SELECT o.nom, o.prix, r.id AS res_id, h.id_circuit, h.promo, r.date_debut, r.nbr_jour FROM reservation r INNER JOIN reservation_circuit h INNER JOIN circuit o ON r.id = h.id_reservation AND o.id = h.id_circuit WHERE r.id_user = ? AND r.validite = 1;';
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


				// get the generated code
				$code = query("SELECT code FROM code_reservation WHERE id_reservation=?;", $circuit_reservation["res_id"])[0]["code"];

				$circuit_reservations[] = [
					"circuit_id" => $circuit_reservation["id_circuit"],
					"circuit_nom" => $circuit_reservation["nom"],
					"circuit_prix" => $circuit_reservation["prix"],
					"circuit_image" => $one_image,
					"reservartion_id" => $circuit_reservation["res_id"],
					"promotion" => $circuit_reservation["promo"],
					"date_debut" => $only_date,
					"nbr_jour" => $circuit_reservation["nbr_jour"],
					"total" => $total,
					"code" => $code
				];
			}	



		}
	}



	render_admin("admin_users_cart.php", ["users" => $users, "cart" => $cart, "voiture_reservations" => $voiture_reservations, "hotel_reservations" => $hotel_reservations, "circuit_reservations" => $circuit_reservations, "subtotal" => $subtotal, "promotions" => $promotions, "admin" => $admin]);
	exit;

?>