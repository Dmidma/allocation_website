







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
			echo '<div class="callout callout-success">
			  	<h4><i style="margin-right: 30px" class="icon fa fa-check"></i>' . $hotel_promo["nom_hotel"] . ": (ID:" . $hotel_promo["id_hotel"] . ')</h4>
			  <div class="row">
				  
				  <p style="margin-left: 20px">This Hotel is having a <b>' . $hotel_promo["promo"] . '%</b> promotion. Created on: ' . $hotel_promo["date_deb_promotion"] . '</p>
				  <a href="?type=hotel&stop=' . $hotel_promo["id"] . '"><button type="button" class="btn btn-block btn-warning">Stop</button></a>
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
			echo '<div class="callout callout-success">
			  	<h4><i style="margin-right: 30px" class="icon fa fa-check"></i>' . $voiture_promo["nom_voiture"] . ": (ID:" . $voiture_promo["id_voiture"] . ')</h4>
			  <div class="row">
				  
				  <p style="margin-left: 20px">This Car is having a <b>' . $voiture_promo["promo"] . '%</b> promotion. Created on: ' . $voiture_promo["date_deb_promotion"] . '</p>	
				  <a href="?type=voiture&stop=' . $voiture_promo["id"] . '"><button type="button" class="btn btn-block btn-warning">Stop</button></a>
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
			echo '<div class="callout callout-success">
			  	<h4><i style="margin-right: 30px" class="icon fa fa-check"></i>' . $circuit_promo["nom_circuit"] . ": (ID:" . $circuit_promo["id_circuit"] . ')</h4>
			  <div class="row">
				  
				  <p style="margin-left: 20px">This Hotel is having a <b>' . $circuit_promo["promo"] . '%</b> promotion. Created on: ' . $circuit_promo["date_deb_promotion"] . '</p>
				  <a href="?type=circuit&stop=' . $circuit_promo["id"] . '"><button type="button" class="btn btn-block btn-warning">Stop</button></a>
			  </div>
			</div>';
		}
	?>

</div>
</div>
