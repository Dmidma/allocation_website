<link rel="stylesheet" href="css/search_bar.css">

<div class="fh5co-section-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3>Hotels</h3>
				<p></p>
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


			if (count($hotels) == 0)
				echo '<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h4>Nothing Found!</h4>
					</div>';
			else
			{	

				echo '<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h4>Result for search: "' . $query . '"</h4>
					</div>';

				foreach ($hotels as $hotel)
				{
					echo '<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="fh5co-blog animate-box">
							<a href="hotels.php?hotel=' . $hotel["id"] . '"><img class="img-responsive" src="' . $hotel["image"] . '" alt=""></a>
							<div class="blog-text">
								<div class="prod-title">
									<h3><a href="hotels.php?hotel=' . $hotel["id"] . '">' . $hotel["nom"] . '</a></h3>
									<span class="posted_by">' . $hotel["adresse"] . '</span>
									<span class="comment">' . $hotel["stars"] . '<i class="icon-star"></i></span>
									<p><a href="hotels.php?hotel=' . $hotel["id"] . '#reserver">Reserver...</a></p>
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
