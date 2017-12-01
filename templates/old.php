 
    <div class="folderTab clearFix ">
          <h3>Reservations</h3>
     </div>
    <div class="botBorder clearFix ">
      <table class="cart">
        <thead>
          <tr>
            <th></th>
            <th>Product</th>
            <th class="numCell">Price</th>
            <th>Promotion</th>
            <th>Date</th>
            <th>Days</th>
            <th></th>
            <th class="numCell">Total</th>
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
                    <td><div class="button remove">X</div></td>
                    <td class="numCell">' . $voiure_reservation["total"] . 'DT</td>
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
                    <td><div class="button remove">X</div></td>
                    <td class="numCell">' . $hotel_reservation["total"] . 'DT</td>
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
                    <td><div class="button remove">X</div></td>
                    <td class="numCell">' . $circuit_reservation["total"] . 'DT</td>
                </tr>';
            }


          ?>

        </tbody>
      </table>
      <div class="wrap">
       <div class="button clear fleft">Clear Cart</div>
       <div class="button wish fright">Update Cart</div> 
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
        <div class="button add fright">Checkout</div>
        
      </div>
  
    </div>