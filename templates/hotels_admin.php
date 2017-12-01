<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Hotels</h3>

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
                    <th>Stars</th>
                    <th>Adresse</th>
                    <th>Description</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Gallerie Images</th>
                    <th>Supprimer</th>
					<th>Modifier</th>
                  </tr>
                  </thead>
                  <tbody>



                  <?php
                  
                    foreach ($hotels as $hotel) 
                    {
                      echo "<tr>";
                      echo "<td>". $hotel["id"] . "</td>";

                      echo "<td>". $hotel["nom"] . "</td>";
                      echo "<td>". $hotel["star"] . "</td>";
                      echo "<td>". $hotel["adresse"] . "</td>";
                      echo "<td>". $hotel["description"] . "</td>";


                      echo "<td>". $hotel["latitude"] . "</td>";
                      echo "<td>". $hotel["longitude"] . "</td>";
                      // echo '<td><a href="'. $hotel["image"] . '" target="_blank">View</a></td>';
                      echo '<td><a href="admin_images_hotel.php?id_hotel=' . $hotel["id"] . '"><button type="button" class="btn btn-block btn-danger" style="background-color: blue;">Gallerie</button></a></td>';
                      echo '<td><a href="?delete=' . $hotel["id"] . '"><button type="button" class="btn btn-block btn-danger">Supprimer</button></a></td>';
					  echo '<td><a href="admin_add_hotel.php?modify=' . $hotel["id"] . '"><button type="button" class="btn btn-block btn-danger" style="background-color: green;">Modifier</button></a></td>';
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