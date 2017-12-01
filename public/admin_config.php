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



	// changing one of the three parameters
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

		// if we are changing the admin name
		if (isset($_POST["new_admin_name"]))
		{

			// change admin name
			$new_admin_name = $_POST["new_admin_name"];
			$admin_change_query = "UPDATE users SET user_name = ? WHERE id = ?";
			query($admin_change_query, $new_admin_name, $_SESSION["connected_admin"]);

			// refresh page
			redirect("admin_config.php");
			exit;
		}
		else if (isset($_POST["new_admin_password"]))
		{	
			// change admin name
			$new_admin_password = $_POST["new_admin_password"];
			$admin_change_query = "UPDATE users SET password = ? WHERE id = ?";
			query($admin_change_query, $new_admin_password, $_SESSION["connected_admin"]);

			// refresh page
			redirect("admin_config.php");
			exit;
		}
		else if (isset($_FILES["new_admin_image"]))
		{
			

			// change image
			
			$target_dir = "/var/www/html/pfe_web/public/";

			

			// get name of the current hotel
			$admin["id"];
			$admin["user_name"];
			
			// must append a number to the new image name


	
			// get image name
			$image_name = basename($_FILES["new_admin_image"]["name"]);

			// get extension
			$tmp_array = explode(".", $image_name);
			$extension = end($tmp_array);

			// set_image_name
			$image_name = $admin["user_name"] . $admin["id"];

		

			// set the right image name
			$image_name  = $image_name . "." . $extension;


			// at this point set image
			$image = "images/admin/" . $image_name;


			// update image for admin
			$update_image_query = "UPDATE users SET image=? WHERE id=?;";

			query($update_image_query, $image, $admin["id"]);


			// target file
			$target_file = $target_dir . $image;
			
			// upload the image to server
			$done_upload = move_uploaded_file($_FILES["new_admin_image"]["tmp_name"], $target_file);


			redirect("admin.php");
			exit;
		}	
	}




	render_admin("admin_config.php", ["admin" => $admin]);	

?>