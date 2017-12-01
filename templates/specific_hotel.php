<link rel="stylesheet" href="/maps/documentation/javascript/demos/demos.css">
<link rel="stylesheet" href="css/specific_hotel.css">
<div>
	<div class="fh5co-overlay"></div>
	<div class="container">

		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3><?php echo $hotel["nom"]; ?></h3>
				<h4><?php echo $hotel["stars"] ?><i class="icon-star"></i></h4>
				<p><?php echo $hotel["description"]; ?> </p>
				<h4><i class="icon-credit-card2"></i><?php echo $hotel["price_night"] ?>dt / night</h4>
			</div>
		</div>

		<div class="row">
			<div class="animate-box" >
				<ul class="slides">

				<?php
					
					for ($i = 0; $i < count($hotel_imgs); $i++)
					{	

						$current = $i + 1;
						$prev = $current - 1;
						$next = $current + 1;

						if ($prev <= 0)
							$prev = count($hotel_imgs);

						if ($next > count($hotel_imgs))
							$next = 1;

						echo '<input type="radio" name="radio-btn" id="img-' . ($i + 1) . '" checked />
						    <li class="slide-container">
								<div class="slide">
									<img src="' . $hotel_imgs[$i]["image"] . '" />
						        </div>
								<div class="nav">
									<label for="img-' . $prev . '" class="prev">&#x2039;</label>
									<label for="img-' . $next . '" class="next">&#x203a;</label>
								</div>
						    </li>';
					}

					echo '<li class="nav-dots">';
					for ($i = 1; $i <= count($hotel_imgs); $i++)
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


<div class="fh5co-section-gray">

	<div class="container">
	<div class="col-md-8 col-md-offset-2 text-center animate-box">
		<h4>Location:</h4>
	</div>
	<div id="map"></div>
	<br />
	<br />
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

									<form method="post" action="hotels.php">
									 <div role="tabpanel" class="tab-pane active" id="hotels">
									 	<div class="row">
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-start">Date d'arrivée:</label>
													<input type="text" id="date-start" name="check_in" class="form-control"  placeholder="mm/dd/yyyy" required />
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<div class="input-field">
													<label for="date-end">Date de sortie:</label>
													<input type="text"  id="date-end" name="check_out" class="form-control"  placeholder="mm/dd/yyyy" required/>
												</div>
											</div>
											<div class="col-xxs-12 col-xs-6 mt alternate">
												<section>
													<label for="class">Nombre des chambres:</label>
													<input type="number" name="rooms" class="form-control" placeholder="Numbr of Rooms" required/>
												</section>
											</div>

											<div class="col-sm-12 mt">
												<section>
													<label for="class">Pension:</label>
													<select class="cs-select cs-skin-border" name="pension" required>
							                            <option value="Pension complete">Pension complète <?php echo $hotel["price_night"] ?>dt</option>
							                            <option value="Demi-pension">Demi-pension <?php echo $hotel["price_night"] * 0.5 ?>dt</option>
							                            <option value="Petit-dejeuner">Petit-déjeuner <?php echo $hotel["price_night"] * 0.25?>dt</option>
							                          </select>
							                        </section>
											</div>

											<input name="hotel_id" value="<?php echo $hotel["id"] ?>" style="display: none;"/>
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

<script>
	function initMap() {
    	// Create a map object and specify the DOM element for display.
    	var map = new google.maps.Map(document.getElementById('map'), {
      		center: {lat: 34.503706, lng: 9.522539}, // default Tunisia coordinates
      		scrollwheel: false,
      		zoom: 8
    	});
    	

    	<?php if (isset($hotel["latitude"]) && isset($hotel["longitude"])): ?>

							

    	var marker = new google.maps.Marker({
          position: {lat: <?php echo $hotel["latitude"]; ?>, lng: <?php echo $hotel["longitude"]; ?>},
          map: map,
          title: "Click to zoom"
        });
    	// change to marker position
    	map.panTo(marker.getPosition());

    	map.addListener('center_changed', function() {
		    // 3 seconds after the center of the map has changed, pan back to the
		    // marker.
		    window.setTimeout(function() {
		      map.panTo(marker.getPosition());
		    }, 3000);
		 });

    	marker.addListener('click', function() {
    		map.setZoom(15);
    		map.setCenter(marker.getPosition());
  		});

    	<?php endif; ?>
  	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvAmtA3ZXI9EpDdj0Gh9ZBAMl_el75NUc&callback=initMap"
async defer></script>