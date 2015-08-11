      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse " style="overflow: hidden;" tabindex="5000">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="#"><img src="<?php echo base_url(); ?>assets/img/yg_red.png"  ></a></p>
              	  <h5 class="centered">Welcome, <?php // echo $this->session->userdata['shop_ass_logged_in']['username']; ?></h5>
              	  	
                  <!-- <li class="mt">
                      <a class="active" href="index.html">
                          <i class="fa fa-tags"></i>
                          <span>Master</span>
                      </a>
                  </li> -->

                  <li class="sub-menu">
                      <a href="javascript:;" class="<?php if (isset($menu_active)){echo $menu_active;}else echo ""; ?>">
                          <i class="fa fa-file-text"></i>
                          <span>Master</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo base_url(); ?>brand/all_list" style="<?php if (isset($menu_brand_active)){echo $menu_brand_active;}else echo ""; ?>">Brand</a></li>
                          <li><a  href="<?php echo base_url(); ?>supplier/all_list" style="<?php if (isset($menu_supplier_active)){echo $menu_supplier_active;}else echo ""; ?>">Supplier</a></li>
                          <li><a  href="<?php echo base_url(); ?>tillcode/all_list" style="<?php if (isset($menu_tillcode_active)){echo $menu_tillcode_active;}else echo ""; ?>">Tillcode</a></li>
					  </ul>
                  </li>

                  <!--li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Components</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="calendar.html">aaa</a></li>
                      </ul>
                  </li-->
                  <li class="sub-menu">
                      <a href="javascript:;" class="<?php if (isset($trans_active)){echo $trans_active;}else echo ""; ?>">
                          <i class="fa fa-book"></i>
                          <span>Transaksi</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="#" style="<?php if (isset($menu_jual_active)){echo $menu_jual_active;}else echo ""; ?>">Penjualan</a></li>
                          <li><a  href="#" style="<?php if (isset($menu_upload_active)){echo $menu_upload_active;}else echo ""; ?>">Upload Master</a></li>
					      <li><a  href="#" style="<?php if (isset($menu_validasi_active)){echo $menu_validasi_active;}else echo ""; ?>">Validasi Harga</a></li>
					  </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Forms</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">ccc</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">ddd</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">eee</a></li>
                      </ul>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->