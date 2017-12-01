
          <div class="box box-primary">
            <div class="box-header with-border">
                                       <?php if (isset($update) && $update): ?>
              <h3 class="box-title">Modifier Voiture</h3>
              <?php endif; ?>

              <?php if (!isset($update)): ?>
              <h3 class="box-title">Ajouter Voiture</h3>
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

              <form method="post" action="admin_add_voiture.php" enctype="multipart/form-data">
              <div class="box-body">


              <input type="text" name="update" value="<?php echo $voiture["id"]; ?>" style="display: none;"/>

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Name of car" required value="<?php echo $voiture["nom"]; ?>">
                </div>


                <div class="form-group">
                  <label>Marque</label>
                  <input type="text" name="marque" class="form-control" placeholder="Marque" required value="<?php echo $voiture["marque"]; ?>">
                </div>



                <div class="form-group">
                  <label>Puissance</label>
                  <input type="number" name="puissance" min="1" max="100" class="form-control" required value="<?php echo $voiture["puissance"]; ?>">
                </div>


                <div class="form-group">
                  <label>Carburant</label>
                  <select name="carburant" class="form-control" value="<?php echo $voiture["carburant"]; ?>">
                    <option value="1">Sans Plomb</option>
                    <option value="2">Gazoil 50</option>
                    <option value="3">Gazoil</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Prix</label>
                  <input type="text" name="prix" class="form-control" placeholder="Price" required value="<?php echo $voiture["prix"]; ?>">
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Enter Description of Car."><?php echo $voiture["description"]; ?></textarea>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Modfier</button>
              </div>
            </form>

            <?php endif; ?>


            <?php if (!isset($update)): ?>
            <form method="post" action="admin_add_voiture.php" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" placeholder="Name of car" required>
                </div>


                <div class="form-group">
                  <label>Marque</label>
                  <input type="text" name="marque" class="form-control" placeholder="Marque" required>
                </div>



                <div class="form-group">
                  <label>Puissance</label>
                  <input type="number" name="puissance" min="1" max="100" class="form-control" required>
                </div>


                <div class="form-group">
                  <label>Carburant</label>
                  <select name="carburant" class="form-control">
                    <option value="1">Sans Plomb</option>
                    <option value="2">Gazoil 50</option>
                    <option value="3">Gazoil</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>Prix</label>
                  <input type="text" name="prix" class="form-control" placeholder="Price" required>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Enter Description of Car."></textarea>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputFile">Car Image</label>
                  <input type="file" name="car_image">

                  <p class="help-block">Select the Image of Car from your pc.</p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            <?php endif; ?>
          </div>