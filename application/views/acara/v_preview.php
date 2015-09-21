

<section id="main-content">
	<section class="wrapper">
		<div class="content_title">
			<h3><i class="fa fa-angle-right"></i> Data Acara</h3>
			
			<a href="<?php echo base_url(); ?>acara/list" class="btn_add btn btn-default btn-sm">
			<i class="fa fa-backward "></i> <?php echo BACK_CAPTION; ?></a>
			
			<a href="<?php echo base_url().'assets/surat_acara/'.$file.'.pdf'; ?>" target="_blank" class="btn_add btn btn-default btn-sm" id="btn_print">
			<i class="fa fa-print "></i> <?php echo PRINT_CAPTION; ?></a>
		</div>
		
		<div class="row mt">
			<div class="col-lg-12" style="padding-left:5px;">
				<div class="form-panel" style="padding:10px;">
					<div style="width:65%;">


						<div>
							<?php
								
								echo "<img src='".base_url()."assets/img/yg_red.png' /><br />";
								echo $rheader;
								echo "<table class='view_acara'>";
									echo $vlocation;
								echo "</table>";
								
								echo "<div class='newspaper'>";
									echo $vcalculate;
									echo $vcalculate_gold;
								echo "</div>";

								echo $rfooter;
								echo $rnotes;
							?>				
						</div><!-- /printable -->	

					</div>			

				</div><!-- /content-panel -->
			</div><!-- /col-lg-12 -->			
		<!--</div> /row -->
										
										
										
										
										
																				