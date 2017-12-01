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
		// get circuit id 
		$id_circuit = $_GET["delete"];

		delete_it("circuit", $id_circuit);

		redirect("admin_modify_circuit.php");
		exit;
	}


	// get all circuits
	$circuits_query = "SELECT * FROM circuit;";
	$result = query($circuits_query);	

	$circuits = [];

	foreach ($result as $circuit) {
		

		$circuits[] = [
			"id" => $circuit["id"],
			"nom" => $circuit["nom"],
			"plan" => $circuit["plan"],
			"depart" => $circuit["depart"],
			"date_depart" => $circuit["date_depart"],
			"date_arrive" => $circuit["date_arrive"],
			"prix" => $circuit["prix"],
			"description" => $circuit["description"]
		];
	}


	render_admin("circuits_admin.php", ["admin" => $admin, "circuits" => $circuits]);
?>