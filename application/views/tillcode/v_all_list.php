         

        <section id="main-content">
          <section class="wrapper">

              <h3><i class="fa fa-angle-right"></i> Data Tillcode</h3>
              
              <a href="<?php echo base_url(); ?>tillcode/add_new" class="btn_add btn btn-default btn-sm">
				<i class="fa fa-plus-square"></i> <?php echo ADD_CAPTION; ?></a>

		  		<div class="row mt">
			  		<div class="col-lg-12" style="padding-left:5px;padding-left:5px">
                      <div class="form-panel" style="padding:10px;">
                      
                          	

                          <section id="unseen">
                          <div class="table-responsive">
                            <table class="table table-bordered table-striped table-condensed" id="datatable">
                              <thead>
	                              <tr>
	                                  <th class="sequence">No.</th>
	                                  <th>Till Code</th>
	                                  <th>Article Code</th>
	                                  <th>Description</th>
	                                  <th>Art</th>
	                                  <th>Cat</th>
	                                  <th class="action">Action</th>
	                              </tr>
                              </thead>
                              <tbody>
                              	  <?php 
									
										for ($i=1; $i<=15; $i++){
											
								  ?>
								    <tr>
	                                  <td><?=$i;?></td>
	                                  <td>93036573</td>
	                                  <td>677234</td>
	                                  <td>FELIX VERGUSO, DISCOUNT HUT YOGYA</td>
	                                  <td>NORMAL</td>
	                                  <td>D1</td>
	                                  <td>
										<a data-id='' data-toggle='modal' data-target='#myModal' class='btn_update btn btn-xs'>
											<i class='fa fa-pencil'></i> <?php echo UPDATE_CAPTION; ?>
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
               </div><!-- /col-lg-4 -->			
	<!--	  	</div> /row -->
					
     
                           
                  
              
      