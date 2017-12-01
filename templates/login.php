
		<!-- end:header-top -->
	<link rel="stylesheet" href="css/style2.css">
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" style="background-image: url(images/cover_bg_1.jpg);">
				<div class="desc">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-md-5">
								<div class="tabulation animate-box">


								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row">
											<form method="post" action="login.php">
											<div class="col-sm-12 mt">
												<section>
													<label for="class">Username:</label>
													<input type="text" name="username" placeholder="Username" required>
												</section>
											</div>
											<div class="col-sm-12 mt">
												<section>
													<label for="class">Password:</label>
													<input type="password" name="password" placeholder="Password" required>
												</section>
											</div>
											<h6>
											<?php
												if (isset($message))
												{
													echo htmlspecialchars($message);
												}
											?>
											</h6>

											<a href="signup.php">Sign-up Maybe?</a>

											<div class="col-xs-12">
												<input type="submit" class="btn btn-primary btn-block" value="Login">
											</div>
										</div>
										</form>
									 </div>

									</div>

								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>

		</div>
		
		<footer>
			<div id="footer">
				<div class="container">
					
			</div>
		</footer>

	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

	<!-- jQuery -->


	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/sticky.js"></script>

	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- CS Select -->
	<script src="js/classie.js"></script>
	<script src="js/selectFx.js"></script>
	
	<!-- Main JS -->
	<script src="js/main.js"></script>

	</body>
</html>

