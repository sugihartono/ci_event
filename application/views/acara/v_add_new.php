<section id="main-content">
	<section class="wrapper"> 
		
		<h3><i class="fa fa-angle-right"></i> Data Acara</h3>
		
		<a class="btn_add btn btn-default btn-sm" href="<?php echo base_url(); ?>acara/all_list">
		<i class="fa fa-backward "></i> <?php echo BACK_CAPTION; ?></a>
		
		<div class="row mt">
			<div style="padding-left:5px;padding-left:5px" class="col-lg-12">
				<form method="post" class="form-horizontal style-form" name="frm" id="frm" action="<?php echo base_url(); ?>acara/do_add_new" novalidate="novalidate">
					<div style="padding:30px 10px 10px 10px;" class="form-panel">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Event No</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" readonly="" id="txt_no" name="txt_no">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Create Date</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Event Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txt_name" name="txt_name">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Purpose</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txt_no" name="txt_no">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Department</label>
							<div class="col-sm-3">
								<select id="cb_require" class="form-control" name="cb_require">
									<option value="1">Fashion</option>
									<option value="0" selected="">Supermarket</option>
								</select>
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label">Copy Bon</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Divisi</label>
							<div class="col-sm-10">
								<select id="cb_require" class="form-control" name="cb_require">
									<option value="1">Menswear</option>
									<option value="0" selected="">SnB</option>
									<option value="0" selected="">BnK</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Template</label>
							<div class="col-sm-3">
								<select id="cb_require" class="form-control" name="cb_require">
									<option value="1"></option>
								</select>
							</div>
							
							<div class="col-sm-6 pad-right">
								<label class="control-label">
									<input type="checkbox" id="txt_create_date" name="txt_create_date"> Setting promo diskon dilakukan oleh cabang
								</label>
							</div>
						</div>	
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Notes</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txt_notes" name="txt_notes">
							</div>
						</div>
						
					</div><!-- /content-panel -->
					
					<div style="padding:30px 10px 10px 10px;" class="form-panel">
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Supplier</label>
							<div class="col-sm-3">
								<select id="cb_require" class="form-control" name="cb_require">
									<option value="1"></option>
								</select>
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Supp Code</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" readonly id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Brand</label>
							<div class="col-sm-3">
								<select id="cb_require" class="form-control" name="cb_require">
									<option value="1"></option>
								</select>
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Brand Code</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" readonly id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">PLU</label>
							<div class="col-sm-3">
								<select id="cb_require" class="form-control" name="cb_require">
									<option value="1"></option>
								</select>
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Article</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" readonly id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Description</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txt_notes" name="txt_notes">
							</div>
							
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Start From</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">To</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Location</label>
							<div class="col-sm-10">
								<label class="control-label"><input type="checkbox" id="txt_create_date" name="txt_create_date"> Atrium</input></label>&nbsp;&nbsp;&nbsp;
								<label class="control-label"><input type="checkbox" id="txt_create_date" name="txt_create_date"> Counter</input></label>&nbsp;&nbsp;&nbsp;
								<label class="control-label"><input type="checkbox" id="txt_create_date" name="txt_create_date"> Area Promosi</input></label>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Event Note</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="txt_notes" name="txt_notes">
							</div>
							
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Tax</label>
							<div class="col-sm-10">
								<label class="control-label"><input type="radio" id="txt_create_date" name="txt_create_date"> PKP</input></label>&nbsp;&nbsp;&nbsp;
								<label class="control-label"><input type="radio" id="txt_create_date" name="txt_create_date"> NPKP</input></label>&nbsp;&nbsp;&nbsp;
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Disc 1</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Disc 2</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">% Yogya</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">% Supp</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Bruto Margin</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Nett Margin</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">SP</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Max</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
						</div>
						
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Target</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="txt_create_date" name="txt_create_date">
							</div>
							
							<div class="col-sm-7 pad-right">
								<label class="control-label">
									<input type="checkbox" id="txt_create_date" name="txt_create_date"> YMC
								</label>
							</div>
						</div>
						
						
						<div class="divider"></div>
						
						<div class="form-group">
							<div class="col-sm-12" style="float:right;">
								<button type="submit" class="btn btn-warning">
								<i class="fa fa-plus"></i> <?php echo ADD_CAPTION; ?></button>
								
								<button type="reset" class="btn btn-success">
									<i class="fa fa-rotate-left"></i>
								<?php echo CANCEL_CAPTION; ?></button>
								
								<button type="submit" class="btn btn-theme02">
								<i class="fa fa-save"></i> <?php echo SAVE_CAPTION; ?></button> 
							</div>
						</div>
						
						
					</div>
					
					<div class="form-panel" style="padding:10px;">
						<section id="unseen">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-condensed" id="datatableX">
									<thead>
										<tr>
											<th class="sequence">Supp</th>
											<th>PLU</th>
											<th>From</th>
											<th>To</th>
											<th>Store</th>
											<th>Disc1</th>
											<th>Disc2</th>
											<th>Margin Type</th>
											<th>Margin</th>
											<th>%Yogya</th>
											<th>%Supp</th>
											<th>SP</th>
											<th class="action">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											
											for ($i=1; $i<=5; $i++){
												
											?>
											<tr>
												<td>Cardinal</td>
												<td>19201212</td>
												<td>01-08-15</td>
												<td>31-08-15</td>
												<td>YRI</td>
												<td>20</td>
												<td>0</td>
												<td>PKP</td>
												<td>27</td>
												<td>68</td>
												<td>68</td>
												<td>99900</td>
												<td>
													<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs'>
														<i class='fa fa-trash-o'></i> <?php echo DELETE_CAPTION; ?>
													</a>
												</td>
											</tr>
											<?php
												
											}
										?>
									</tbody>
								</table>
							</div><!-- end div responsive -->
						</section>
						
						
					</div><!-- /content-panel -->
					
				</div><!-- /content-panel -->
				
			</div><!-- /col-lg-12 -->			
			<!--	  </div> /row -->
			
		</form>   
		
		
		
		
	</div></section>	