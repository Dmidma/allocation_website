
          <div class="box box-primary">
            <div class="box-header with-border">
                          <?php if (isset($update) && $update): ?>
              <h3 class="box-title">Modifier Excurtion</h3>
              <?php endif; ?>

              <?php if (!isset($update)): ?>
              <h3 class="box-title">Ajouter Excurtion</h3>
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
              <form role="form" method="post" action="admin_add_circuit.php" enctype="multipart/form-data">
              <div class="box-body">

                <input type="text" name="update" value="<?php echo $circuit["id"]; ?>" style="display: none;"/>

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="circuit_name" class="form-control" placeholder="Name of Circuit" required value="<?php echo $circuit["nom"]; ?>">
                </div>


                <div class="form-group">
                  <label>Depart</label>
                  <input type="text" name="depart" class="form-control" placeholder="Location of Depart" required value="<?php echo $circuit["depart"]; ?>">
                </div>

                <div class="form-group">
                  <label>Date Depart:</label>
                  <input type="text" name="date_depart" id="date-start" class="form-control" placeholder="mm/dd/yyyy" required value="<?php echo $circuit["date_depart"]; ?>"/>
                </div>

                <div class="form-group">
                  <label>Date arrive:</label>
                  <input type="text" name="date_arrive" id="date-end" class="form-control" placeholder="mm/dd/yyyy" required value="<?php echo $circuit["date_arrive"]; ?>"/>
                </div>

                <div class="form-group">
                  <label>Prix</label>
                  <input type="text" name="prix" class="form-control" placeholder="Price" required value="<?php echo $circuit["prix"]; ?>">
                </div>


                <div class="form-group">
                  <label>Plan</label>
                  <textarea name="plan" class="form-control" rows="3" placeholder="Enter Plan of Circuit."><?php echo $circuit["plan"]; ?></textarea>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Enter Description of Circuit."><?php echo $circuit["description"]; ?></textarea>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Modifier</button>
              </div>
            </form>




            <?php endif; ?>



            <?php if (!isset($update)): ?>
            <form role="form" method="post" action="admin_add_circuit.php" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="circuit_name" class="form-control" placeholder="Name of Circuit" required>
                </div>


                <div class="form-group">
                  <label>Depart</label>
                  <input type="text" name="depart" class="form-control" placeholder="Location of Depart" required>
                </div>

                <div class="form-group">
                  <label>Date Depart:</label>
                  <input type="text" name="date_depart" id="date-start" class="form-control" placeholder="mm/dd/yyyy" required/>
                </div>

                <div class="form-group">
                  <label>Date arrive:</label>
                  <input type="text" name="date_arrive" id="date-end" class="form-control" placeholder="mm/dd/yyyy" required/>
                </div>

                <div class="form-group">
                  <label>Prix</label>
                  <input type="text" name="prix" class="form-control" placeholder="Price" required>
                </div>


                <div class="form-group">
                  <label>Plan</label>
                  <textarea name="plan" class="form-control" rows="3" placeholder="Enter Plan of Circuit."></textarea>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea name="description" class="form-control" rows="3" placeholder="Enter Description of Circuit."></textarea>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputFile">Circuit Image</label>
                  <input type="file" name="circuit_image" id="exampleInputFile">

                  <p class="help-block">Select the Image of Circuit from your pc.</p>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            <?php endif; ?>
          </div>