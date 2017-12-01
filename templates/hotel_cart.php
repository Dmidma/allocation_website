<link rel="stylesheet" type="text/css" href="css/hotel_cart.css">

<div class="fh5co-section-gray">
  <div class="container">
    <div class="row animate-box">

    <?php if(count($reservations) == 0): ?>

      <h3 style="height: 200px; margin-top: 100px; text-align: center;">Pas de reservations encore.</h3>

    <?php endif; ?>

    <?php if (count($reservations) >= 1): ?>


    <div class="folderTab clearFix ">
          <h3>Reservation Hotel</h3>
     </div>
    <div class="botBorder clearFix ">
      <table class="cart">
        <thead>
          <tr>
            <th></th>
            <th>Hotel</th>
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

            foreach ($reservations as $reservation) 
            {
              echo '<tr>
                  <td><img style="max-width: 150px" src="' . $reservation["hotel_image"] . '"></td>
                    <td><a href="hotels.php?hotel=' . $reservation["hotel_id"] . '">' . $reservation["hotel_nom"] . '</a></td>
                  <td class="numCell">' . $reservation["hotel_price_night"] . 'DT</td>
                  <td class="numCell">' . $reservation["promotion"] . '%</td>
                  <td class="numCell">' . $reservation["date_debut"] . '</td>
                  <td class="center">' . $reservation["nbr_jour"] . '</td>
                    <td><a href="?delete=' . $reservation["reservartion_id"] . '"><div class="button remove">X</div></a></td>
                    <td class="numCell">' . $reservation["total"] . 'DT</td>
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
        <a href="hotel_cart.php?generate_code=oui"><div class="button add fright">Generer Codes</div></a>
        
      </div>
  
    </div>
     <?php endif; ?>       
  </div>
</div>

</div>
