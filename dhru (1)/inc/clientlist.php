  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">Users Information</h3>
	  <div class="block-options">
          <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
            <i class="si si-refresh"></i>
          </button>
      </div>
    </div>
    <div class="block-content block-content-full">
      <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
      <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
        <thead>
          <tr>
            <th style="width: 5%;">ID</th>
            <th style="width: 30%;">Username</th>
            <th style="width: 44%;">Email</th>
			<th style="width: 10%;">Status</th>
			<th style="width: 11%;">Balance</th>
            <th class="text-center" style="width: 100px;">Actions</th>
          </tr>
        </thead>
        <tbody>
		<?php
		  $no = 1;
		  $check_users = mysqli_query($con,"SELECT * FROM `apiusers` ORDER BY `id` DESC");
		  while($usr = mysqli_fetch_assoc($check_users)){
		?>
          <tr>
            <td class="fs-sm"><?php echo $no; ?></td>
            <td class="fw-semibold fs-sm"><?php echo $usr['username'];?></td>
            <td class="fs-sm"><?php echo $usr['email'];?></td>
            <td>
              <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success"><?php if($usr['level'] == "1"){echo 'Admin';}else{echo 'Reseller';}?></span>
            </td>
			<td class="fs-sm">$<?php echo $usr['credit'];?> USD</td>
			<td class="text-center">
				<div class="btn-group">
                  <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#user-view<?php echo $usr['id'];?>">
                    <i class="fa fa-fw fa-eye"></i>
                  </button>
				  <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#user-edit<?php echo $usr['id'];?>">
                    <i class="fa fa-fw fa-pencil"></i>
                  </button>
                  <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal" data-bs-target="#user-delete<?php echo $usr['id'];?>">
                    <i class="fa fa-fw fa-times"></i>
                  </button>
                </div>
			</td>
          </tr>
        <?php
		    $no++;
			include 'inc/clientlist.action.php';
		  }
		?>
		</tbody>
      </table>
    </div>
  </div>