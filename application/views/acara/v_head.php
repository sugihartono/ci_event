<!DOCTYPE html>
<html lang="en">
  <head>
    <title>EVENTO</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">

    <!--external css-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/js/chart-master/Chart.js"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url(); ?>assets/js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/gritter-conf.js"></script>

    <!--datatables-->
    <link href="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url(); ?>assets/js/sparkline-chart.js"></script>    
    <script src="<?php echo base_url(); ?>assets/js/zabuto_calendar.js"></script>   
    


    <script type="text/javascript">
        var baseUrl = "<?php echo base_url(); ?>"; 
		var oTable;
		
        $(function() {
			
			oTable = $('#datatable').dataTable({                
                "order": [[ 0, "desc" ]],
				"columnDefs": [
					{
						"targets": [0],
						"visible": false,
						"searchable": false
					},
                    {
                        "targets": [1],
                        "width": "18%"
                    },
                    {
                        "targets": [2],
                        "width": "20%"
                    },
                    {
                        "targets": [3],
                        "width": "45%"
                    },
                    {
                        "targets": [4],
                        "width": "10%"
                    },
                    {
                        "targets": [5],
                        "width": "7%",
                        "sortable" : false,
                        "searchable": false
                    }
				]
            });	

            
            $('#btn_refresh').click(function(){
                $('#refresh_icon').attr('class', 'fa fa-spinner fa-spin');
                
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url();?>"+"Acara_Controller/refresh_minified", 
                //  data: post_data,
                    success: function(msg) {
                        $("#datas").fadeOut(100, function(){
                            $("#datas").html(msg).fadeIn().delay(0);
                            $('#refresh_icon').attr('class', 'fa fa-refresh');
                        });

                       

                    }
                }); 

            });


            
        });
		
    </script>
    

</head>
