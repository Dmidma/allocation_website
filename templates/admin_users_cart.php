<div class="box box-success">

<div class="box-header with-border">
  <h3 class="box-title">Users' Cart</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<form method="post" action="admin_client_cart.php">
<div class="box-body">
    
      <div class="form-group">
          <label>ID User</label>
          <select name="id_user" class="form-control">

            <!-- Load Uses id -->
            <?php
              foreach ($users as $user) {
                echo '<option value="' . $user["id"] . '">' . $user["id"] .  ': (' . $user["user_name"] . ')</option>';
              }
            ?>

          </select>
      </div>
</div>
<div class="box-footer">
  <button type="submit" class="btn btn-primary">Afficher panier</button>
</div>
</form>
</div>


<?php if ($cart): ?>
    <link rel="stylesheet" type="text/css" href="css/hotel_cart.css">

<div class="fh5co-section-gray">
  <div class="container">
    <div class="row animate-box">
		
		
	
    <div class="folderTab clearFix ">
          <h3>Reservations</h3>
     </div>
    <div class="botBorder clearFix ">
      <table class="cart">
        <thead>
          <tr>
            <th></th>
            <th>Produit</th>
            <th class="numCell">Prix</th>
            <th>Promotion</th>
            <th>Date</th>
            <th>Jours</th>
            <th class="numCell">Total</th>
            <th class="numCell">Code</th>
			<th>Supprimer</th>
          </tr>
        </thead>
        <tbody>

          <?php
            // print voitures
            foreach ($voiture_reservations as $voiure_reservation) 
            {
              echo '<tr>
                  <td><img style="max-width: 150px" src="' . $voiure_reservation["voiture_image"] . '"></td>
                    <td><a href="hotels.php?hotel=' . $voiure_reservation["voiture_id"] . '">' . $voiure_reservation["voiture_nom"] . '</a></td>
                  <td class="numCell">' . $voiure_reservation["voiture_prix"] . 'DT</td>
                  <td class="numCell">' . $voiure_reservation["promotion"] . '%</td>
                  <td class="numCell">' . $voiure_reservation["date_debut"] . '</td>
                  <td class="center">' . $voiure_reservation["nbr_jour"] . '</td>
                    <td class="numCell">' . $voiure_reservation["total"] . 'DT</td>
                    <td class="numCell">' . $voiure_reservation["code"] . '</td>
					<td><button type="button" class="btn btn-block btn-danger">Supprimer</button></td>
                </tr>';
            }

            // print hotels
            foreach ($hotel_reservations as $hotel_reservation) 
            {
              echo '<tr>
                  <td><img style="max-width: 150px" src="' . $hotel_reservation["hotel_image"] . '"></td>
                    <td><a href="hotels.php?hotel=' . $hotel_reservation["hotel_id"] . '">' . $hotel_reservation["hotel_nom"] . '</a></td>
                  <td class="numCell">' . $hotel_reservation["hotel_price_night"] . 'DT</td>
                  <td class="numCell">' . $hotel_reservation["promotion"] . '%</td>
                  <td class="numCell">' . $hotel_reservation["date_debut"] . '</td>
                  <td class="center">' . $hotel_reservation["nbr_jour"] . '</td>
                    <td class="numCell">' . $hotel_reservation["total"] . 'DT</td>
                    <td class="numCell">' . $hotel_reservation["code"] . '</td>
					<td><button type="button" class="btn btn-block btn-danger">Supprimer</button></td>
                </tr>';
            }

            // print circuit
            foreach ($circuit_reservations as $circuit_reservation) 
            {
              echo '<tr>
                  <td><img style="max-width: 150px" src="' . $circuit_reservation["circuit_image"] . '"></td>
                    <td><a href="hotels.php?hotel=' . $circuit_reservation["circuit_id"] . '">' . $circuit_reservation["circuit_nom"] . '</a></td>
                  <td class="numCell">' . $circuit_reservation["circuit_prix"] . 'DT</td>
                  <td class="numCell">' . $circuit_reservation["promotion"] . '%</td>
                  <td class="numCell">' . $circuit_reservation["date_debut"] . '</td>
                  <td class="center">' . $circuit_reservation["nbr_jour"] . '</td>

                    <td class="numCell">' . $circuit_reservation["total"] . 'DT</td>
                    <td class="numCell">' . $circuit_reservation["code"] . '</td>
					<td><button type="button" class="btn btn-block btn-danger">Supprimer</button></td>
                </tr>';
            }


          ?>

        </tbody>
      </table>
      <div class="wrap">
      </div>
      <div class="totals">
        <table class="totaler">
          <tbody>
            <tr>
              <td>Subtotal</td>
              <td><?php echo $subtotal; ?>TD</td>
            </tr>
            <tr>
              <td>Promotions</td>
              <td><?php echo $promotions; ?>TD</td>
            </tr>
            <tr>
              <td>Estimated Total</td>
              <td><?php echo $subtotal - $promotions; ?>TD</td>
            </tr>
          </tbody>
        </table>

        
      </div>
  
    </div>
            
  </div>
</div>

</div>


<?php endif; ?>