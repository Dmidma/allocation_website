<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Config</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">

              
              <!-- username -->
              
               <form method="post" action="admin_config.php">
              <div class="box-body">

                <div class="form-group">
                  <label>Currnet Admin Name: "<?php echo $admin["user_name"]; ?>"</label>
                  <input type="text" name="new_admin_name" class="form-control" placeholder="New Admin Name" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>



              <!-- password -->

              <form method="post" action="admin_config.php">
              <div class="box-body">

                <div class="form-group">
                  <label>Change Password:</label>
                  <input type="text" name="new_admin_password" class="form-control" placeholder="New Password" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>


              <!-- Image -->

              <form method="post" action="admin_config.php" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label>Admin Image</label>
                  <input type="file" name="new_admin_image" required> 

                  <p class="help-block">Selection image du Admin du PC. </p>
                </div>
              </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
            </form>


              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          </div>