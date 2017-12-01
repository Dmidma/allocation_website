<!--
  
  col-xs-3
  col-xs-4
  col-xs-5

-->

<div class="box box-success">

<div class="box-header with-border">
  <h3 class="box-title">Hotel</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<form method="post" action="admin_create_promotion.php">
<div class="box-body">
    
      <div class="form-group">
          <label>ID Hotel</label>
          <select name="id_hotel" class="form-control">

            <!-- Load hotels id -->
            <?php
              foreach ($ids_hotels as $id_hotel) {
                echo '<option value="' . $id_hotel["id"] . '">' . $id_hotel["id"] . '</option>';
              }
            ?>

          </select>
      </div>
    
      <div class="form-group">
          <label>Promotion</label>
          <input type="number" name="hotel_promo" min="1" max="100" required>
      </div>
</div>
<div class="box-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>




<div class="box box-danger">

<div class="box-header with-border">
  <h3 class="box-title">Cars</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>

<form method="post" action="admin_create_promotion.php">
<div class="box-body">
      <div class="form-group">
          <label>ID Cars</label>
          <select name="id_voiture" class="form-control">

            <!-- Load Cars id -->

            <?php
              foreach ($ids_voitures as $id_voiture) {
                echo '<option value="' . $id_voiture["id"] . '">' . $id_voiture["id"] . '</option>';
              }
            ?>
          

          </select>
      </div>
    
    
      <div class="form-group">
          <label>Promotion</label>
          <input type="number" name="voiture_promo" min="1" max="100" required>
      </div>
    </div>
  

<div class="box-footer">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>

<!-- /.box-body -->
</form>
</div>
<!-- /.box -->




<div class="box box-info">

<div class="box-header with-border">
  <h3 class="box-title">Circuit</h3>

  <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
    </button>
    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
</div>
<form method="post" action="admin_create_promotion.php">
<div class="box-body">
    
    
      <div class="form-group">
          <label>ID Circuit</label>
          <select name="id_circuit" class="form-control">

            <!-- Load ciruits id -->

            <?php
              foreach ($ids_circuits as $id_circuit) {
                echo '<option value="' . $id_circuit["id"] . '">' . $id_circuit["id"] . '</option>';
              }
            ?>
          

          </select>
      </div>
    


    
      <div class="form-group">
          <label>Promotion</label>
          <input type="number" name="circuit_promo" min="1" max="100" required>
      </div>
    


   
  </div>
  

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>

<!-- /.box-body -->
</form>
</div>
<!-- /.box -->

