      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              YOGYA IT&amp;S Team
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>



  <!--common script for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/common-scripts.js"></script>

    
  
</body>

<div id="section_to_print" style="display:none;">
<p>
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
              </p>
  </div><!-- /printable --> 
            

</html>            