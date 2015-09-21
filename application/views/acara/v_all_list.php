

<section id="main-content">
	<section class="wrapper">
		
		<h3><i class="fa fa-angle-right"></i> Data Acara</h3>
		
		<a href="<?php echo base_url(); ?>acara/add" class="btn_add btn btn-default btn-sm">
		<i class="fa fa-plus-square"></i> <?php echo ADD_CAPTION; ?></a>
		
		<div class="row mt">
			<div class="col-lg-12" style="padding-left:5px;padding-left:5px">
				<div class="form-panel" style="padding:10px;">
					<section id="unseen">
						<div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed" id="datatable">
								<thead>
									<tr>
										<th>id</th>
										<th>No Surat</th>
										<th>Tujuan</th>
										<th>Hal</th>
										<th>Created Date</th>
										<th class="action">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										

										foreach ((array)$list as $r) :

											
									?>
										<tr>
											<td><?php echo $r->id; ?></td>
											<td><?php echo $r->event_no; ?></td>
											<td><?php echo $r->toward; ?></td>
											<td><?php echo $r->about; ?></td>
											<td><?php echo $r->created_date; ?></td>
											<td>
												<a href="<?php echo base_url(); ?>acara/edit/<?php echo $r->id; ?>" class='btn_update btn btn-xs' title="edit">
													<i class='fa fa-pencil'></i> 
												</a>&nbsp;
												<a href='#deleteConfirm' data-id='<?php echo $r->id; ?>' data-letter_number='<?php echo $r->event_no; ?>' data-toggle='modal' class='btn_update btn btn-xs deleteTrigger' title="delete">
													<i class='fa fa-trash-o'></i> 
												</a>&nbsp;
												<a href="<?php echo base_url(); ?>acara/preview/<?php echo $r->id; ?>" class='btn_update btn btn-xs' title="preview">
													<i class='fa fa-search'></i>
												</a>
											</td>
										</tr>
									<?php
										
										endforeach; 
										
									?>
								</tbody>
							</table>
						</div><!-- end div responsive -->
					</section>
										
										
				</div><!-- /content-panel -->
			</div><!-- /col-lg-4 -->			
		<!--	  	</div> /row -->
										
										
<!-- delete confirmation -->
<div id="deleteConfirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalAlertLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 400px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="myModalDeleteConfirmLabel" class="modal-title">Konfirmasi Penghapusan</h4>
            </div>
            <div class="modal-body">
                <p>
                    Surat dengan nomor <span id="letterNumber" style="font-weight: bold;"></span> akan dihapus.
                    <br>Lanjutkan?
                </p>
                <p><input type="hidden" name="idToDelete" id="idToDelete" value="">&nbsp;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default confirmOk">&nbsp; Yes &nbsp;</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">&nbsp; No &nbsp;</button>
            </div>
        </div>
    </div>
</div>
										
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/acara.list.js"></script>							
																				