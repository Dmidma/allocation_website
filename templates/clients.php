<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Users</h3>

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
                    <th>Prenom</th>
                    <th>CIN</th>
                    <th>adresse</th>
                    <th>admin</th>
                    <th>user_name</th>
                  
                    <th>Supprimer</th>
										<!--<th>Modifier</th>-->
                  </tr>
                  </thead>
                  <tbody>



                  <?php
                  
                    foreach ($users as $user) 
                    {
                      echo "<tr>";
                      echo "<td>". $user["id"] . "</td>";

                      echo "<td>". $user["nom"] . "</td>";
                      echo "<td>". $user["prenom"] . "</td>";
                      echo "<td>". $user["cin"] . "</td>";
                      echo "<td>". $user["adresse"] . "</td>";

                      if ($user["admin"] == "Normal")
                        echo '<td><span class="label label-success">' . $user["admin"] . '</span></td>';
                      else
                        echo '<td><span class="label label-warning">' . $user["admin"] . '</span></td>';

                      echo "<td>". $user["user_name"] . "</td>";
                      


                      echo '<td><a href="?delete=' . $user["id"] . '"><button type="button" class="btn btn-block btn-danger">Delete</button></a></td>';
                      //echo '<td><a href="#"><button type="button" class="btn btn-block btn-danger" style="background-color: green;">Modifier</button></a></td>'; 
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