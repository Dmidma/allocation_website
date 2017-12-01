
          <div class="box box-primary">
            <div class="box-header with-border">
            <?php if (isset($update) && $update): ?>
              <h3 class="box-title">Modifier Hotel</h3>
              <?php endif; ?>

              <?php if (!isset($update)): ?>
              <h3 class="box-title">Ajouter Hotel</h3>
              <?php endif; ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->


            <?php if (isset($message)): ?>

              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                  <?php echo $message; ?>
              </div>
            <?php endif; ?>



            <?php if (isset($update) && $update): ?>
                <form method="post" action="admin_add_hotel.php" enctype="multipart/form-data">
              <div class="box-body">

              <input type="text" name="update" value="<?php echo $hotel["id"]; ?>" style="display: none;"/>


                <div class="form-group">
                  <label>Nom</label>
                  <input type="text" name="hotel_name" class="form-control" placeholder="Name of Hotel" required value="<?php echo $hotel["nom"]; ?>">
                </div>

                <div class="form-group">
                  <label>etoile</label>
                  <select name="stars" class="form-control" value="<?php echo $hotel["stars"]; ?>"> 
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Addresse</label>
                  <input type="text" name="address" class="form-control" placeholder="Address of Hotel." required value="<?php echo $hotel["adresse"]; ?>">
                </div>

                <div class="form-group">
                  <label>Latitude</label>
                  <input type="text" name="latitude" class="form-control" placeholder="Latitude" value="<?php echo $hotel["latitude"]; ?>">
                </div>

                <div class="form-group">
                  <label>Longitude</label>
                  <input type="text" name="longitude" class="form-control" placeholder="Longitude" value="<?php echo $hotel["longitude"]; ?>">
                </div>

                <div class="form-group">
                  <label>Prix par Nuit</label>
                  <input type="text" step="0.1" name="price" class="form-control" placeholder="Price Per Night" required value="<?php echo $hotel["price_night"]; ?>">
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Enter Description of Hotel."><?php echo $hotel["description"]; ?></textarea>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Modifier</button>
              </div>
            </form>
      
            <?php endif; ?>





            <?php if (!isset($update)): ?>
            <form method="post" action="admin_add_hotel.php" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label>Nom</label>
                  <input type="text" name="hotel_name" class="form-control" placeholder="Name of Hotel" required>
                </div>

                <div class="form-group">
                  <label>etoile</label>
                  <select name="stars" class="form-control"> 
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Addresse</label>
                  <input type="text" name="address" class="form-control" placeholder="Address of Hotel." required>
                </div>

                <div class="form-group">
                  <label>Latitude</label>
                  <input type="text" name="latitude" class="form-control" placeholder="Latitude">
                </div>

                <div class="form-group">
                  <label>Longitude</label>
                  <input type="text" name="longitude" class="form-control" placeholder="Longitude">
                </div>

                <div class="form-group">
                  <label>Prix par Nuit</label>
                  <input type="text" step="0.1" name="price" class="form-control" placeholder="Price Per Night" required>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Enter Description of Hotel."></textarea>
                </div>
                
                <div class="form-group">
                  <label>Hotel Image</label>
                  <input type="file" name="hotel_image">

                  <p class="help-block">Select the Image of Hotel from your pc.</p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            <?php endif; ?>
          </div>