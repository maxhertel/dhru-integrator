<!-- Modal View Order -->
          <div class="modal fade" id="order-view<?php echo $ordr['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Order History</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content fs-sm">
				    <div class="mb-2">
					  <p class="fs-sm text-muted text-center mb-1">
                      Service : <b class="fw-semibold fs-sm"><?php echo $ordr['services']; ?></b>
                      </p>
                      <p class="fs-sm text-muted text-center mb-1">
                      IMEI : <b class="fw-semibold fs-sm"><?php echo $ordr['imei']; ?></b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      Price : <b class="fw-semibold fs-sm">$<?php echo $ordr['price']; ?> USD</b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
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
    <!-- END Modal View Order -->
	
	<!-- Modal Delete Order -->
          <div class="modal fade" id="order-delete<?php echo $ordr['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
				  <form action="orders.php?id=<?php echo $ordr['id']?>" method="POST">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Order History</h3>
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
					<button type="submit" name="order-delete" class="btn btn-sm btn-primary" data-bs-dismiss="modal"><i class="si si-ban"></i> Delete</button>
                  </div>
				  </form>
                </div>
              </div>
            </div>
          </div>
    <!-- END Modal Delete Order -->