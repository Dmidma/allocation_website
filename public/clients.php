<?php
	
	// configuration
	require("../includes/config.php");


	// check if a user is connected.
	if (!isset($_SESSION["connected_admin"]))
	{
		redirect("index.php");
		exit;
	}


	// a delete request have been issued
	if (isset($_GET["delete"]))
	{	
		// get circuit id 
		$id_user = $_GET["delete"];


		// code reservation of the deleted user
		$delete_code_reservation_query = "DELETE FROM code_reservation WHERE id_user=?";
		query($delete_code_reservation_query, $id_user);

		// get all reservations of the deleted user
		$all_reservations_query = "SELECT id FROM reservation WHERE id_user=?";
		$reservations_id = query($all_reservations_query, $id_user);
		

		// remove any reservation
		$reservation_circuit_query = "DELETE FROM reservation_circuit WHERE id_reservation=?;";
		$reservation_voiture_query = "DELETE FROM reservation_voiture WHERE id_reservation=?;";
		$reservation_hotel_query = "DELETE FROM reservation_hotel WHERE id_reservation=?;";
		foreach ($reservations_id as $reservation_id) 
		{
			// delete any reservation in reservation_circuit
			query($reservation_circuit_query, $reservation_id["id"]);			
			// delete any reservation in reservation_hotel
			query($reservation_hotel_query, $reservation_id["id"]);
			// delete any reservation in reservation_voiture
			query($reservation_voiture_query, $reservation_id["id"]);
		}
		
		// delete the reservation
		$delete_reservations = "DELETE FROM reservation WHERE id_user=?";
		query($delete_reservations, $id_user);	

		// delete user
		$delete_user_query = "DELETE FROM users WHERE id=?";
		query($delete_user_query, $id_user);

		// delete all reservations of the delete user
		redirect("clients.php");
		exit;
	}



	// get admin
	$admin_query = "SELECT * FROM users WHERE id=?";
	$admin = query($admin_query, $_SESSION["connected_admin"])[0];


	// get all other users
	$users_query = "SELECT * FROM users WHERE id!=?";
	$result = query($users_query, $_SESSION["connected_admin"]);	

	$users = [];

	foreach ($result as $user) {
		

		if ($user["admin"] == 0)
			$user["admin"] = "Normal";
		else
			$user["admin"] = "Admin";


		$users[] = [
			"id" => $user["id"],
			"nom" => $user["nom"],
			"prenom" => $user["prenom"],
			"cin" => $user["CIN"],
			"adresse" => $user["adresse"],
			"admin" => $user["admin"],
			"user_name" => $user["user_name"],
			"password" => $user["password"]
		];
	}



	render_admin("clients.php", ["admin" => $admin, "users" => $users]);	

?>
