		<section id="main-content">
		  <section class="wrapper"> 

              <h3><i class="fa fa-angle-right"></i> Data Acara</h3>
              
 			  <a class="btn_add btn btn-default btn-sm" href="http://localhost/ci_event/acara/all_list">
				<i class="fa fa-backward "></i> Back</a>
				
		  		<div class="row mt">
			  	 <div style="padding-left:5px;padding-left:5px" class="col-lg-12">
                  <div style="padding:30px 10px 10px 10px;" class="form-panel">
                
                      <form method="post" class="form-horizontal style-form" name="frm" id="frm" action="http://localhost/ci_event/acara/do_add_new" novalidate="novalidate">
                          
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
						  
						  <div class="divider"></div>
						  
                          <div class="form-group">
                              <div class="col-sm-12">
                                <button type="submit" class="btn btn-theme02">
                                  <i class="fa fa-save"></i> Save                                </button>
								<button type="reset" class="btn btn-success">
								  <i class="fa fa-rotate-left"></i>
								  Cancel								</button>
                              </div>
                          </div>

                      </form>
               

              </div><!-- /content-panel -->
            </div><!-- /col-lg-12 -->			
	<!--	  </div> /row -->
					
                  

              
      
              
          </div></section>