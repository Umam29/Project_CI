<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

  <?= $this->session->flashdata('message');?>

  <div class="card shadow mb-4">
    <div class="card-header">
      <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newProduct"><i class="fas fa-plus"></i> Add</a>
    </div>
      
      <div class="card-body">  
      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Product Code</th>
            <th scope="col">Product Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($product as $res) : ?>
          <tr>
              <td><?= $res['product_code']; ?></td>
              <td><?= $res['name'] ?></td>  
              <td><?= $res['pc_name']; ?></td>        
              <td>Rp. <?= number_format($res['price'],2,',','.'); ?></td>
              <td>
                <a href="<?= base_url(); ?>product/showRecipe/<?= $res['id'];?>" class="badge badge-info">recipe</a>
                <a href="" class="badge badge-success" data-toggle="modal" data-target="#modal_edit<?php echo $res['id'];?>">edit</a>
                <a href="<?= base_url(); ?>product/deleteProduct/<?= $res['id'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
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

<!-- Modal Add Product -->
<div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="newProductLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newProductLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('product')?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Product Code" name="code" id="code" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Product Name" name="name" id="name" required>
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="category" id="category" class="form-control" required>
                <option value="">-- Select Category --</option>
                    <?php foreach ($pc as $c) : ?>
                        <option value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>    
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Price" name="price" id="price" required>
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

<!-- Modal Edit Product -->
<?php foreach ($product as $res) : ?>
<div class="modal fade" id="modal_edit<?php echo $res['id'];?>" tabindex="-1" role="dialog" aria-labelledby="editProductLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url()?>product/editProduct/<?php echo $res['id'];?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Product Code" name="code_edit" id="code_edit" value="<?php echo $res['product_code'];?>" required>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Product Name" name="name_edit" id="name_edit" value="<?php echo $res['name'];?>" required>
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="category_edit" id="category_edit" class="form-control" required>
                <option value="">-- Select Category --</option>
                    <?php foreach ($pc as $c) : ?>
                    <option value="<?= $c['id']; ?>" <?php if ($res['product_category_id'] == $c['id']) : ?>selected<?php endif; ?>><?= $c['name']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>    
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Price" name="price_edit" id="price_edit" value="<?php echo $res['price'];?>" required>
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