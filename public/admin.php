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

	


	render_admin("admin.php", ["admin" => $admin]);	

?>