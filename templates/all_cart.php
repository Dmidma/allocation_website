<link rel="stylesheet" type="text/css" href="css/hotel_cart.css">

<div class="fh5co-section-gray">
  <div class="container">
    <div class="row animate-box">

      <?php if(count($codes) == 0): ?>

      <h3 style="height: 200px; margin-top: 100px; text-align: center;">Pas de codes encore.</h3>

    <?php endif; ?>

    <?php if (count($codes) >= 1): ?>


    <div class="folderTab clearFix ">
          <h3>Codes</h3>
     </div>
    <div class="botBorder clearFix ">
      <table class="cart">
        <thead>
          <tr>
            <th></th>
            <th>Nom</th>
            <th class="numCell">Prix</th>
            <th>Code</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
          foreach ($codes as $code) 
            {
              echo '<tr>
                  <td></td>
                  <td class="numCell">' . $code["nom"] . '</td>
                  <td class="numCell">' . $code["prix"] . 'dt</td>
                  <td class="numCell">' . $code["code"] . '</td>                
                    <td><a href="?delete=' . $code["id_reservation"] . '"><div class="button remove">X</div></a></td>
                </tr>';
            }
        ?>


        </tbody>
      </table>

  
    </div>

    <?php endif; ?> 
  </div>
</div>

</div>
