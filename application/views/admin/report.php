<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
</div>

<div class="row">
	<div class="col-lg-12">
		<table
			class="table table-striped table-bordered"
		>
			<thead>
				<tr>
					<th style="text-align:center;width:40px;">No</th>
					<th>Report</th>
					<th style="width:100px;text-align:center;">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="text-align:center;vertical-align:middle">1</td>
					<td style="vertical-align:middle;">Report Stuff</td>
					<td style="text-align:center;">
						<a
							class="btn btn-sm btn-default"
							href="<?php echo base_url().'admin/reportStuff'?>"
							target="_blank"
						>
							<span class="fa fa-print"></span> Print
						</a>
					</td>
				</tr>

				<tr>
					<td style="text-align:center;vertical-align:middle">2</td>
					<td style="vertical-align:middle;">Report Product</td>
					<td style="text-align:center;">
						<a
							class="btn btn-sm btn-default"
							href="<?php echo base_url().'admin/reportProduct'?>"
							target="_blank"
						>
							<span class="fa fa-print"></span> Print
						</a>
					</td>
				</tr>

				<tr>
					<td style="text-align:center;vertical-align:middle">3</td>
					<td style="vertical-align:middle;">Report Sales</td>
					<td style="text-align:center;">
						<a
							class="btn btn-sm btn-default"
							href="<?php echo base_url().'admin/reportSales'?>"
							target="_blank"
						>
							<span class="fa fa-print"></span> Print
						</a>
					</td>
				</tr>

				<tr>
					<td style="text-align:center;vertical-align:middle">4</td>
					<td style="vertical-align:middle;">Report Sales Per Date</td>
					<td style="text-align:center;">
						<a
							class="btn btn-sm btn-default"
							href="#report_date"
							data-toggle="modal"
						>
							<span class="fa fa-print"></span> Print
						</a>
					</td>
				</tr>

				<tr>
					<td style="text-align:center;vertical-align:middle">5</td>
					<td style="vertical-align:middle;">Report Sales Per Month</td>
					<td style="text-align:center;">
						<a
							class="btn btn-sm btn-default"
							href="#report_month"
							data-toggle="modal"
						>
							<span class="fa fa-print"></span> Print
						</a>
					</td>
				</tr>

				<tr>
					<td style="text-align:center;vertical-align:middle">6</td>
					<td style="vertical-align:middle;">Report Sales Per Year</td>
					<td style="text-align:center;">
						<a
							class="btn btn-sm btn-default"
							href="#report_year"
							data-toggle="modal"
						>
							<span class="fa fa-print"></span> Print
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

</div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- ============ MODAL BY DATE =============== -->
  <div class="modal fade" id="report_date" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Choose Month</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/reportSalesPerMonth'?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Month</label>
                        <input type="date" class="form-control" name="date" id="date">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-info"><span class="fa fa-print"></span> Print</button>
                </div>
            </form>
            </div>
            </div>
        </div>

<!-- ============ MODAL BY MONTH =============== -->
  <div class="modal fade" id="report_month" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Choose Month</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/reportSalesPerMonth'?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Month</label>
                        <select class="custom-select my-1 mr-sm-2" name="month" id="month" class="form-control" required>
                            <option value="">-- Select month --</option>
                            <?php foreach ($month as $m) : ?>
                                <option value="<?= $m['month']; ?>"><?= $m['month']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-info"><span class="fa fa-print"></span> Print</button>
                </div>
            </form>
            </div>
            </div>
        </div>

<!-- ============ MODAL BY YEAR =============== -->
<div class="modal fade" id="report_year" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Choose Year</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/reportSalesPerYear'?>" target="_blank">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Year</label>
                        <select class="custom-select my-1 mr-sm-2" name="year" id="year" class="form-control" required>
                            <option value="">-- Select year --</option>
                            <?php foreach ($year as $y) : ?>
                                <option value="<?= $y['year']; ?>"><?= $y['year']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-info"><span class="fa fa-print"></span> Print</button>
                </div>
            </form>
            </div>
            </div>
        </div>
