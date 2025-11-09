<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo36@2x.jpg');">
  <div class="bg-black-50">
    <div class="content content-full text-center">
      <div class="my-3">
        <?php $one->get_avatar(13, '', false, true); ?>
      </div>
      <h1 class="h2 text-white mb-0"><?php echo $result['username'];?></h1>
      <span class="text-white-75"><?php echo $result['email'];?></span>
    </div>
  </div>
</div>
<!-- END Hero -->

<!-- Stats -->
<div class="bg-body-extra-light">
  <div class="content content-boxed">
    <div class="row items-push text-center">
      <div class="col-6 col-md-6">
        <div class="fs-sm fw-semibold text-muted text-uppercase">Balance</div>
        <a class="link-fx fs-3" href="javascript:void(0)">$<?php echo $result['credit'];?> USD</a>
      </div>
      <div class="col-6 col-md-6">
        <div class="fs-sm fw-semibold text-muted text-uppercase">Orders</div>
        <a class="link-fx fs-3" href="javascript:void(0)"><?php echo $get;?></a>
      </div>
    </div>
  </div>
</div>
<!-- END Stats -->

<!-- Page Content -->
<div class="content content-boxed">
  <div class="row">
    <div class="col-md-12 col-xl-12">
      <!-- Products -->
      <div class="block block-rounded">
        <div class="block-header block-header-default">
          <h3 class="block-title">
            <i class="fa fa-circle-user text-muted me-1"></i> Accounts
          </h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
              <i class="si si-refresh"></i>
            </button>
          </div>
        </div>
        <div class="block-content">
		<form action="profile.php?id=<?php echo $result['id'];?>" method="POST">
          <div class="d-flex align-items-center push">
			<div class="flex-shrink-0 me-3">
              <div class="item item-rounded-lg bg-body-light">
				<i class="si si-users fs-3 text-primary"></i>
			  </div>
            </div>
            <div class="flex-grow-1">
              <div class="fw-semibold">Username</div>
              <div class="fs-sm"><?php echo $result['username'];?></div>
            </div>
          </div>
          <div class="d-flex align-items-center push">
			<div class="flex-shrink-0 me-3">
              <div class="item item-rounded-lg bg-body-light">
				<i class="si si-envelope-letter fs-3 text-primary"></i>
			  </div>
            </div>
            <div class="flex-grow-1">
              <div class="fw-semibold">Email</div>
              <div class="fs-sm"><?php echo $result['email'];?></div>
            </div>
          </div>
		  <div class="d-flex align-items-center push">
            <div class="flex-shrink-0 me-3">
              <div class="item item-rounded-lg bg-body-light">
				<i class="si si-link fs-3 text-primary"></i>
			  </div>
            </div>
            <div class="flex-grow-1">
              <div class="fw-semibold">API Key</div>
              <div class="fs-sm"><?php echo $result['apiaccess'];?></div>
            </div>
          </div>
          <div class="d-flex align-items-center push">
            <div class="flex-shrink-0 me-3">
              <div class="item item-rounded-lg bg-body-light">
				<i class="si si-pointer fs-3 text-primary"></i>
			  </div>
            </div>
            <div class="flex-grow-1">
              <div class="fw-semibold">Country</div>
              <div class="fs-sm"><?php echo $result['country'];?></div>
            </div>
          </div>
		  <div class="d-flex align-items-center push">
            <div class="flex-shrink-0 me-3">
              <div class="item item-rounded-lg bg-body-light">
				<i class="si si-globe fs-3 text-primary"></i>
			  </div>
            </div>
            <div class="flex-grow-1">
              <div class="fw-semibold">IP</div>
              <div class="fs-sm"><?php echo $result['ip'];?></div>
            </div>
          </div>
          <div class="text-center push">
            <button type="submit" name="update-api" class="btn btn-sm btn-alt-secondary">
			  <i class="fa fa-fw fa-rotate me-1 opacity-50"></i> Renew Key
			</button>
          </div>
		</form>
        </div>
      </div>
      <!-- END Products -->
    </div>
  </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
