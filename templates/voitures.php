<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Voitures</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Marque</th>
                    <th>Puissance</th>
                    <th>Carburant</th>
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Gallerie Images</th>
                    <th>Supprimer</th>
					<th>Modifier</th>
                  </tr>
                  </thead>
                  <tbody>



                  <?php
                  
                    foreach ($voitures as $voiture) 
                    {
                      echo "<tr>";
                      echo "<td>". $voiture["id"] . "</td>";

                      echo "<td>". $voiture["nom"] . "</td>";
                      echo "<td>". $voiture["marque"] . "</td>";
                      echo "<td>". $voiture["puissance"] . "</td>";
                      echo "<td>". $voiture["carburant"] . "</td>";


                      echo "<td>". $voiture["prix"] . "</td>";
                      echo "<td>". $voiture["description"] . "</td>";
                      echo '<td><a href="admin_images_voiture.php?id_voiture=' . $voiture["id"] . '"><button type="button" class="btn btn-block btn-danger" style="background-color: blue;">Gallerie</button></a></td>';
                      echo '<td><a href="?delete=' . $voiture["id"] . '"><button type="button" class="btn btn-block btn-danger">Delete</button></a></td>';
					  echo '<td><a href="admin_add_voiture.php?modify=' . $voiture["id"] . '"><button type="button" class="btn btn-block btn-danger" style="background-color: green;">Modifier</button></a></td>';
                      echo "</tr>";
                    }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>