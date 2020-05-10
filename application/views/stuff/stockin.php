<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

        <div class="container">
        <div class="card shadow-lg col-lg-7 mx-auto">
          <?= $this->session->flashdata('message');?>
          <!-- <div class="card-header">
            <a href="<?= base_url(); ?>transaction/historyStockIn"><i class="fas fa-arrow-left"></i> Back</a>
          </div> -->
          <div class="card-body">
            <div class="row">              

                <div class="col-md-12">
                    <form action="<?= base_url('transaction/stockin')?>" method="post">
                        <div class="form-group">
                            <label for="date_stock">Date * </label>
                            <input type="text" class="form-control" name="date_stock" id="date_stock">
                            <?= form_error('date_stock', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div>
                            <label for="code">Code * </label>
                        </div>
                        <div class="form-group">                            
                            <div class="input-group">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="text" class="form-control" id="code" name="code" readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchStuff">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>                                                                                   
                        </div>
                        <div class="form-group">
                            <label for="stuff_name">Stuff Name * </label>
                            <input type="text" class="form-control" name="stuff_name" id="stuff_name" readonly>
                            <?= form_error('stuff_name', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="unit">Unit * </label>
                                    <input type="text" class="form-control" id="unit" name="unit" value="-" readonly>
                                    <?= form_error('unit', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="col-md-8">
                                    <label for="stock">Stock * </label>
                                    <input type="text" class="form-control" id="stock" name="stock" value="-" readonly>
                                    <?= form_error('stock', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="price">Price * </label>
                            <input type="text" class="form-control" name="price" id="price" readonly>
                            <?= form_error('price', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <input type="text" class="form-control" name="desc" id="desc">
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity * </label>
                            <input type="number" step="0.01" class="form-control" name="qty" id="qty">
                            <?= form_error('qty', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="total">Total Price</label>
                            <input type="text" class="form-control" name="total" id="total" readonly>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>            


            </div>
          </div>
        </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Search Stuff -->
<div class="modal fade" id="searchStuff">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchStuffLabel">Select Stuff</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body table-responsive">
            <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Price</th>            
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($stuff as $s) : ?>
                <tr>                    
                    <td><?= $s['stuff_code']; ?></td>
                    <td><?= $s['name'] ?></td>
                    <td><?= number_format($s['stock'],2,',','.'); ?></td>    
                    <td><?= $s['satuan']; ?></td>          
                    <td>Rp. <?= number_format($s['price'],2,',','.'); ?></td>              
                    <td><?= $s['category']; ?></td>
                    <td>
                        <button class="btn btn-info" id="select"
                            data-id="<?= $s['id']; ?>"
                            data-code="<?= $s['stuff_code']; ?>"
                            data-name="<?= $s['name']; ?>"
                            data-unit="<?= $s['satuan']; ?>"
                            data-stock="<?= $s['stock']; ?>"
                            data-price="<?= $s['price']; ?>"
                            >
                            <i class="fa fa-check"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div> -->
    </div>
  </div>
</div>