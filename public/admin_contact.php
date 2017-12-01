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



	if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["to_delete"]))
	{
		$delete_query = "DELETE FROM contactez_nous WHERE id=?;";
		query($delete_query, $_GET["to_delete"]);
		redirect("admin_contact.php");
		exit;	
	}


	// get all other users
	$contacts_query = "SELECT * FROM contactez_nous;";
	$result = query($contacts_query);	


	render_admin("admin_contact.php", ["admin" => $admin, "contacts" => $result]);	

?>