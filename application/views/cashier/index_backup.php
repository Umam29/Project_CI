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
      <div class="card-body">
        <form role="form" action="" method="post" class="form-horizontal">
                <div class="form-group" align="right">
                  <label for="gross_amount" class="col-sm-3 control-label">Date: <?php echo date('d-m-Y') ?></label>
                </div>
                <div class="form-group" align="right">
                  <label for="gross_amount" class="col-sm-3 control-label">Time: <?php date_default_timezone_set('Asia/Jakarta'); echo date('h:i a') ?></label>
                </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Customer Name</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" autocomplete="off" />
                    </div>
                  </div>

                  <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Product</th>
                      <th style="width:10%">Qty</th>
                      <th style="width:20%">Amount</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($products as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                  <div class="form-group" align="right">
                    <label for="discount" class="col-sm-5" align="left">Discount : </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group" align="right">
                    <label for="net_amount" class="col-sm-5" align="left">Net Amount : </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group" align="right">
                    <label for="net_amount" class="col-sm-5" align="left">Pay : </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group" align="right">
                    <label for="net_amount" class="col-sm-5" align="left">Change : </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                    </div>
                  </div>
        </form>
      </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->