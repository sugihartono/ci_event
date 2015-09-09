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
</style>

<section id="main-content">
	<section class="wrapper"> 
		
		<h3><i class="fa fa-angle-right"></i> Data Acara</h3>
		
		<!--
		<a class="btn_add btn btn-default btn-sm" href="<?php echo base_url(); ?>acara/all_list">
		<i class="fa fa-backward "></i> <?php echo BACK_CAPTION; ?></a>
		-->
		
		<div class="row mt">
			<div style="padding-left:5px;padding-left:5px" class="col-lg-12">
				<form method="post" class="form-horizontal style-form" name="frmAcara" id="frmAcara" action="<?php echo base_url(); ?>acara/add/next" novalidate="novalidate">
					
					<div class="alert alert-danger hide">
						<a class="close" data-dismiss="alert" href="#">&times;</a>
						<span id="alertMessage">&nbsp;</span>
					</div>
					
					<div style="padding:30px 10px 10px 10px;" class="form-panel">
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Unit Bisnis<span class="red-star"> *</span></label>
							<div class="col-sm-3 required">
								<select id="department" class="form-control" name="department">
									<option value="Fashion">Fashion</option>
									<!--<option value="Supermarket">Supermarket</option>-->
								</select>
							</div>
							<label class="col-sm-1 col-sm-1 control-label-right">Divisi<span class="red-star"> *</span></label>
							<div class="col-sm-6 pad-right required">
								<select id="divisionCode" class="form-control" name="divisionCode">
									<option value="">Pilih divisi..</option>
									<?php
										foreach($divisions as $division) {
									?>
										<option value="<?php echo $division->division_code; ?>"><?php echo $division->division_desc; ?></option>
									<?php
										}
									?>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Nomor</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" readonly="" value=" -- auto -- " id="eventNo" name="eventNo" maxlength="26">
							</div>
							
							<label class="col-sm-1 col-sm-1 control-label-right">Tgl. Surat<span class="red-star"> *</span></label>
							<div class="col-sm-6 pad-right required">
								<input type="text" class="form-control" id="letterDate" name="letterDate" value="<?php echo $today; ?>"  maxlength="10">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Lampiran</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="attach" name="attach" maxlength="50">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Hal.<span class="red-star"> *</span></label>
							<div class="col-sm-10 required">
								<input type="text" class="form-control" id="about" name="about" maxlength="200">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Keperluan</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="purpose" name="purpose" maxlength="50">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Kepada<span class="red-star"> *</span></label>
							<div class="col-sm-10 required">
								<input type="text" class="form-control" id="toward" name="toward" maxlength="60">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Template<span class="red-star"> *</span></label>
							<div class="col-sm-3 required">
								<select id="templateCode" class="form-control" name="templateCode">
									<option value="">Pilih template..</option>
									<?php
										foreach($templates as $template) {
									?>
										<option value="<?php echo $template->tmpl_code; ?>"><?php echo $template->tmpl_name; ?></option>
									<?php
										}
									?>
								</select>
							</div>
							
							<div class="col-sm-6 pad-right">
								<label class="control-label">
									<input type="checkbox" id="manualSetting" name="manualSetting"> Setting promo diskon dilakukan oleh cabang
								</label>
							</div>
						</div>	
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Notes</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="notes" name="notes" maxlength="255">
							</div>
						</div>
						
						<!--
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">CC</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="cc" name="cc" maxlength="100">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-sm-2 col-sm-2 control-label">Penanda Tangan I</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="firstSignature" name="firstSignature" maxlength="20">
							</div>
							
							<label class="col-sm-2 col-sm-2 control-label-right">Penanda Tangan II</label>
							<div class="col-sm-3 pad-right">
								<input type="text" class="form-control" id="secondSignature" name="secondSignature" maxlength="20">
							</div>
						</div>
						-->
						
						<div class="divider"></div>
						
						<div class="form-group">
							<div class="col-sm-12" style="float:right;">
								<button id="btnNext" type="submit" class="btn btn-theme02">
								<?php echo NEXT_CAPTION; ?></button> 
							</div>
						</div>
						
					</div><!-- /content-panel -->
						
				</div><!-- /content-panel -->
				
			</div><!-- /col-lg-12 -->			
			<!--	  </div> /row -->
			
		</form>   
		
	</div></section>
	
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/acara.val.js"></script>
