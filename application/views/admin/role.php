<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>



  <div class="row">
    <div class="col-lg-6">
      <?= form_error('role', '<div class="alert alert-danger" role="alert">' ,'</div>');?>

      <?= $this->session->flashdata('message');?>
      
      <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a> -->

      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
              <th scope="col">Role</th>
              <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php $i = 1; ?>
            <?php foreach ($role as $r) : ?> 
              <th scope="row"><?= $i;?></th>
              <td><?= $r['role_name']; ?></td>
              <td>
                <a href="<?= base_url(); ?>admin/roleaccess/<?= $r['id'];?>" class="badge badge-warning">access</a>
                <!-- <a href="" class="badge badge-success" data-toggle="modal" data-target="#modal_edit<?php echo $r['id'];?>">edit</a> -->
                <!-- Menuju Detail <a href="<?= base_url(); ?>menu/detail/<?= $m['id'];?>" class="badge badge-success">edit</a>-->
                <!-- <a href="<?= base_url(); ?>admin/deleteRole/<?= $r['id'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a> -->
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
<!-- <div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/role')?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div> -->

<!-- Modal Edit Menu -->
<!-- <?php foreach ($role as $r) : ?> 
<div class="modal fade" id="modal_edit<?php echo $r['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url()?>admin/roleedit/<?= $r['id'];?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="role_edit" name="role_edit" value="<?php echo $r['role_name']; ?>" placeholder="Role Name">
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
<?php endforeach; ?> -->

