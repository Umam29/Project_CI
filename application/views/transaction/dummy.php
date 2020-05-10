<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

  <?= $this->session->flashdata('message');?>

  <div class="card shadow mb-4 mt-2">
    <!-- <div class="card-header"> -->
      <!-- <a href="" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-plus"></i> Add</a> -->
      <!-- <button type="submit" class="btn btn-primary" onClick="AddNewRow()" id="addRow" name="addRow"><i class="fas fa-plus"></i> Add</button>
    </div>       -->
        <div class="card-body">              
            <table class="table table-striped table-bordered" id="data_table" width="100%" cellspasing="0">
                <thead>
                    <tr>
                        <!-- <th>Select</th> -->
                        <th>Code</th>
                        <th>Date</th>
                        <th>Name</th>
                        <!-- <th>Category</th>
                        <th>Stock</th> -->
                        <th>Unit</th>
                        <!-- <th>Description</th> -->
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
    </div>
  </div>

          
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->