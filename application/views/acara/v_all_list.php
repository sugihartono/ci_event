

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
										<th>No Surat</th>
										<th>Tujuan</th>
										<th>Hal</th>
										<th class="action">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										
										foreach ($list as $r) :
											
									?>
										<tr>
											<td><?php echo $r->event_no; ?></td>
											<td><?php echo $r->toward; ?></td>
											<td><?php echo $r->about; ?></td>
											<td>
												<a href="<?php echo base_url(); ?>acara/preview/<?php echo $r->id; ?>" class='btn_update btn btn-xs'>
													<i class='fa fa-search'></i> <?php echo PREVIEW_CAPTION; ?>
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
										
										
										
										
										
																				