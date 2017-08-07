<?php
 $this->load->view('public/header');?>
<!-- BEGIN body -->
<body class="page page-id-109 page-template-default ie layout-2cr">
	<!-- BEGIN #container -->
	<div id="container">
		<!-- BEGIN #header -->
		<?php
 $this->load->view('public/top');?>
		<!--BEGIN #content -->
		<div id="content" class="clearfix">		
			<div class="page-title">中国个性原木家居领航者</div>
            <div class="clear"></div>
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">		
				<!--BEGIN .hentry -->
				<div class="hentry">	
					<!--BEGIN .clearfix -->
                    <div class="clearfix">		
                      <!--BEGIN .entry-content -->
                      <div class="entry-content">
<div class="content-text">
<div class="content-view"><?php
 echo $view->content;?></div>
</div>
                      <!--END .entry-content -->
                      </div>
                    <!--END .clearfix -->
				    </div>
				<!--END .hentry-->  
				</div>
                <!--END #primary .hfeed-->
			</div>
		<!--BEGIN #sidebar .aside-->
		<?php
 $this->load->view('public/right');?>
		<!-- END #content -->
		</div>
    <!-- END #container -->
    </div> 	
    <!-- BEGIN #footer-container -->
    <?php
 $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>