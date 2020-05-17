    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

    <div class="container">

    <?= $this->session->flashdata('message');?>
    <!-- <div class="card-header">
        <a href="<?= base_url(); ?>transaction/historyStockIn"><i class="fas fa-arrow-left"></i> Back</a>
    </div> -->
        <div class="card">
            <div class="card-header">
            <div class="col-sm-6 d-flex text-right bill_no">
                <div>
                    <div class="mb-0">
                        <b class="mr-2">Bill No</b> <span id="bill_no"><?= $struck_no; ?></span>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-body">
                <div class="col-md-4">
                        <div class="form-group">     
                            <label for="code">Code</label>                       
                            <div class="input-group">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="text" class="form-control" id="product_code" name="product_code" readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#searchProduct">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="form-inline">
                                <span class="ml-1 text-muted" id="product_name" name="product_name"></span>
                                <span class="ml-3 text-muted" id="price" name="price"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" name="qty" id="qty">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary add_cart" id="add_cart">Add</button>
                        </div>
                        
                </div>
                
                <div id="cart_details">
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<div class="modal fade" id="searchProduct">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchProductLabel">Select Product</h5>
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
                        <th>Price</th>            
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($product as $s) : ?>
                <tr>                    
                    <td><?= $s['product_code']; ?></td>
                    <td><?= $s['name'] ?></td>         
                    <td>Rp. <?= number_format($s['price'],2,',','.'); ?></td>              
                    <td><?= $s['pc_name']; ?></td>
                    <td>
                        <button class="btn btn-info" id="select_product"
                            data-id="<?= $s['id']; ?>"
                            data-product_code="<?= $s['product_code']; ?>"
                            data-name="<?= $s['name']; ?>"
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
    </div>
  </div>
</div>