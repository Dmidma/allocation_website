<script src="js/jquery.min.js"></script>

<style type="text/css">
	#slideshow {
  width: 100%;
  height: 240px;
}



#slideshow img {
	width: 100%;
	height: 500px;
}

</style>
<link href="https://fonts.googleapis.com/css?family=Mogra" rel="stylesheet"> 
	
		<div class="fh5co-hero" style="height: 500px;">
					<div class="container" style="width: 100%;">
						<div class="row" style="width: 100%;">

						<div id="slideshow">
						<?php
							foreach ($img_array as $img) 
							{
								echo '<div>
							     	<img src="' . $img . '">
							   		</div>';	
							}
						?>
						</div>	
							   
					</div>



						

</div>
		</div>
		
		<div id="wel" style="display: block; position: absolute; top: 8%; left: 20%;"><h2 style="color: white; font-size: 40px; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; font-family: 'Mogra', cursive; text-align: center;">Reservez votre vacances de rêve avec <br>TuniWin.</h2></div>
		
		<!-- Append the name of the image in "public/images/" to "background-image" -->
		<div id="fh5co-tours" class="fh5co-section-gray" style="background-image: url(images/hotel_home.jpg);">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Hotels</h3>
					</div>
				</div>
				<div class="row">

				<?php
					foreach ($hotels as $hotel)
					{
						echo '<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="fh5co-blog animate-box box">';


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
										<a class="btn btn-primary btn-outline" href="hotels.php?hotel=' . $hotel["id"] . '">Voir<i class="icon-arrow-right22"></i></a>
									</div>
								</div> 
							</div>
						</div>';
					}
				?>



					<div class="col-md-12 text-center animate-box">
						<p><a class="btn btn-primary btn-outline btn-lg" href="hotels.php">Tout nos offres <i class="icon-arrow-right22"></i></a></p>
					</div>
				</div>
			</div>
		</div>

		<div id="fh5co-destination">
			<div class="tour-fluid">
				<div class="row">
					<div class="col-md-12">
						<ul id="fh5co-destination-list" class="animate-box">

							<?php
								$i = 1;
								foreach ($circuit_depart as $depart) 
								{
									echo '<li class="one-forth text-center" style="background-image: url(images/place-' . $i . '.jpg); ">
										<a href="index.php?depart=' . $depart . '">
											<div class="case-studies-summary">
												<h2>' . $depart . '</h2>
											</div>
										</a>
									</li>';


									if ($i == 5)
									{
										echo '<li class="one-half text-center">
											<div class="title-bg">
												<div class="case-studies-summary">
													<h2>Les destinations les plus populaire.</h2>
													<span><a href="circuits.php">Voir tous les destinations</a></span>
												</div>
											</div>
										</li>';
									}

									$i++;
								}
							?>
						</ul>		
					</div>
				</div>
			</div>
		</div>
		
		<!-- Append the name of the image in "public/images/" to "background-image" -->
		<div id="fh5co-blog-section" class="fh5co-section-gray" style="background-image: url(images/voiture_home.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
						<h3>Voiture</h3>
						<p>Vous pouvez reserver votre voiture de reve.</p>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row row-bottom-padded-md">


				<?php

					foreach ($voitures as $voiture)
					{
						echo '<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="fh5co-blog animate-box box">';


						echo '<a href="voitures.php?voiture=' . $voiture["id"] . '"><img style="height: 200px;" class="img-responsive" src="' . $voiture["image"] . '" alt=""></a>
								<div class="blog-text">
									<div class="prod-title">
										<h3><a href="voitures.php?voiture=' . $voiture["id"] . '">' . $voiture["nom"] . '</a></h3>
										<span class="posted_by"><i class="icon-credit-card2"></i>  ' . $voiture["prix"] . 'DT</span>
										<span class="comment">' . $voiture["puissance"] . '<i class="icon-gears"></i></span>
										<p><span class="comment">' . $voiture["carburant"] . '<i class="icon-droplet"></i></span></p>
										<a class="btn btn-primary btn-outline" href="voitures.php?voiture=' . $voiture["id"] . '">Voir<i class="icon-arrow-right22"></i></a>
									</div>
								</div> 
							</div>
						</div>';
					}

				?>



					<div class="clearfix visible-md-block"></div>
				</div>

				<div class="col-md-12 text-center animate-box">
					<p><a class="btn btn-primary btn-outline btn-lg" href="voitures.php">Tout nos offres <i class="icon-arrow-right22"></i></a></p>
				</div>

			</div>
		</div>

<script type="text/javascript">
	$("#slideshow > div:gt(0)").hide();

setInterval(function() {
  $('#slideshow > div:first')
    .fadeOut(1)
    .next()
    .fadeIn(1)
    .end()
    .appendTo('#slideshow');
}, 5000);
</script>