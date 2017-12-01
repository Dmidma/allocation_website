  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Contact</h3>

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
                    <th>email</th>
                    <th>sujet</th>
                    <th>message</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>



                  <?php
                  
                    foreach ($contacts as $contact) 
                    {
                      echo "<tr>";
                      echo "<td>". $contact["id"] . "</td>";

                      echo "<td>". $contact["nom"] . "</td>";
                      echo "<td>". $contact["email"] . "</td>";
                      echo "<td>". $contact["sujet"] . "</td>";
                      echo "<td>". $contact["message"] . "</td>";

                      echo '<td><a href="admin_contact.php?to_delete=' . $contact["id"] . '"><button type="button" class="btn btn-block btn-danger">Delete</button></a></td>';
                      
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