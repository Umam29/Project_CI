<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

  <?= $this->session->flashdata('message');?>

  <div class="card shadow mb-4">      
      <div class="card-body">  
      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Struck No</th>
            <th scope="col">Date</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            <th scope="col">Pay</th>
            <th scope="col">Change</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($sales as $res) : ?>
          <tr>
              <td><?= $res['struck_no']; ?></td>
              <td><?= date("d/m/Y", strtotime($res['date'])); ?></td>
              <td><?= $res['product_name']; ?></td>
              <td><?= $res['qty']; ?></td>
              <td>Rp. <?= number_format($res['total'],2,',','.'); ?></td>        
              <td>Rp. <?= number_format($res['payfee'],2,',','.'); ?></td>
              <td>Rp. <?= number_format($res['change'],2,',','.'); ?></td>
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