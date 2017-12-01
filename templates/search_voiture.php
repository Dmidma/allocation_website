<link rel="stylesheet" href="css/search_bar.css">

<div class="fh5co-section-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3>Voitures</h3>
				<p></p>
			</div>
		</div>

		<div class="row">
			<form class="searchform cf animate-box" method="post" action="voitures.php">
  				<input type="text" name="search" placeholder="Search Voiture or Marque or Carburant" required>
  				<button type="submit">Search</button>
			</form>
			<br/>
			<br/>
		</div>


		<div class="row">

		<?php


			if (count($voitures) == 0)
				echo '<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h4>Nothing Found!</h4>
					</div>';
			else
			{	

				echo '<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h4>Result for search: "' . $query . '"</h4>
					</div>';

				foreach ($voitures as $voiture)
				{
					echo '<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="fh5co-blog animate-box">
						<a href="voitures.php?voiture=' . $voiture["id"] . '"><img class="img-responsive" src="' . $voiture["image"] . '" alt=""></a>
						<div class="blog-text">
							<div class="prod-title">
								<h3><a href="voitures.php?voiture=' . $voiture["id"] . '">' . $voiture["nom"] . '</a></h3>
								<span class="posted_by">' . $voiture["marque"] . '</span>
								<span class="comment">' . $voiture["puissance"] . '<i class="icon-gears"></i></span>
								<p><span class="comment">' . $voiture["carburant"] . '<i class="icon-droplet"></i></span></p>
								<p><a href="voitures.php?voiture=' . $voiture["id"] . '#reserver">Reserver...</a></p>
							</div>
						</div> 
					</div>
				</div>';
				}
			}
		?>

		</div>
	</div>
</div>
