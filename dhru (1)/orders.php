<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css'); ?>
<?php $one->get_css('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css'); ?>
<?php $one->get_css('js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
      <div class="flex-grow-1">
        <h1 class="h3 fw-bold mb-2">
          Orders
        </h1>
        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
          You can see your orders history
        </h2>
      </div>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a class="link-fx" href="javascript:void(0)">Orders</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">
            History
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
  <!-- Dynamic Table Responsive -->
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        Orders <small>History</small>
      </h3>
      <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
          <i class="si si-refresh"></i>
      </button>
    </div>
    <div class="block-content block-content-full">
      <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
      <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
        <thead>
          <tr>
            <th style="width: 5%;">ID</th>
            <th style="width: 40%;">Services</th>
            <th style="width: 20%;">IMEI</th>
            <th style="width: 14%;">Price</th>
			<th style="width: 10%;">Status</th>
			<th style="width: 11%;">Registered</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
		<?php
		  $no = 1;
		  if($result['level'] == 1)
		  {
			$check_orders = mysqli_query($con,"SELECT * FROM `apiorders` ORDER BY `id` DESC");
		  }
		  else
		  {
			$check_orders = mysqli_query($con,"SELECT * FROM `apiorders` WHERE `username` = '$username' ORDER BY `id` DESC"); 
		  }
		  while($ordr = mysqli_fetch_assoc($check_orders)){
		?>
          <tr>
            <td class="fs-sm"><?php echo $no; ?></td>
            <td class="fw-semibold fs-sm"><?php echo $ordr['services'];?></td>
            <td class="fs-sm"><?php echo $ordr['imei'];?></td>
            <td class="fs-sm">$<?php echo $ordr['price'];?> USD</td>
            <td>
			<?php
			if($ordr['reply'] == 'Reject')
			{
				echo '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Reject</span>';
			}
			else
			{
				echo '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">Success</span>';
			}
			?>
            </td>
			<td class="fs-sm"><?php echo $ordr['username'];?></td>
			<td class="text-center">
				<div class="btn-group">
				  <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#order-view<?php echo $ordr['id'];?>">
					<i class="fa fa-fw fa-eye"></i>
				  </button>
				  <?php
				  if($result['level'] == 1)
				  {
					echo '<button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#order-delete';echo $ordr['id'];echo '">
                    <i class="fa fa-fw fa-times"></i>
					</button>';
				  }
				  ?>
					
				</div>
			  </td>
          </tr>
        <?php
		    $no++;
			include 'inc/order.action.php';
		  }
		?>
		</tbody>
      </table>
    </div>
  </div>
  <!-- Dynamic Table Responsive -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- jQuery (required for DataTables plugin) -->
<?php $one->get_js('js/lib/jquery.min.js'); ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/dataTables.buttons.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-jszip/jszip.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/buttons.print.min.js'); ?>
<?php $one->get_js('js/plugins/datatables-buttons/buttons.html5.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_tables_datatables.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
