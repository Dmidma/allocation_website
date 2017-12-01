







<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">Hotel</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>

<div class="box-body">



	<?php
		foreach ($hotels_promos as $hotel_promo)
		{
			echo '<div class="callout callout-warning">
			  	<h4><i style="margin-right: 30px" class="icon fa fa-close"></i>' . $hotel_promo["nom_hotel"] . ": (ID:" . $hotel_promo["id_hotel"] . ')</h4>
			  <div class="row">
				  
				  <p style="margin-left: 20px">This Hotel had a <b>' . $hotel_promo["promo"] . '%</b> promotion. Created on: ' . $hotel_promo["date_deb_promotion"] . '. Closed on: ' . $hotel_promo["date_fin_promotion"] . '</p>
			  </div>
			</div>';
		}
	?>

</div>
</div>





<div class="box box-danger">

<div class="box-header with-border">
  <h3 class="box-title">Voitures</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>

<div class="box-body">

 
	<?php
		foreach ($voitures_promos as $voiture_promo)
		{
			echo '<div class="callout callout-warning">
			  	<h4><i style="margin-right: 30px" class="icon fa fa-close"></i>' . $voiture_promo["nom_voiture"] . ": (ID:" . $voiture_promo["id_voiture"] . ')</h4>
			  <div class="row">
				  
				  <p style="margin-left: 20px">This Car had a <b>' . $voiture_promo["promo"] . '%</b> promotion. Created on: ' . $voiture_promo["date_deb_promotion"] . '. Closed on: ' . $voiture_promo["date_fin_promotion"] . '</p>
			  </div>
			</div>';
		}
	?>
    
      
</div>
</div>



<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">Circuit</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>

<div class="box-body">



	<?php
		foreach ($circuits_promos as $circuit_promo)
		{
			echo '<div class="callout callout-warning">
			  	<h4><i style="margin-right: 30px" class="icon fa fa-close"></i>' . $circuit_promo["nom_circuit"] . ": (ID:" . $circuit_promo["id_circuit"] . ')</h4>
			  <div class="row">
				  
				  <p style="margin-left: 20px">This Hotel had a <b>' . $circuit_promo["promo"] . '%</b> promotion. Created on: ' . $circuit_promo["date_deb_promotion"] . '. Closed on: ' . $circuit_promo["date_fin_promotion"] . '</p>
			  </div>
			</div>';
		}
	?>

</div>
</div>