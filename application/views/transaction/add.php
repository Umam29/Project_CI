<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

  <div class="card shadow mb-4">
  <div class="card-header py-3">
    <a href="" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-plus"></i> Add</a>
  </div>
    <div class="card-body">
      <?php if(validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="mydata" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Tanggal Beli</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah Barang</th>
            <th scope="col">Satuan</th>
            <th scope="col">Harga Satuan</th>
            <th scope="col">Harga Total</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php foreach ($trx as $t) : ?>
              <td><?= $t['tgl_beli_temp']; ?></td>
              <td><?= $t['nama_barang_temp']; ?></td>
              <td><?= $t['jumlah_temp']; ?></td>
              <td><?= $t['satuan']; ?></td>
              <td><?= $t['harga_satuan_temp']; ?></td>
              <td><?= $t['harga_total_temp']; ?></td>              
              <td><?= $t['deskripsi_temp']; ?></td>
              <td>
                <a href="<?= base_url(); ?>transaksi/deleteTempTrxBeli/<?= $t['id_temp'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
              </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      </div>

      <a href="<?= base_url(); ?>transaksi/saveadd" class="btn btn-success mb-3">Save</a>
      <a href="<?= base_url(); ?>transaksi/canceladd" class="btn btn-danger mb-3">Cancel</a>
    </div>
  </div>
          
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">

  // $(document).ready(function(){
    
  //   show_stuff();

  //   $('#mydata').dataTable();

  //   function show_stuff()
  //   {
  //     $.ajax({
  //       type: 'ajax',
  //       url: '<?php echo site_url('transaksi/beliData')?>',
  //       async: true,
  //       dataType: 'json',
  //       success: function(data) {
  //         var html = '';
  //         var i;
  //         for (i=0;i<data.lenght;i++){
  //           html += '<tr>'+
  //                   '<td>'+data[i].tgl_beli_temp+'</td>'+
  //                   '<td>'+data[i].nama_barang_temp+'</td>'+
  //                   '<td>'+data[i].jumlah_temp+'</td>'+
  //                   '<td>'+data[i].satuan+'</td>'+
  //                   '<td>'+data[i].harga_satuan_temp+'</td>'+
  //                   '<td>'+data[i].harga_total_temp+'</td>'+
  //                   '<td>'+data[i].deskripsi_temp+'</td>'+                    
  //                   '<td style="text-align:right;">'+
  //                       '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" 
  //                       data-nama_barang_temp="'+data[i].nama_barang_temp+'" 
  //                       data-deskripsi_temp="'+data[i].deskripsi_temp+'" 
  //                       data-jumlah_temp="'+data[i].jumlah_temp+'" 
  //                       data-harga_satuan_temp="'+data[i].harga_satuan_temp+'" 
  //                       data-harga_total_temp="'+data[i].harga_total_temp+'" 
  //                       data-tgl_beli_temp="'+data[i].deskritgl_beli_temppsi_temp+'" 
  //                       data-satuan="'+data[i].satuan+'">Edit</a>+
  //                       '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id_temp="'+data[i].id_temp+'">Delete</a>'+
  //                   '</td>'+
  //                   '</tr>';

  //         }
  //         $('#show_data').html(html);
  //       }
  //     });
  //   }
  // })
  function save()
  {
    $('#btnSave').text('adding...');
    $('#btnSave').attr('disabled',true);

    $.ajax({
      url:  "<?= base_url('transaksi/addBeli'); ?>",
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data)
      {
        if(data.status)
        {
          $('#newSubMenuModal').modal('hide');
          $('.help-block').empty(); 
          location.reload();
        }
        
        $('#btnSave').text('add');
        $('#btnSave').attr('disabled',false);
        
      }
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error adding data');
        $('.help-block').empty(); 
        $('#btnSave').text('add');
        $('#btnSave').attr('disabled',false);
      }
    })
  }
</script>

<!-- Modal Add Menu -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" id="form" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="date" class="form-control" name="tgl" id="tgl">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Barang" name="barang" id="barang">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <input type="number" step="0.01" class="form-control" placeholder="Harga" name="harga" id="harga">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <input type="number" class="form-control" placeholder="Jumlah Barang" name="jumlah" id="jumlah">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="id_satuan" id="id_satuan" class="form-control">
                <option value="">Pilih Satuan</option>
                    <?php foreach ($satuan as $s) : ?>
                        <option value="<?= $s['id']; ?>"><?= $s['satuan']; ?></option>
                    <?php endforeach;?>
                </select>
                <span class="help-block"></span>
          </div>
          <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Radios" id="Radios" value="satuan">
                <label class="form-check-label" for="is_satuan">
                    Harga Satuan
                </label>
                <span class="help-block"></span>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Radios" id="Radios" value="total">
                <label class="form-check-label" for="is_total">
                    Harga Total
                </label>
                <span class="help-block"></span>
            </div>
          </div>
          <div class="form-group">
              <textarea class="form-control" rows="5" id="comment" placeholder="Deskripsi" name="desc" id="desc"></textarea>
              <span class="help-block"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="btnSave" onclick="save()"  class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
