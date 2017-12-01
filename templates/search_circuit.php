<link rel="stylesheet" href="css/search_bar.css">

<div class="fh5co-section-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3>Circuit</h3>
				<p></p>
			</div>
		</div>

		<div class="row">
			<form class="searchform cf animate-box" method="post" action="circuits.php">
  				<input type="text" name="search" placeholder="Search Circuit or Depart or Plan" required>
  				<button type="submit">Search</button>
			</form>
			<br/>
			<br/>
		</div>


		<div class="row">

		<?php


			if (count($circuits) == 0)
				echo '<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h4>Nothing Found!</h4>
					</div>';
			else
			{	

				echo '<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<h4>Result for search: "' . $query . '"</h4>
					</div>';

				foreach ($circuits as $circuit)
				{
					echo '<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="fh5co-blog animate-box">
						<a href="circuits.php?circuit=' . $circuit["id"] . '"><img style="height: 200px;" class="img-responsive" src="' . $circuit["image"] . '" alt=""></a>
						<div class="blog-text">
							<div class="prod-title">
								<h3><a href="circuits.php?circuit=' . $circuit["id"] . '">' . $circuit["nom"] . '</a></h3>
								<span class="posted_by"><i class="icon-credit-card2"></i>  ' . $circuit["prix"] . 'DT</span>
								<span class="comment">' . $circuit["depart"] . '  <i class="icon-flag"></i></span>	
								<p><a href="circuits.php?circuit=' . $circuit["id"] . '#reserver">Reserver...</a></p>
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
