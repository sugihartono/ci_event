<style>
	/* overwrite */
	.alert {
	  padding: 10px;
	}
	/* end overwrite */
	.red-star {
		color: #FF0000;
	}
	.help-inline {
		color: #a94442;
	}
	.ui-autocomplete-loading {
		background: white url('<?php echo base_url(); ?>assets/images/ui-anim_basic_16x16.gif') right center no-repeat;
	}
</style>

<link href="<?php echo base_url(); ?>assets/css/themes/cupertino/jquery-ui-1.8.21.custom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	var arrStore = [];
	var arrLocation = [];
</script>

<section id="main-content">
	<section class="wrapper"> 
		
		<h3><i class="fa fa-angle-right"></i> Data Acara</h3>
		
		<a class="btn_add btn btn-default btn-sm" href="<?php echo base_url(); ?>acara/add">
		<i class="fa fa-backward "></i> <?php echo BACK_CAPTION; ?></a>
		
		<div class="row mt">
			<div style="padding-left:5px;padding-left:5px" class="col-lg-12">
				<form method="post" class="form-horizontal style-form" name="frmAcaraNext" id="frmAcaraNext" action="<?php echo base_url(); ?>acara/save"  novalidate="novalidate">
					
					<div class="alert alert-danger hide">
						<a class="close" data-dismiss="alert" href="#">&times;</a>
						<span id="alertMessage">&nbsp;</span>
					</div>
					
					<div style="padding:30px 10px 10px 10px;" class="form-panel">
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Supplier</label>
							<div class="col-sm-10 required">
								<input type="text" class="form-control" id="supplierCode" name="supplierCode">
							</div>	
						</div>
						
						<div class="form-group">
							
							<label class="col-sm-2 control-label">Kategori<span class="red-star"> *</span></label>
							<div class="col-sm-3 required">
								<select id="categoryCode" class="form-control" name="categoryCode">
									<option value="">Pilih kategori..</option>
									<?php
										foreach($categories as $category) {
									?>
										<option value="<?php echo $category->category_code; ?>"><?php echo $category->category_desc; ?></option>
									<?php
										}
									?>
								</select>
							</div>
							
							<label class="col-sm-1 control-label-right">Tillcode<span class="red-star"> *</span></label>
							<div class="col-sm-6 pad-right required">
								<input type="text" class="form-control" id="tillcode" name="tillcode">
							</div>
							
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Note</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="notes" name="notes">
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis Pertanggungan<span class="red-star"> *</span></label>
							<div class="col-sm-3 required">
								<select id="kindOfResponsibility" name="kindOfResponsibility"  class="form-control">
									<option value="5050">YDS 50% : Supplier 50%</option>
									<option value="4060">YDS 40% : Supplier 60%</option>
									<option value="0">Custom</option>
								</select>
							</div>
							
							<label class="col-sm-2 control-label-right">Tipe Margin<span class="red-star"> *</span> &nbsp;</label>
							<div class="col-sm-1 required">
								<select id="isPkp"  class="form-control">
									<option value="1">PKP</option>
									<option value="0">NPKP</option>
								</select>
							</div>
							
							<label class="col-sm-2 control-label-right">Margin<span class="red-star"> *</span> &nbsp;</label>
							<div class="col-sm-2 pad-right required">
								<input type="text" class="form-control" id="margin" name="margin">
							</div>
							
						</div>
						<div id="responsibilityHolder" style="display: none;">
							<div class="form-group">
								<label class="col-sm-2 control-label">Pert. Supplier<span class="red-star"> *</span></label>
								<div class="col-sm-1 required">
									<input type="text" class="form-control" id="supplierResponsibility" name="supplierResponsibility">
								</div>
								
								<label class="col-sm-1 control-label-right">Pert. Yogya<span class="red-star"> *</span></label>
								<div class="col-sm-1 pad-right required">
									<input type="text" class="form-control" id="ydsResponsibility" name="ydsResponsibility">
								</div>
							</div>
						</div>
						
						<!--
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Brutto Margin</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="bruttoMargin" name="bruttoMargin">
							</div>
							<label class="col-sm-1 col-sm-1 control-label-right">Net Margin</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="netMargin" name="netMargin">
							</div>
						</div>
						-->
						
						<div class="divider"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="eventStartDate" name="eventStartDate"  maxlength="10">
							</div>
							<label class="col-sm-1 control-label-right">s/d</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="eventEndDate" name="eventEndDate"  maxlength="10">
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<input type="checkbox" id="sameDate" name="sameDate"> &nbsp; <b>Daftar tanggal berlaku untuk semua tillcode dalam satu surat.</b>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12" style="float:right;">
								<button id="btnAddDate" type="button" class="btn btn-warning">
								<i class="fa fa-plus"></i> <?php echo ADD_DATE_CAPTION; ?></button>		
							</div>
						</div>
						
						<section id="unseen">
							<div class="add_detail table-responsive">
								<table class="table table-bordered table-striped table-condensed" id="datatableY">
									<thead>
										<tr>
											<th>Tillcode</th>
											<th>Tanggal</th>
											<th>s/d Tanggal</th>
											<th class="action">Action</th>
										</tr>
									</thead>
									<tbody>
											<tr id="dummyRowY">
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
									</tbody>
								</table>
							</div><!-- end div responsive -->
						</section>
						
						<div class="divider"></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Lokasi</label>
							<div class="col-sm-3">
								<select id="locationCode" class="form-control" name="locationCode">
									<option value="">Pilih lokasi..</option>
									<?php
										foreach($locations as $location) {
									?>
									<option value="<?php echo $location->loc_desc; ?>"><?php echo $location->loc_desc; ?></option>
									<?php
											echo "<script type='text/javascript'>";
											echo "arrLocation['" . $location->loc_desc . "'] = '" . $location->loc_code . "'";
											echo "</script>";
										}
									?>
								</select>
							</div>
							<label class="col-sm-1 control-label-right">Cabang</label>
							<div class="col-sm-6 pad-right">
								<select id="storeCode" class="form-control" name="storeCode">
									<option value="">Pilih cabang..</option>
									<?php
										foreach($stores as $store) {
									?>
										<option value="<?php echo $store->store_desc; ?>"><?php echo $store->store_desc . " (" . $store->store_init . ")"; ?></option>
									<?php
											echo "<script type='text/javascript'>";
											echo "arrStore['" . $store->store_desc . "'] = '" . $store->store_code . "'";
											echo "</script>";
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-6">
								<input type="checkbox" id="sameLocation" name="sameLocation"> &nbsp; <b>Daftar lokasi berlaku untuk semua tillcode dalam satu surat.</b>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-12" style="float:right;">
								<button id="btnAddLocation" type="button" class="btn btn-warning">
								<i class="fa fa-plus"></i> <?php echo ADD_LOCATION_CAPTION; ?></button>		
							</div>
						</div>
						
						<section id="unseen">
							<div class="add_detail table-responsive">
								<table class="table table-bordered table-striped table-condensed" id="datatableZ">
									<thead>
										<tr>
											<th>Tillcode</th>
											<th>Lokasi</th>
											<th>Cabang</th>
											<th class="action">Action</th>
										</tr>
									</thead>
									<tbody>
											<tr id="dummyRowZ">
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
									</tbody>
								</table>
							</div><!-- end div responsive -->
						</section>
						
						
						<div class="divider"></div>
						
						<div class="form-group">
							<div class="col-sm-12" style="float:right;">
								<button id="btnPoolTillcode" type="button" class="btn btn-warning">
								<i class="fa fa-plus"></i> <?php echo POOL_TILLCODE_CAPTION; ?></button>		
							</div>
						</div>
						
						<section id="unseen">
							<div class="add_detail table-responsive">
								<table class="table table-bordered table-striped table-condensed" id="datatableX">
									<thead>
										<tr>
											<th>Tillcode</th>
											<th>Supplier</th>
											<th>Pert. Supp</th>
											<th>Pert. Yogya</th>
											<th>Tipe Margin</th>
											<th>Margin</th>
											<th>Notes</th>
											<th class="action">Action</th>
										</tr>
									</thead>
									<tbody>
											<tr id="dummyRowX">
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
									</tbody>
								</table>
							</div><!-- end div responsive -->
						</section>
				
					</div>
					<!-- /.form-panel -->
					
					
					<div style="padding:30px 10px 10px 10px;" class="form-panel">
						
						<div class="form-group">
							<div class="col-sm-12" style="float:right;">
								<button id="btnReset" type="reset" class="btn btn-success">
									<i class="fa fa-rotate-left"></i>
								<?php echo CANCEL_CAPTION; ?></button>
								
								<button id="btnSubmit" type="submit" class="btn btn-theme02">
								<i class="fa fa-save"></i> <?php echo SAVE_CAPTION; ?></button> 
							</div>
						</div>
					
					</div>
					<!-- /.form-panel -->
					
				</div><!-- /content-panel -->
				
			</div><!-- /col-lg-12 -->			
			<!--	  </div> /row -->
			
		</form>   
		
	</div></section>

<input type="hidden" id="division" value="<?php echo $division; ?>">
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/autoNumeric.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/acara.js"></script>