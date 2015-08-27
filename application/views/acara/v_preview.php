

<section id="main-content">
	<section class="wrapper">
		
		<h3><i class="fa fa-angle-right"></i> Data Acara</h3>
		
		<a href="<?php echo base_url(); ?>acara/list" class="btn_add btn btn-default btn-sm">
		<i class="fa fa-backward "></i> <?php echo BACK_CAPTION; ?></a>
		
		<a href="<?php echo base_url(); ?>acara/do_print" class="btn_add btn btn-default btn-sm">
		<i class="fa fa-print "></i> <?php echo PRINT_CAPTION; ?></a>
		
		<div class="row mt">
			<div class="col-lg-12" style="padding-left:5px;padding-left:5px">
				<div class="form-panel" style="padding:10px;">
					<?php
							
						echo $rheader;
						echo "<table class='view_acara'>";
							echo $vlocation;
						echo "</table>";
						echo $rfooter;
						echo $rnotes;
					?>
										
										
				</div><!-- /content-panel -->
			</div><!-- /col-lg-4 -->			
		<!--</div> /row -->
										
										
										
										
										
																				