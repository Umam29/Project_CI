<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

  <?= $this->session->flashdata('message');?>

  <div class="card shadow mb-4">
    <div class="card-header">
      <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newStuff"><i class="fas fa-plus"></i> Add</a>
    </div>
      
      <div class="card-body">  
      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Code</th>
            <th scope="col">Name</th>
            <th scope="col">Stock</th>
            <th scope="col">Unit</th>
            <th scope="col">Price</th>            
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php foreach ($stuff as $s) : ?>
              <td><?= $s['stuff_code']; ?></td>
              <td><?= $s['name'] ?></td>
              <td><?= number_format($s['stock'],2,',','.'); ?></td>    
              <td><?= $s['satuan']; ?></td>          
              <td>Rp. <?= number_format($s['price'],2,',','.'); ?></td>              
              <td><?= $s['category']; ?></td>
              <td>
                <a href="" class="badge badge-success" data-toggle="modal" data-target="#modal_edit<?php echo $s['id'];?>">edit</a>
                <a href="<?= base_url(); ?>transaction/deleteStuff/<?= $s['id'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
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

<!-- Modal Add Menu -->
<div class="modal fade" id="newStuff" tabindex="-1" role="dialog" aria-labelledby="newStuffLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newStuffLabel">Add Stuff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('transaction/addstuff')?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Stuff Code" name="code" id="code" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Stuff Name" name="name" id="name" required>
          </div>
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Price" name="price" id="price" required>
          </div>
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Stock" name="stock" id="stock" required>
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="category" id="category" class="form-control" required>
                <option value="">-- Select Category --</option>
                    <?php foreach ($category as $c) : ?>
                        <option value="<?= $c['id']; ?>"><?= $c['category']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>          
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="unit" id="unit" class="form-control" required>
                <option value="">-- Select Unit --</option>
                    <?php foreach ($satuan as $s) : ?>
                        <option value="<?= $s['id']; ?>"><?= $s['satuan']; ?></option>
                    <?php endforeach;?>
                </select>
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
<?php foreach ($stuff as $s) : ?>
<div class="modal fade" id="modal_edit<?php echo $s['id'];?>" tabindex="-1" role="dialog" aria-labelledby="EditStuffModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditStuffModalLabel">Tambah Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url()?>transaction/editstuff/<?php echo $s['id'];?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Stuff Code" name="code_edit" id="code_edit" value="<?= $s['stuff_code']; ?>" required>
            
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Stuff Name" name="name_edit" id="name_edit" value="<?= $s['name']; ?>" required>
          </div>
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Price" name="price_edit" id="price_edit" value="<?= $s['price']; ?>" required>
          </div>
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Stock" name="stock_edit" id="stock_edit" value="<?= $s['stock']; ?>" required>
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="category_edit" id="category_edit" class="form-control" required>
                <option value="">-- Select Category --</option>
                <?php foreach ($category as $c) : ?>
                    <option value="<?= $c['id']; ?>" <?php if ($s['category_id'] == $c['id']) : ?>selected<?php endif; ?>><?= $c['category']; ?></option>
                <?php endforeach;?>
                </select>
          </div>          
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="unit_edit" id="unit_edit" class="form-control" required>
                <option value="">-- Select Unit --</option>
                    <?php foreach ($satuan as $sa) : ?>
                        <option value="<?= $sa['id']; ?>" <?php if ($s['unit_id'] == $sa['id']) : ?>selected<?php endif; ?>><?= $sa['satuan']; ?></option>
                    <?php endforeach;?>
                </select>
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