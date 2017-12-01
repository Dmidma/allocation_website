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

			foreach ($voitures as $voiture)
			{
				echo '<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="fh5co-blog animate-box box">';
				
					if ($voiture["promo"] != 0)
						echo '<div class="ribbon ribbon-top-left"><span>Promo: ' . $voiture["promo"] . '%</span></div>';


				echo '<a href="voitures.php?voiture=' . $voiture["id"] . '"><img style="height: 200px;" class="img-responsive" src="' . $voiture["image"] . '" alt=""></a>
						<div class="blog-text">
							<div class="prod-title">
								<h3><a href="voitures.php?voiture=' . $voiture["id"] . '">' . $voiture["nom"] . '</a></h3>
								<span class="posted_by"><i class="icon-credit-card2"></i>  ' . $voiture["prix"] . 'DT</span>
								<span class="comment">' . $voiture["puissance"] . '<i class="icon-gears"></i></span>
								<p><span class="comment">' . $voiture["carburant"] . '<i class="icon-droplet"></i></span></p>
								<p><a href="voitures.php?voiture=' . $voiture["id"] . '#reserver">Reserver...</a></p>
							</div>
						</div> 
					</div>
				</div>';
			}

		?>

		</div>
	</div>
</div>

<div  id="fh5co-testimonial">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Promotions</h2>
				</div>
			</div>
			<div class="row">

			<?php

				foreach ($promotions as $promotion)
				{
					echo '<div class="col-md-4">
						<div class="box-testimony animate-box">
							<blockquote>
								<span class="quote"><span><i class="icon-pricetags"></i></span></span>
								<p>Promotion on <a style="color: black !important;" href="voitures.php?voiture=' . $promotion["id_voiture"] . '#reserver">' . $promotion["nom_voiture"] . '</a><br/>Created: <b>' . $promotion["date"] . '</b></p>
							</blockquote>
							<p class="author">' . $promotion["promo"] . '%</p>
						</div>
					</div>';
				}
			?>
			</div>
		</div>
</div>