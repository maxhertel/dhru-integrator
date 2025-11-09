	<!-- Modal View Services -->
          <div class="modal fade" id="service-view<?php echo $serv['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Service Information</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content fs-sm">
				    <div class="mb-2">
					  <p class="fs-sm text-muted text-center mb-1">
                      Service : <b class="fw-semibold fs-sm"><?php echo $serv['services']; ?></b>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      Price : <b class="fw-semibold fs-sm">$<?php echo $serv['price']; ?> USD</b>
                      </p>
                      <p>
                          <textarea class="form-control form-control-alt" id="service-info" rows="7" disabled><?php echo $serv['info']; ?></textarea>
                      </p>
					  <p class="fs-sm text-muted text-center mb-1">
                      <?php if($serv['status'] == 1){echo '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Actived</span>';}else{echo '<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Deactived</span>';}?>
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
    <!-- END Modal View Services -->
	
	<!-- Modal Edit Services -->
          <div class="modal fade" id="service-edit<?php echo $serv['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
				  <form action="services.php?id=<?php echo $serv['id']?>" method="POST">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Service Information</h3>
                    <div class="block-options">
                      <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="block-content fs-sm">
				    <div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Service</label>
					  <input type="text" class="form-control form-control-alt" id="service-name" name="service-name" value="<?php echo $serv['services'];?>">
					</div>
					<div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Price</label>
					  <input type="number" class="form-control form-control-alt" id="service-price" name="service-price" value="<?php echo $serv['price'];?>">
					</div>
					<div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">API</label>
					  <input type="text" class="form-control form-control-alt" id="service-api" name="service-api" value="<?php echo $serv['link'];?>">
					</div>
					<div class="mb-4">
					  <label class="form-label" for="example-text-input-alt">Status</label>
					  <input type="text" class="form-control form-control-alt" id="service-status" name="service-status" value="<?php if($serv['status'] == 1){echo "Actived";}else{echo "Deactived";}?>">
					</div>
				  </div>
                  <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="service-update" class="btn btn-sm btn-primary" data-bs-dismiss="modal"><i class="si si-reload"></i> Update</button>
                  </div>
				  </form>
                </div>
              </div>
            </div>
          </div>
    <!-- END Modal Edit Services -->
	
	<!-- Modal Delete Services -->
          <div class="modal fade" id="service-delete<?php echo $serv['id'];?>" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
				  <form action="services.php?id=<?php echo $serv['id']?>" method="POST">
                  <div class="block-header block-header-default">
                    <h3 class="block-title">Service Information</h3>
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
					<button type="submit" name="service-delete" class="btn btn-sm btn-primary" data-bs-dismiss="modal"><i class="si si-ban"></i> Delete</button>
                  </div>
				  </form>
                </div>
              </div>
            </div>
          </div>
    <!-- END Modal Delete Services -->