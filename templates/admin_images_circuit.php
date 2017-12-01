<div class="box box-success">

<div class="box-header with-border">
  <h3 class="box-title">circuit Images</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<form method="get" action="admin_images_circuit.php">
<div class="box-body">
    
      <div class="form-group">
          <label>circuit Id</label>
          <select name="id_circuit" class="form-control">

            <!-- Load circuit id -->
            <?php
              foreach ($circuits as $circuit) {
                echo '<option value="' . $circuit["id"] . '">' . $circuit["id"] .  ': (' . $circuit["nom"] . ')</option>';
              }
            ?>

          </select>
      </div>
</div>
<div class="box-footer">
  <button type="submit" class="btn btn-primary">Show images</button>
</div>
</form>
</div>

<?php if ($show_images): ?>



<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Images</h3>

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
          <th>image</th>  
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>



        <?php
        
          foreach ($circuit_images as $circuit_image) 
          {
            echo "<tr>";
            echo "<td>". $circuit_image["id"] . "</td>";

            // a preview
            echo '<td><a href="'. $circuit_image["image"] . '" target="_blank"><img width="200" height="100" src="' . $circuit_image["image"] . '"/></a></td>';

            echo '<td><a href="?delete=' . $circuit_image["id"] . '"><button type="button" class="btn btn-block btn-danger">Delete</button></a></td>';
            
            echo "</tr>";
          }
        ?>
        </tbody>
      </table>
      <hr/>

      <!-- Image Section -->
      <form method="post" action="admin_images_circuit.php" enctype="multipart/form-data">
        <div class="box-body">
          
        <input type="test" name="to_circuit_id" value="<?php echo $current_circuit_id; ?>" style="display: none;"/>

          <div class="form-group">
            <label>New Image</label>
            <input type="file" name="circuit_image" required>

            <p class="help-block">Select the Image of circuit from your pc.</p>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.box-body -->
</div>




<?php endif; ?>