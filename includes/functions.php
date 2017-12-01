<?php
	
	/**
	 * functions.php
	 *
	 * Essential and helper functions.
	 */
	
	require_once("constants.php");



	/**
	 * Function that will make a database connection, and then 
	 * executes the SQL query if valid.
	 * It will return an array of all rows in result set or 
	 * false on error.
	 */
	function query()
	{
		// SQL Statement
		$sql = func_get_arg(0);

		// Parameters, if any
		$parameters = array_slice(func_get_args(), 1);

		// try to connect to database
		static $handle;
		if (!isset($handle))
		{
			try
			{
				// connect to database
				$handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

				// ensure that PDO::prepare returns false when passed invalid SQL
				$handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch (Exception $e)
			{
				// trigger error and exit
				trigger_error($e->getMessage(), E_USER_ERROR);
				exit;
			}
		}

		// prepare SQL statement
		$statement = $handle->prepare($sql);
		if ($statement === false)
		{
			// trigger error and exit
			trigger_error($handle->errorInfo()[2], E_USER_ERROR);
			exit;
		}

		// execute SQL statement
		$results = $statement->execute($parameters);

		// return results set's rows, if any
		if ($results !== false)
		{
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			return false;
		}
	}


	/**
	 * Function that help debug on the JavaScript console.
	 * It will test if the data is an object or regular variable.
	 */
	function debug_to_console($data)
	{
		if (is_array($data) || is_object($data))
		{
			echo("<script>console.log('PHP console debuging:" . json_decode($data) . "');</script>");
		}
		else
		{
			echo("<script>console.log('PHP console debuging:" . $data . "');</script>");	
		}
	}

	/**
	 * Renders template, passing in values.
	 */
	function render($template, $values = [])
	{
		// if template exists, render it
		if (file_exists("../templates/$template"))
		{
			// extract variables into local scope
			extract($values);

			// render header
            require("../templates/header_user.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer_user.php");
		}
		else
		{
			trigger_error("Invalid template: $template", E_USER_ERROR);
		}
	}

	/**
	 * Renders template, passing in values.
	 */
	function render_admin($template, $values = [])
	{
		// if template exists, render it
		if (file_exists("../templates/$template"))
		{
			// extract variables into local scope
			extract($values);

			// render header
            require("../templates/header_admin.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer_admin.php");
		}
		else
		{
			trigger_error("Invalid template: $template", E_USER_ERROR);
		}
	}



	/**
	 * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
	 */
	function redirect($destination)
	{
		// handle URL
		if (preg_match("/^https?:\/\//", $destination))
		{
			header("Location: " . $destination);
		}

		// handle abolute path
		else if (preg_match("/^\//", $destination))
		{
			$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
			$host = $_SERVER["HTTP_HOST"];
			header("Location: $protocol://$host$destination");
		}

		// handle relative path
		{
			$protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
			$host = $_SERVER["HTTP_HOST"];
			$path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: $protocol://$host$path/$destination");
		}

		// exit immediately since we're redirecting anyway
		exit;
	}


	/**
	 * This function will download the image from the url and save it
	 * into the image_path.
	 * @param  String $url        The url of the image.
	 * @param  String $image_path The path of the image.
	 */
	function download_image($url, $image_path)
	{
    	file_put_contents($image_path, file_get_contents($url));
	}


	function download_image_into_dir($url, $image_name, $folder) 
	{
		// trim the url
		$url = trim($url);

		// get image format from the image url
		$image_format = array();
		preg_match("/\..{3}$/", $url, $image_format);

		// if no format was found exit with false
		if (!isset($image_format[0]))
		{
			return false;
		}


		// create the image's name
		$img = $image_name . strtolower($image_format[0]);

		// lowercase the letters of the img
		$img = strtolower($img);

		// replace any space or / by _
		$to_replace = array("/", " ");
		$img = str_replace($to_replace, "_", $img);

		// check the validity of the folder
		// TODO: comment this out on the server
		/*
		if (!file_exists($folder))
		{
			return false;
		}
		*/
		// Dahh !
		download_image($url, $folder . $img);

		// return the name of the image
		return $img;
	}



	function logout()
	{
		// unset any session variables
		$_SESSION = [];


		// destroy session
		session_destroy();
	}


	function connected_user() {
		$id = 0;
		// check if a user is connected
		if (isset($_SESSION["connected_user"]))
			$id = $_SESSION["connected_user"];


		
		$connected_user = true;
		if ($id == 0)
			$connected_user = false;
		else 
		{
			// get user name
			$connected_user = query("SELECT user_name FROM users WHERE id=?", $id)[0]["user_name"];
		}
		

		return $connected_user;
	}


	function generate_random_number($first, $last)
	{	

		$random_number = mt_rand();

		$middle = "{$first}{$random_number}{$last}";


		return $middle;
	}


	function delete_it($table_name, $id)
	{
		 
		$id_hotel = $id;

		// delete query of main subject
		$delete_query = "DELETE FROM " .  $table_name . " WHERE id=?;";

		// delete query of images
		$delete_query_imgs = "DELETE FROM " . $table_name . "_images WHERE id_" .  $table_name . "=?;";

		// delete query of promotions
		$delete_query_promos = "DELETE FROM promotion_" . $table_name . " WHERE id_" . $table_name . "=?;"; 

		// delete query of reservations
		$delete_query_reservation = "DELETE FROM reservation_" . $table_name . " WHERE id_" . $table_name . "=?;";

		// get id of reservations
		$ids_reservations_query = "SELECT id_reservation FROM reservation_" . $table_name . " WHERE id_" . $table_name ."=?;";
		$ids_reservations = query($ids_reservations_query, $id);

		/*
		// TODO: must get all images


		// get image path
		$image_path = query("SELECT image FROM hotel WHERE id=?;", $id_hotel)[0]["image"];

		// get only the last name
		$tmp_array = explode("/", $image_path);
		$only_name = end($tmp_array);
		// delete not the default image
		
		if (strcmp($only_name, "default_hotel.jpg") != 0)
		{	

			// set full path
			$full_path = "/var/www/html/pfe_web/final/public/" . $image_path;

			if (file_exists($full_path))
				unlink($full_path);
		}
		*/
		

			

		// execute queries
		query($delete_query_imgs, $id);
		query($delete_query_promos, $id);
		query($delete_query_reservation, $id);	
		query($delete_query, $id);

		$delete_reservation_code_query = "DELETE FROM code_reservation WHERE id_reservation=?;";
		$delete_reservation_query = "DELETE FROM reservation WHERE id=?;";
		foreach ($ids_reservations as $id_reservation) 
		{
			query($delete_reservation_code_query, $id_reservation["id_reservation"]);
			query($delete_reservation_query, $id_reservation["id_reservation"]);
		}
	}


	function delete_image($type, $id_image)
	{
		// query
		$prepare_query = "DELETE FROM " . $type . "_images WHERE id=?";

		query($prepare_query, $id_image);
	}


	function delete_reservation($type, $id_reservation)
	{
		// specifc reservation query
		$specifc_reservation_query = "DELETE FROM reservation_" . $type . " WHERE id_reservation=?;";

		// global reservation query
		$global_reservation_query = "DELETE FROM reservation WHERE id=?;";

		query($specifc_reservation_query, $id_reservation);
		query($global_reservation_query, $id_reservation);
	}

	function delete_all($id)
	{
		query("DELETE FROM reservation_hotel WHERE id_reservation=?;", $id);
		query("DELETE FROM reservation_voiture WHERE id_reservation=?;", $id);
		query("DELETE FROM reservation_circuit WHERE id_reservation=?;", $id);
		query("DELETE FROM code_reservation WHERE id_reservation=?;", $id);
		query("DELETE FROM reservation WHERE id=?;", $id);
	}
?>