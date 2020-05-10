<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

  <?php if (validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
          <?=validation_errors();?>
        </div>
  <?php endif;?>

  <?=$this->session->flashdata('message');?>

  <div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-auto">
                <a href="" data-toggle="modal" data-target="#newUserModal" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span class="text">
                        Add User
                    </span>
                </a>
            </div>
        </div>
    </div>

      <div class="card-body">
      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php foreach ($users as $u): ?>
              <td style="text-align:center"><img width="50" src="<?=base_url('assets/img/profile/' . $u['image']);?>" class="img-thumbnail"></td>
              <td><?=$u['name'];?></td>
              <td><?=$u['user_name'];?></td>
              <td><?=$u['role_name'];?></td>
              <td>
                <a href="" class="badge badge-success" data-toggle="modal" data-target="#modal_edit<?php echo $u['id']; ?>">edit</a>
                <a href="<?=base_url();?>user/delete/<?=$u['id'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
              </td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
      </div>
      </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add User -->
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url('user')?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
          </div>
          <div class="form-group">
            <select name="role" id="role" class="form-control" required>
              <option value="">Select Role</option>
              <?php foreach ($role as $r): ?>
                <option value="<?=$r['id'];?>"><?=$r['role_name'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
              <label class="form-check-label" for="is_active">
                Active?
              </label>
            </div>
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

<!-- Modal Edit User -->
<?php foreach ($users as $u): ?>
<div class="modal fade" id="modal_edit<?php echo $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?=base_url();?>user/edit/<?=$u['id'];?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="name_edit" name="name_edit" placeholder="Name" value="<?=$u['name'];?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="username_edit" name="username_edit" placeholder="Username" value="<?=$u['user_name'];?>" required>
          </div>
          <div class="form-group">
            <select name="role_edit" id="role_edit" class="form-control" required>
              <option value="">Select Role</option>
              <?php foreach ($role as $r): ?>
                <option value="<?=$r['id'];?>" <?php if ($u['role_id'] == $r['id']): ?>selected<?php endif;?>><?=$r['role_name'];?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="is_active_edit" id="is_active_edit" <?php if ($u['is_active'] == "1"): ?> checked <?php endif;?> checked>
              <label class="form-check-label" for="is_active">
                Active?
              </label>
            </div>
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
<?php endforeach;?>