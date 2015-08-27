<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/acara.js"></script>

<section id="main-content">
	<section class="wrapper"> 
		
		<h3><i class="fa fa-angle-right"></i> Data Acara</h3>
		
		<!--
		<a class="btn_add btn btn-default btn-sm" href="<?php echo base_url(); ?>acara/all_list">
		<i class="fa fa-backward "></i> <?php echo BACK_CAPTION; ?></a>
		-->
		
		<div class="row mt">
			<div style="padding-left:5px;padding-left:5px" class="col-lg-12">
				<form method="post" class="form-horizontal style-form" name="frmAcaraNext" id="frmAcaraNext" action="<?php echo base_url(); ?>acara/save"  novalidate="novalidate">
					
					<div style="padding:30px 10px 10px 10px;" class="form-panel">
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Kategori</label>
							<div class="col-sm-10">
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
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Tillcode</label>
							<div class="col-sm-10">
								<select id="tillcode" class="form-control" name="tillcode">
									<option value="">Pilih tillcode..</option>
									<?php
										foreach($tillcodes as $tillcode) {
									?>
										<option value="<?php echo $tillcode->tillcode; ?>"><?php echo $tillcode->tillcode . " (" . $tillcode->disc_label . ")"; ?></option>
									<?php
										}
									?>
								</select>
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Note</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="notes" name="notes">
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Supplier</label>
							<div class="col-sm-10">
								<select id="supplierCode" class="form-control" name="supplierCode">
									<option value="">Pilih supplier..</option>
									<?php
										foreach($suppliers as $supplier) {
									?>
										<option value="<?php echo $supplier->supp_code; ?>"><?php echo $supplier->supp_desc . " (" . $supplier->supp_code . ")"; ?></option>
									<?php
										}
									?>
								</select>
							</div>	
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Pert. Supplier</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="supplierResponsibility" name="supplierResponsibility">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Pert. Yogya</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="ydsResponsibility" name="ydsResponsibility">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Tipe Margin</label>
							<div class="col-sm-3">
								<select id="isPkp"  class="form-control">
									<option value="1">1 (PKP)</option>
									<option value="0">0 (NPKP)</option>
								</select>
							</div>
							<label class="col-sm-1 col-sm-1 control-label-right">Margin</label>
							<div class="col-sm-6 pad-right">
								<input type="text" class="form-control" id="margin" name="margin">
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
							<div class="table-responsive">
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
									<option value="<?php echo $location->loc_code; ?>"><?php echo $location->loc_code . " (" . $location->loc_desc . ")"; ?></option>
									<?php
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
										<option value="<?php echo $store->store_code; ?>"><?php echo $store->store_init . " (" .  $store->store_code . ", " . $store->store_desc . ")"; ?></option>
									<?php
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
							<div class="table-responsive">
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
							<div class="table-responsive">
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
								
								<button id="btnSubmit" type="button" class="btn btn-theme02">
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