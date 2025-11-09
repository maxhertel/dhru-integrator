	<!-- Modal View Users -->
          <div class="modal fade" id="user-view<?php echo $usr['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">User Information</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content fs-sm">
				    <div class="mb-2">
					  <p class="fs-sm text-muted text-center mb-1">
                      Username : <b class="fw-semibold fs-sm"><?php echo $usr['username']; ?></b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      Email : <b class="fw-semibold fs-sm"><?php echo $usr['email']; ?></b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      Status : <b class="fw-semibold fs-sm"><?php if($usr['level'] == 1){echo "Admin";}else{echo "Reseller";} ?></b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      Balance : <b class="fw-semibold fs-sm">$<?php echo $usr['credit']; ?> USD</b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      API KEY : <b class="fw-semibold fs-sm"><?php echo $usr['apiaccess']; ?></b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      Country : <b class="fw-semibold fs-sm"><?php echo $usr['country']; ?></b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      IP : <b class="fw-semibold fs-sm"><?php echo $usr['ip']; ?></b>
                      </p>
                    </div>
				  </div>
                  <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <!-- END Modal View Users -->
	
	<!-- Modal Edit Users -->
          <div class="modal fade" id="user-edit<?php echo $usr['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
				  <form action="main.php?id=<?php echo $usr['id']?>" method="POST">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">User Information</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content fs-sm">
				    <div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Balance</label>
					  <input type="number" class="form-control form-control-alt" id="user-balance" name="user-balance" value="<?php echo $usr['credit'];?>">
					</div>
				  </div>
                  <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="user-update" class="btn btn-sm btn-primary" data-bs-dismiss="modal"><i class="si si-reload"></i> Update</button>
                  </div>
				  </form>
                </div>
              </div>
            </div>
          </div>
    <!-- END Modal Edit Users -->
	
	<!-- Modal View Users -->
          <div class="modal fade" id="user-delete<?php echo $usr['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
				  <form action="main.php?id=<?php echo $usr['id']?>" method="POST">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">User Information</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content fs-sm">
				    <div class="mb-2">
					  <h3 class="fw-semibold fs-m text-center">
						Are you sure want to delete ?
                      </h3>
                    </div>
				  </div>
                  <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="user-delete" class="btn btn-sm btn-primary" data-bs-dismiss="modal"><i class="si si-ban"></i> Delete</button>
                  </div>
				  </form>
                </div>
              </div>
            </div>
          </div>
    <!-- END Modal View Users -->