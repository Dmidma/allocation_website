<div id="fh5co-tours" class="fh5co-section-gray">
	<div id="map"></div>
	<div class="container">

		

		<?php if ($message === false): ?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3>Contactez Nous</h3>
				<p>Pour Plus d’informations ou pour un devis , n’hésitez pas à nous contacter via le formulaire ci-dessous.</p>
			</div>
		</div>

		
		<div class="row">
			<div class="tab-content">

					<form method="post" action="contact.php">
					 <div role="tabpanel" class="tab-pane active">
					 	<div class="row">
							<div class="col-sm-12 mt">
								<section>
									<label for="class">Nom:</label>
									<input type="text" name="nom" class="form-control" placeholder="Nom" required/>
								</section>
							</div>
							<div class="col-sm-12 mt">
								<section>
									<label for="class">Email:</label>
									<input type="email" name="email" class="form-control" placeholder="email" required/>
								</section>
							</div>
							<div class="col-sm-12 mt">
								<section>
									<label for="class">Sujet:</label>
									<input type="text" name="sujet" class="form-control" placeholder="Sujet" required/>
								</section>
							</div>
							<div class="col-sm-12 mt">
								<section>
									<label for="class">Message:</label>
									<textarea rows="7" type="textarea" name="message" class="form-control" placeholder="Message..." required></textarea>
								</section>
							</div>

							<div class="col-xs-12">
								<input type="submit" class="btn btn-primary btn-block" value="Contacter">
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
		<?php endif; ?>

		<?php if ($message === true): ?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
				<h3>Merci</h3>
				<p>Merci de nous avoir contacté.</p>
			</div>

		</div>

		<?php endif; ?>
</div>
<script>
	function initMap() {
    	// Create a map object and specify the DOM element for display.
    	var map = new google.maps.Map(document.getElementById('map'), {
      		center: {lat: 35.825780, lng: 10.641122},
      		scrollwheel: true,
      		zoom: 15
    	});

    	var marker = new google.maps.Marker({
          position: {lat: 35.825780, lng: 10.641122},
          animation: google.maps.Animation.DROP,
          map: map,
        });
  	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvAmtA3ZXI9EpDdj0Gh9ZBAMl_el75NUc&callback=initMap"
async defer></script>