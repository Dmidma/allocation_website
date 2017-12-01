<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Circuit</h3>

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
                    <th>Plan</th>
                    <th>depart</th>
                    <th>Description</th>
                    <th>Date Depart</th>
                    <th>Date Arrive</th>
                    <th>Prix</th>
                    <th>Gallerie Images</th>
                    <th>Supprimer</th>
					<th>Modifier</th>
                  </tr>
                  </thead>
                  <tbody>



                  <?php
                  
                    foreach ($circuits as $circuit) 
                    {
                      echo "<tr>";
                      echo "<td>". $circuit["id"] . "</td>";

                      echo "<td>". $circuit["nom"] . "</td>";
                      echo "<td>". $circuit["plan"] . "</td>";
                      echo "<td>". $circuit["depart"] . "</td>";
                      echo "<td>". $circuit["description"] . "</td>";


                      echo "<td>". $circuit["date_depart"] . "</td>";
                      echo "<td>". $circuit["date_arrive"] . "</td>";
                      echo "<td>". $circuit["prix"] . "</td>";  
                      echo '<td><a href="admin_images_circuit.php?id_circuit=' . $circuit["id"] . '"><button type="button" class="btn btn-block btn-danger" style="background-color: blue;">Gallerie</button></a></td>';
                      echo '<td><a href="?delete=' . $circuit["id"] . '"><button type="button" class="btn btn-block btn-danger">Delete</button></a></td>';
					  echo '<td><a href="admin_add_circuit.php?modify=' . $circuit["id"] . '"><button type="button" class="btn btn-block btn-danger" style="background-color: green;">Modifier</button></a></td>';
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