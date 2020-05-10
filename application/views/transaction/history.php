<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

  <?= $this->session->flashdata('message');?>

  <div class="card shadow mb-4">
    <div class="card-header">
      <a href="<?= base_url(); ?>transaction/StockIn"><i class="fas fa-plus"></i> Add</a>
    </div>
      
      <div class="card-body">  
      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($purchase as $p) : ?>
          <tr>            
              <td><?= date("d/m/Y", strtotime($p['date'])); ?></td>
              <td><?= $p['name'] ?></td>
              <td><?= number_format($p['qty'],2,',','.'); ?></td>          
              <td>Rp. <?= number_format($p['total_price'],2,',','.'); ?></td>
              <td>
                <a href="" class="badge badge-secondary" data-toggle="modal" data-target="#modal_detail<?php echo $p['id'];?>">detail</a>
                <a href="<?= base_url(); ?>transaction/deletePurchase/<?= $p['id'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
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

<!-- Modal Detail -->
<?php foreach ($purchase as $p) : ?>
<div class="modal fade" id="modal_detail<?php echo $p['id'];?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Stock In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body table-responsive">
            <table class="table table-bordered no-margin">
                <tbody>                
                <tr>                    
                    <th style="">Stuff Code</th>
                    <td><?= $p['stuff_code']; ?></td>
                </tr>
                <tr>                    
                    <th style="">Date</th>
                    <td><?= date("d/m/Y", strtotime($p['date'])); ?></td>
                </tr>
                <tr>                    
                    <th style="">Stuff Name</th>
                    <td><?= $p['name']; ?></td>
                </tr>
                <tr>                    
                    <th style="">Price Per Unit</th>
                    <td>Rp. <?= number_format($p['price'],2,',','.'); ?></td>
                </tr>
                <tr>                    
                    <th style="">Quantity</th>
                    <td><?= $p['qty']; ?></td>
                </tr>
                <tr>                    
                    <th style="">Unit</th>
                    <td><?= $p['satuan']; ?></td>
                </tr>
                <tr>                    
                    <th style="">Total Price</th>
                    <td>Rp. <?= number_format($p['total_price'],2,',','.'); ?></td>
                </tr>
                <tr>                    
                    <th style="">Stock</th>
                    <td><?= $p['stock']; ?></td>
                </tr>
                <tr>                    
                    <th style="">Description</th>
                    <td><?= $p['description']; ?></td>
                </tr>
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
<?php endforeach; ?>