<link rel="stylesheet" href="/maps/documentation/javascript/demos/demos.css">
<link rel="stylesheet" href="css/specific_hotel.css">


<div>
	<div class="fh5co-overlay"></div>
	<div class="container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3><?php echo $voiture["nom"]; ?></h3>
				<h4>Puissance: <?php echo $voiture["puissance"] ?><i class="icon-gears"></i></h4>
				<p><?php echo $voiture["description"]; ?> </p>
				<h4><i class="icon-credit-card2"></i><?php echo $voiture["prix"] ?>dt / Day</h4>
			</div>
		</div>

		<div class="row">
			<div class="animate-box" >

				
			
				<ul class="slides">

				<?php
					
					for ($i = 0; $i < count($voiture_imgs); $i++)
					{	

						$current = $i + 1;
						$prev = $current - 1;
						$next = $current + 1;

						if ($prev <= 0)
							$prev = count($voiture_imgs);

						if ($next > count($voiture_imgs))
							$next = 1;

						echo '<input type="radio" name="radio-btn" id="img-' . ($i + 1) . '" checked />
						    <li class="slide-container">
								<div class="slide">
									<img src="' . $voiture_imgs[$i]["image"] . '" />
						        </div>
								<div class="nav">
									<label for="img-' . $prev . '" class="prev">&#x2039;</label>
									<label for="img-' . $next . '" class="next">&#x203a;</label>
								</div>
						    </li>';
					}

					echo '<li class="nav-dots">';
					for ($i = 1; $i <= count($voiture_imgs); $i++)
					{
				      echo '<label for="img-' . $i .'" class="nav-dot" id="img-dot-' . $i . '"></label>';
					}
					echo '</li>';
				?>
			</ul>
			</div>
			<br />
			<br />
		</div>
	</div>
</div>



<div class="fh5co-hero" id="reserver">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5">
				<div class="desc">
					<div class="container">

				
					<?php if ($promo != 0): ?>
					<div class="badges"><br>
					    <p>
					        <span class="firstLine">GET</span><br>
					        <span class="secondLine">%<?php echo $promo;?></span><br>
					        <span class="thirdLine">Promotion</span><br>
					        <span class="fourthLine">Today</span>
					    </p>
					</div>
					<?php endif; ?>

					<?php if ($promo == 0): ?>

						<div style="height: 200px;"></div>

					<?php endif; ?>
						

						<div class="row">
							<div class="col-sm-5 col-md-5" style="margin-left: 20%; margin-right: auto; width: 50%;">
								<div class="tabulation animate-box">

								  <!-- Nav tabs -->
								   <ul class="nav nav-tabs" role="tablist" >

								      <li role="presentation" class="active" style="float: none !important;">
								    	   <a href="#hotels" aria-controls="hotels" role="tab" data-toggle="tab">Reservation</a>
								      </li>

								   </ul>

								   <!-- Tab panes -->
									<div class="tab-content">

									<form method="post" action="voitures.php">
									 <div role="tabpanel" class="tab-pane active" id="hotels">
									 	<div class="row">
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Date In:</label>
													<input type="text" name="date_in" class="form-control" id="date-start" placeholder="mm/dd/yyyy" required />
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Date Out:</label>
													<input type="text" name="date_out" class="form-control" id="date-end" placeholder="mm/dd/yyyy" required/>
												</div>
											</div>


											<input name="voiture_id" value="<?php echo $voiture["id"] ?>" style="display: none;"/>

											<?php if (isset($_GET["no"])): ?>
											<h4 style="color: red;"> Date erronée. Répéter la reservation.</h4>
											<?php endif; ?>
											<div class="col-xs-12">
												<input type="submit" class="btn btn-primary btn-block" value="Reserver">
											</div>
										</div>
									 </div>
									 </form>

								</div>
							</div>
							<div class="desc2 animate-box">
								<div class="col-sm-7 col-sm-push-1 col-md-7 col-md-push-1">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
</div>
