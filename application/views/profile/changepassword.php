        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

          <div class="mb-4">
            <div class="col-lg-4">
                <?= $this->session->flashdata('message');?>

                <form action="<?= base_url('user/changepassword')?>" method="post">
                    <div class="form-group row">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id']; ?>" readonly>
                    </div>
                    <div class="form-group row">
                        <label for="CurrentPassword">Current Password</label>
                        <input type="password" class="form-control" id="CurrentPassword" name="CurrentPassword">
                        <?= form_error('CurrentPassword', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <label for="NewPass1">New Password</label>
                        <input type="password" class="form-control" id="NewPass1" name="NewPass1">
                        <?= form_error('NewPass1', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <label for="NewPass2">Confirm New Password</label>
                        <input type="password" class="form-control" id="NewPass2" name="NewPass2">
                        <?= form_error('NewPass2', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>


            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

     </div>
      <!-- End of Main Content -->