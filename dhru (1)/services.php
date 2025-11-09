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
          Services
        </h1>
        <h2 class="fs-base lh-base fw-medium text-muted mb-0">
          You can see the active services.
        </h2>
      </div>
      <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-alt">
          <li class="breadcrumb-item">
            <a class="link-fx" href="javascript:void(0)">Services</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">
            Active
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
  <!-- Full Table -->
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">API Services</h3>
      <div class="block-options">
        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
            <i class="si si-refresh"></i>
        </button>
		<?php
		  if($result['level'] == 1)
		  {
			echo '<button type="button" class="btn-block-option" data-bs-toggle="modal" data-bs-target="#modal-services">
				  <i class="si si-plus"></i>
				  </button>';
		  }
		?>
      </div>
    </div>
    <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 60%;">Services</th>
              <th style="width: 14%;">Price</th>
			  <th style="width: 11%;">Status</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
		  <?php
			$no = 1;
			$check_serices = mysqli_query($con,"SELECT * FROM `apiservices`");
			while($serv = mysqli_fetch_assoc($check_serices)){
		  ?>
            <tr>
              <td>
                <?php echo $no; ?>
              </td>
              <td class="fw-semibold fs-sm">
                <?php echo $serv['services'];?>
              </td>
              <td class="fs-sm">$<?php echo $serv['price'];?> USD</td>
              <td>
				<?php
				if($serv['status'] == 1)
				{
					echo '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Actived</span>';
				}
				else
				{
					echo '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Deactived</span>';
				}
				?>
              </td>
			  <td class="text-center">
				<div class="btn-group">
				  <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#service-view<?php echo $serv['id'];?>">
					<i class="fa fa-fw fa-eye"></i>
				  </button>
				  <?php
				  if($result['level'] == 1)
				  {
					echo '<button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#service-edit';echo $serv['id'];echo'">
                    <i class="fa fa-fw fa-pencil"></i>
                  </button>
					<button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#service-delete';echo $serv['id'];echo'">
                    <i class="fa fa-fw fa-times"></i>
					</button>';
				  }
				  ?>
				</div>
			  </td>
            </tr>
		  <?php
			  $no++;
			  include 'inc/services.action.php';
			}
		  ?>
          </tbody>
        </table>
        <!-- Fade In Block Modal -->
          <div class="modal fade" id="modal-services" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
				  <form action="services.php" method="POST">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Add Services</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content fs-sm">
				    <div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Service</label>
					  <input type="text" class="form-control form-control-alt" id="service-name" name="service-name">
					</div>
					<div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Information</label>
					  <textarea class="form-control form-control-alt" id="service-info" name="service-info" rows="7"></textarea>
					</div>
					<div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Price</label>
					  <input type="number" class="form-control form-control-alt" id="service-price" name="service-price">
					</div>
					<div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Api</label>
					  <input type="text" class="form-control form-control-alt" id="service-api" name="service-api">
					</div>
				  </div>
                  <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="service-add" class="btn btn-sm btn-primary" data-bs-dismiss="modal"><i class="si si-plus"></i> Add</button>
                  </div>
				  </form>
                </div>
              </div>
            </div>
          </div>
        <!-- END Fade In Block Modal -->
    </div>
  </div>
  <!-- END Full Table -->
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
