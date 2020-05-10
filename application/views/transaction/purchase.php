<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

  <?= $this->session->flashdata('message');?>

  <div class="card shadow mb-4">
    <div class="card-header">
      <a href="" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-plus"></i> Add</a>
    </div>
      <?= form_error('menu', '<div class="alert alert-danger" role="alert">' ,'</div>');?>
      
      <div class="card-body">  
      <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspasing="0">
        <thead>
          <tr>
            <th scope="col">Kode Barang</th>
            <th scope="col">Tanggal Beli</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Kategori</th>
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
              <td><?= $t['stuff_code']; ?></td>
              <td><?= date("d-n-Y", strtotime($t['tgl_beli'])); ?></td>
              <td><?= $t['nama_barang']; ?></td>
              <td><?= $t['category']; ?></td>
              <td><?= number_format($t['jumlah'],2,',','.'); ?></td>
              <td><?= $t['satuan']; ?></td>
              <td><?= "Rp " . number_format($t['harga_satuan'],2,',','.'); ?></td>
              <td><?= "Rp " . number_format($t['harga_total'],2,',','.'); ?></td>              
              <td><?= $t['deskripsi']; ?></td>
              <td>
                <a href="" class="badge badge-warning" data-toggle="modal" data-target="#modal_edit<?php echo $t['id'];?>">edit</a>
                <a href="<?= base_url(); ?>transaction/deleteTrxBeli/<?= $t['id'];?>" class="badge badge-danger" onclick="return confirm('Are you sure?');">delete</a>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('transaction/addbeli')?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Kode" name="kode" id="kode">
          </div>
          <div class="form-group">
            <input type="date" class="form-control" name="tgl" id="tgl">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Barang" name="barang" id="barang">
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="kategori" id="kategori" class="form-control">
                <option value="">Pilih Kategori</option>
                    <?php foreach ($category as $c) : ?>
                        <option value="<?= $c['id']; ?>"><?= $c['category']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Harga" name="harga" id="harga">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Jumlah Barang" name="jumlah" id="jumlah">
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="id_satuan" id="id_satuan" class="form-control">
                <option value="">Pilih Satuan</option>
                    <?php foreach ($satuan as $s) : ?>
                        <option value="<?= $s['id']; ?>"><?= $s['satuan']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>
          <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Radios" id="Radios" value="satuan">
                <label class="form-check-label" for="is_satuan">
                    Harga Satuan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Radios" id="Radios" value="total">
                <label class="form-check-label" for="is_total">
                    Harga Total
                </label>
            </div>
          </div>
          <div class="form-group">
              <textarea class="form-control" rows="5" id="comment" placeholder="Deskripsi" name="desc" id="desc"></textarea>
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
<?php foreach ($trx as $t) : ?>
<div class="modal fade" id="modal_edit<?php echo $t['id'];?>" tabindex="-1" role="dialog" aria-labelledby="EditStuffModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditStuffModalLabel">Tambah Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url()?>transaction/editpurchase/<?php echo $t['id'];?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Kode" name="kode_edit" id="kode_edit" value="<?php echo $t['stuff_code']; ?>" readonly>
          </div>
          <div class="form-group">
            <input type="date" class="form-control" name="tgl_edit" id="tgl_edit" value="<?php echo $t['tgl_beli']; ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Barang" name="barang_edit" id="barang_edit" value="<?php echo $t['nama_barang']; ?>">
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="kategori_edit" id="kategori_edit" class="form-control">
                <option value="">Pilih Kategori</option>
                    <?php foreach ($category as $c) : ?>
                    <option value="<?= $c['id']; ?>" <?php if ($t['category_id'] == $c['id']) : ?>selected<?php endif; ?>><?= $c['category']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Harga" name="harga_edit" id="harga_edit">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Jumlah Barang" name="jumlah_edit" id="jumlah_edit" value="<?php echo $t['jumlah']; ?>">
          </div>
          <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" name="id_satuan_edit" id="id_satuan_edit" class="form-control">
                <option value="">Pilih Satuan</option>
                    <?php foreach ($satuan as $s) : ?>
                        <option value="<?= $s['id']; ?>" <?php if ($t['id_satuan'] == $s['id']) : ?>selected<?php endif; ?>><?= $s['satuan']; ?></option>
                    <?php endforeach;?>
                </select>
          </div>
          <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Radios_edit" id="Radios_edit" value="satuan">
                <label class="form-check-label" for="is_satuan">
                    Harga Satuan
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Radios_edit" id="Radios_edit" value="total">
                <label class="form-check-label" for="is_total">
                    Harga Total
                </label>
            </div>
          </div>
          <div class="form-group">
              <textarea class="form-control" rows="5" placeholder="Deskripsi" name="desc_edit" id="desc_edit"></textarea>
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