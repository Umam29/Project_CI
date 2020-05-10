      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Retail Business Consumer Solution <?=date('Y');?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?=base_url('auth/logout');?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url();?>assets/vendor/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url();?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?=base_url();?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url();?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <!-- <script src="<?=base_url();?>assets/js/demo/datatables-demo.js"></script> -->

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    $('.custom-file-input').on('change', function(){
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    $('.form-check-input').on('click', function() {
      const menuId = $(this).data('menu');
      const roleId = $(this).data('role');

      $.ajax({
        url: "<?=base_url('admin/changeaccess');?>",
        type: 'post',
        data: {
          menuId: menuId,
          roleId: roleId
        },
        success: function() {
          document.location.href = "<?=base_url('admin/roleaccess/');?>" + roleId;
        }
      });
    });

    $(document).ready(function() {
      var table = $('#dataTable').DataTable({
        buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
                dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-5 text-center'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    searchable: false
                }]
      });

      table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');

    })

    $(document).ready(function() {
      $( "#date_stock" ).datepicker({
        dateFormat: 'dd/mm/yy',
        // startDate: '-3d'
        changeMonth:true,
        changeYear:true
      });
      $( "#date_stock" ).datepicker("setDate", "today");
    } );

    $(document).ready(function(){
      $(document).on('click', '#select', function() {
        var id = $(this).data('id');
        var stuff_code = $(this).data('code');
        var name = $(this).data('name');
        var satuan = $(this).data('unit');
        var stock = $(this).data('stock');
        var price = $(this).data('price');
        $('#id').val(id);
        $('#code').val(stuff_code);
        $('#stuff_name').val(name);
        $('#unit').val(satuan);
        $('#stock').val(stock);
        $('#price').val(price);
        $('#searchStuff').modal('hide');
      })

      $(document).on('click', '#select_product', function() {
        var id = $(this).data('id');
        var product_code = $(this).data('product_code');
        var product_name = $(this).data('name');
        var price = $(this).data('price');
        $('#id').val(id);
        $('#product_code').val(product_code);
        $('#product_name').html(product_name);
        $('#price').html(price);
        $('#searchProduct').modal('hide');
      })

      $(document).on('click', '#add_cart', function(){
        var id = $('#id').val();
        var product_code = $('#product_code').val();
        var product_name = $('#product_name').text();
        var price = $('#price').text();
        var qty = $('#qty').val();
        if (product_code != '' && qty != '' && qty > 0) {
          $.ajax({
            url:"<?= base_url(); ?>cashier/addCart",
            method:"POST",
            data:{id:id, product_code:product_code, product_name:product_name, price:price, qty:qty},
            success:function(data) {
              $('#cart_details').html(data);
              $('#product_code').val('');
              $('#product_name').text('');
              $('#price').text('');
              $('#qty').val('');
            }
          });
        } else {
          alert("please enter product code & quantity");
        }
      });

      $('#cart_details').load("<?= base_url(); ?>cashier/loadCart");

      $(document).on('click', '.remove_inventory', function(){
        var row_id = $(this).attr("id");
        if(confirm("Are you sure?")) {
          $.ajax({
            url:"<?= base_url(); ?>cashier/removeCart",
            method:"POST",
            data:{row_id:row_id},
            success:function(data) {
              $('#cart_details').html(data);
            }
          });
        } else {
          return false;
        }
      })
    })

    $(document).on('keyup', '#qty', function() {
            let totalStok = parseInt($('#price').val()) * parseInt(this.value);
            $('#total').val(Number(totalStok));
        });

    // $(document).ready(function(){
	  //   // Format mata uang.
	  //   $( '#price' ).mask('000,000,000,000,000.00', {reverse: true});
	  //   $( '#stock' ).mask('000,000,000,000,000.00', {reverse: true});
	  //   $( '#harga_edit' ).mask('000.000.000.000.000,00', {reverse: true});
	  //   $( '#jumlah_edit' ).mask('000.000.000.000.000,00', {reverse: true});
	  // })

    // $(document).ready(function(){
    //   function load_data()
    //   {
    //     $.ajax({
    //       url:"<?php echo base_url(); ?>transaction/loadDataPurchase",
    //       dataType:"JSON",
    //       success:function(data){
    //         var html;
    //         // html += '<td id="first_name" contenteditable placeholder="Enter First Name"></td>';
    //         // html += '<td id="last_name" contenteditable placeholder="Enter Last Name"></td>';
    //         // html += '<td id="age" contenteditable></td>';
    //         // html += '<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span></button></td></tr>';
    //         for(var count = 0; count < data.length; count++)
    //         {
    //           html += '<tr>';
    //           html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="name">'+data[count].nama_barang+'</td>';
    //           html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="code">'+data[count].stuff_code+'</td>';
    //           html += '<td class="table_data" data-row_id="'+data[count].id+'" data-column_name="unit">'+data[count].satuan+'</td>';
    //           html += '<td><button type="button" name="delete_btn" id="'+data[count].id+'" class="btn btn-danger btn_delete"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
    //         }
    //         $('tbody').html(html);
    //       }
    //     });
    //   }

    //   load_data();
    // });

    // $(document).ready(function(){
    //     $("#add").click(function(){
    //         var code = $("#kode").val();
    //         var tgl = $("#tgl").val();
    //         var barang = $("#barang").val();
    //         var cat = $( "#kategori option:selected" ).text();
    //         var harga = $("#harga").val();
    //         // var jumlah = $("#jumlah").val();
    //         // var id_satuan = $("#id_satuan").val();
    //         // var desc = $("#desc").val();
    //         var markup = "<tr><td><input type='checkbox' name='record'></td><td>"
    //         + code + "</td><td>" + tgl + "</td><td>"  + barang + "</td></tr>" + kategori + "</td></tr>" + harga + "</td></tr>";
    //             // + jumlah + "</td></tr>"
    //             // + id_satuan + "</td></tr>"
    //             // + desc + "</td></tr>";
    //         $("table tbody").append(markup);

    //         // alert($( "#kategori" ).val());
    //         // $("#hasil").append(barang);

    //         $("#kode").val('');
    //         $("#tgl").val('');
    //         $("#barang").val('');
    //         $("#kategori").val('');
    //         $("#harga").val('');
    //         // $("#jumlah").val('');
    //         // $("#id_satuan").val('');
    //         // $("#desc").val('');
    //     });

    //     // Find and remove selected table rows
    //     $(".delete-row").click(function(){
    //         $("table tbody").find('input[name="record"]').each(function(){
    //             if($(this).is(":checked")){
    //                 $(this).parents("tr").remove();
    //             }
    //         });
    //     });
    // });

  </script>

</body>

</html>
