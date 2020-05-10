<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>



  <div class="row">
    <div class="col-lg-6">
      <?php if(validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>

      <?= $this->session->flashdata('message');?>
      
      <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newUnit">Add Unit</a>

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
              <th scope="col">Unit Name</th>
              <th scope="col">Unit</th>
              <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php $i = 1; ?>
            <?php foreach ($unit as $u) : ?> 
              <th scope="row"><?= $i;?></th>
              <td><?= $u['nama_satuan']; ?></td>
              <td><?= $u['satuan']; ?></td>
              <td>
                <a href="" class="badge badge-success" data-toggle="modal" data-target="#modal_edit<?php echo $u['id'];?>">edit</a>
                <!-- Menuju Detail <a href="<?= base_url(); ?>menu/detail/<?= $c['id'];?>" class="badge badge-success">edit</a>-->
                <a href="<?= base_url(); ?>master/deleteUnit/<?= $u['id'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
              </td>
          </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

          
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<!-- Button trigger modal -->

<!-- Modal Add Menu -->
<div class="modal fade" id="newUnit" tabindex="-1" role="dialog" aria-labelledby="newUnitLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newUnitLabel">Add New Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master/unit')?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="unit_name" name="unit_name"   placeholder="Unit Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="unit" name="unit"   placeholder="Unit">
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

<!-- Modal Edit Menu -->
<?php foreach ($unit as $u) : ?> 
<div class="modal fade" id="modal_edit<?php echo $u['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editUnitLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUnitLabel">Edit Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url()?>master/editUnit/<?= $u['id'];?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="unit_name_edit" name="unit_name_edit" value="<?php echo $u['nama_satuan'];?>" placeholder="Unit Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="unit_edit" name="unit_edit" value="<?php echo $u['satuan'];?>" placeholder="Unit Name">
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

