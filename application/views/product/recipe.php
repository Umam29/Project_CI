<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

  <div class="row">
  <div class="col-lg-8">
  <?php if (validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <?=validation_errors();?>
        </div>
  <?php endif;?>

  <?=$this->session->flashdata('message');?>

      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRecipe"><i class="fas fa-plus"></i> Add</a>
      
      <div class="table-responsive">
      <table class="table table-hover" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Stuff Name</th>
            <th scope="col">Measure</th>
            <th scope="col">Unit</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($recipe as $res) : ?>
            <tr>
                <td><?= $res['p_name']; ?></td>
                <td><?= $res['s_name'] ?></td>       
                <td><?= number_format($res['measure'],2,',','.'); ?></td>
                <td><?= $res['nama_satuan'] ?></td>
                <td>
                  <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_edit<?php echo $res['id'];?>"><i class="fas fa-edit"></i></a>
                  <a href="<?= base_url(); ?>product/deleteRecipe/<?= $prod_id;?>/<?= $res['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
      </table>
      </div>
      </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add Recipe -->
<div class="modal fade" id="newRecipe" tabindex="-1" role="dialog" aria-labelledby="newRecipeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRecipeLabel">Add Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url()?>product/showRecipe/<?php echo $prod_id;?>" method="post">
        <div class="modal-body">
          <div class="form-group">
              <select class="custom-select my-1 mr-sm-2" name="stuff" id="stuff" class="form-control" required>
                <option value="">-- Select Stuff --</option>
                    <?php foreach ($stuff as $stuf) : ?>
                        <option value="<?= $stuf['id']; ?>"><?= $stuf['name']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Measure" name="measure" id="measure" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Recipe -->
<?php foreach ($recipe as $res) : ?>
<div class="modal fade" id="modal_edit<?php echo $res['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editRecipeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editRecipeLabel">Edit Recipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url()?>product/editRecipe/<?php echo $prod_id;?>/<?= $res['id']; ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
              <select class="custom-select my-1 mr-sm-2" name="stuff_edit" id="stuff_edit" class="form-control" required>
                <option value="">-- Select Stuff --</option>
                    <?php foreach ($stuff as $s) : ?>
                    <option value="<?= $s['id']; ?>" <?php if($res['stuff_id'] == $s['id']): ?>selected<?php endif; ?>><?= $s['name']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Measure" name="measure_edit" id="measure_edit" value="<?= $res['measure']; ?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>