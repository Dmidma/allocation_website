
		<!-- end:header-top -->
	<link rel="stylesheet" href="css/style2.css">
		<div class="fh5co-hero">
			<div class="fh5co-overlay"></div>
			<div class="fh5co-cover" data-stellar-background-ratio="0.5" >
				<div class="desc">
					<div class="container">
						<div class="row" style="margin-top: -60px;">
							<div class="col-sm-5 col-md-5">
								<div class="tabulation animate-box">


								   <!-- Tab panes -->
									<div class="tab-content">
									 <div role="tabpanel" class="tab-pane active" id="flights">
										<div class="row" style="margin-top: -50px;">
											<form method="post" action="signup.php">
											<div class="col-sm-12 mt">
												<section>
													<label for="class">nom:</label><div class="after_label"></div>
													<input type="text" name="nom" placeholder="Nom" required>
												</section>
											</div>

											<div class="col-sm-12 mt">
												<section>
													<label for="class">Prenom:</label><div class="after_label"></div>
													<input type="text" name="prenom" placeholder="Prenom" required>
												</section>
											</div>

											<div class="col-sm-12 mt">
												<section>
													<label for="class">CIN:</label><div class="after_label"></div>
													<input type="text" name="cin" placeholder="CIN" required>
												</section>
											</div>
											
											<div class="col-sm-12 mt">
												<section>
													<label for="class">Tel:</label><div class="after_label"></div>
													<input type="text" name="num_tel" placeholder="Tel" required>
												</section>
											</div>

											<div class="col-sm-12 mt">
												<section>
													<label for="class">Adresse:</label><div class="after_label"></div>
													<input type="text" name="adresse" placeholder="Adresse" required>
												</section>
											</div>
											<div class="col-sm-12 mt">
												<section>
													<label for="class">Username:</label><div class="after_label"></div>
													<input type="text" name="username" placeholder="Username" required>
												</section>
											</div>
											<div class="col-sm-12 mt">
												<section>
													<label for="class">Password:</label><div class="after_label"></div>
													<input type="password" name="password" placeholder="Password" required>
												</section>
											</div>
											<div class="col-sm-12 mt">
												<section>
													<label for="class">Confirm:</label><div class="after_label"></div>
													<input type="password" name="confirm" placeholder="Confirmation" required>
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


											<div class="col-xs-12">
												<input type="submit" class="btn btn-primary btn-block" value="Sign Up">
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