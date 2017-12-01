<link rel="stylesheet" href="css/search_bar.css">

<div class="fh5co-section-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3>Hotels</h3>
			</div>
		</div>

		<div class="row">
			<form class="searchform cf animate-box" method="post" action="hotels.php">
  				<input type="text" name="search" placeholder="Search Hotel or Place" required>
  				<button type="submit">Search</button>
			</form>
			<br/>
			<br/>
		</div>


		<div class="row">

		<?php

			foreach ($hotels as $hotel)
			{
				echo '<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="fh5co-blog animate-box box">';

				if ($hotel["promo"] != 0)
					echo '<div class="ribbon ribbon-top-left"><span>Promo: ' . $hotel["promo"] . '%</span></div>';

				echo' <a href="hotels.php?hotel=' . $hotel["id"] . '"><img style="height: 200px;" class="img-responsive" src="' . $hotel["image"] . '" alt=""></a>
						<div class="blog-text">
							<div class="prod-title">
								<h3><a href="hotels.php?hotel=' . $hotel["id"] . '">' . $hotel["nom"] . '</a></h3>
								<span class="comment">' . $hotel["stars"] . '<i class="icon-star"></i></span>
								<br>
								<i class="icon-credit-card2"></i> 
								<br>
								<span class="">  ' . $hotel["price_night"] . 'DT All Inclusive</span>
								
								<span class=""> ' . $hotel["price_night"] * 0.5 . 'DT Demi-Pension</span>
								
								<span class=""> ' . $hotel["price_night"] * 0.25 . 'DT Petit-déjeuner</span>
								<p><a href="hotels.php?hotel=' . $hotel["id"] . '#reserver">Reserver...</a></p>
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
								<p>Promotion on <a style="color: black !important;" href="hotels.php?hotel=' . $promotion["id_hotel"] . '#reserver">' . $promotion["nom_hotel"] . '</a><br/>Created: <b>' . $promotion["date"] . '</b></p>
							</blockquote>
							<p class="author">' . $promotion["promo"] . '%</p>
						</div>
					</div>';
				}
			?>
			</div>
		</div>
</div>