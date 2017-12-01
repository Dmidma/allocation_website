<div class="box box-success">

<div class="box-header with-border">
  <h3 class="box-title">Hotel Images</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<form method="get" action="admin_images_hotel.php">
<div class="box-body">
    
      <div class="form-group">
          <label>Hotel Id</label>
          <select name="id_hotel" class="form-control">

            <!-- Load hotel id -->
            <?php
              foreach ($hotels as $hotel) {
                echo '<option value="' . $hotel["id"] . '">' . $hotel["id"] .  ': (' . $hotel["nom"] . ')</option>';
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
        
          foreach ($hotel_images as $hotel_image) 
          {
            echo "<tr>";
            echo "<td>". $hotel_image["id"] . "</td>";

            // a preview
            echo '<td><a href="'. $hotel_image["image"] . '" target="_blank"><img width="200" height="100" src="' . $hotel_image["image"] . '"/></a></td>';

            echo '<td><a href="?delete=' . $hotel_image["id"] . '"><button type="button" class="btn btn-block btn-danger">Delete</button></a></td>';
            
            echo "</tr>";
          }
        ?>
        </tbody>
      </table>
      <hr/>

      <!-- Image Section -->
      <form method="post" action="admin_images_hotel.php" enctype="multipart/form-data">
        <div class="box-body">
          
        <input type="test" name="to_hotel_id" value="<?php echo $current_hotel_id; ?>" style="display: none;"/>

          <div class="form-group">
            <label>New Image</label>
            <input type="file" name="hotel_image" required>

            <p class="help-block">Select the Image of Hotel from your pc.</p>
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