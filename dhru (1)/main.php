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
<div class="content">
  <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
    <div class="flex-grow-1 mb-1 mb-md-0">
      <h1 class="h3 fw-bold mb-2">
        Dashboard
      </h1>
      <h2 class="h6 fw-medium fw-medium text-muted mb-0">
        Welcome <a class="fw-semibold" href="be_pages_generic_profile.php"><?php echo $result['username'];?></a>, everything looks great.
      </h2>
    </div>
  </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
  <!-- Overview -->
  <div class="row items-push">
    <div class="col-sm-6 col-xxl-6">
      <!-- Pending Orders -->
      <div class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <dt class="fs-3 fw-bold">$<?php echo $result['credit'];?> USD</dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Available Balance</dd>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="fa fa-money-check-dollar fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END Pending Orders -->
    </div>
    <div class="col-sm-6 col-xxl-6">
      <!-- New Customers -->
      <div class="block block-rounded d-flex flex-column h-100 mb-0">
        <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
          <dl class="mb-0">
            <dt class="fs-3 fw-bold"><?php echo $get;?></dt>
            <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Order History</dd>
          </dl>
          <div class="item item-rounded-lg bg-body-light">
            <i class="fa fa-clipboard-list fs-3 text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END New Customers -->
    </div>
  </div>
  <!-- END Overview -->
  
  <!-- Alternative Style -->
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">API Information</h3>
	  <div class="block-options">
          <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
            <i class="si si-refresh"></i>
          </button>
      </div>
    </div>
    <div class="block-content block-content-full">
      <form action="" method="POST" onsubmit="return false;">
        <div class="row">
          <div class="col-lg-4">
            <p class="fs-sm text-muted">
              You can connect your api access to your dhru fusion web
            </p>
          </div>
          <div class="col-lg-8 col-xl-5">
            <div class="mb-4">
              <label class="form-label" for="example-text-input-alt">Username</label>
              <input type="text" class="form-control form-control-alt" id="example-text-input-alt" name="example-text-input-alt" value="<?php echo $result['username'];?>" disabled>
            </div>
            <div class="mb-4">
              <label class="form-label" for="example-api-input-alt">API Key</label>
              <input type="text" class="form-control form-control-alt" id="example-api-input-alt" name="example-api-input-alt" value="<?php echo $result['apiaccess'];?>" disabled>
            </div>
            <div class="mb-4">
              <label class="form-label" for="example-textarea-input-alt">API Server</label>
              <textarea class="form-control form-control-alt" id="example-textarea-input-alt" name="example-textarea-input-alt" rows="3" disabled>https://<?php echo $_SERVER['SERVER_NAME'];$loc = str_replace("main.php","api.php", $path); echo $loc;?></textarea>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- END Alternative Style -->
  <?php
    if($result['level'] == 1)
	{
		include 'inc/clientlist.php';
	}
  ?>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/chart.js/chart.min.js'); ?>

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

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_pages_dashboard.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
