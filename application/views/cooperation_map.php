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


<script type="text/javascript" src="<?php
 echo base_url();?>public/plugins/china_map/swfobject.js"></script>
<script type="text/javascript"> function eventHandler(e) { return e.value; } </script>
<div class="content-view" style="text-align:center;">
	<!--容器end-->
	<div id="china_map_container">加载地图!</div>
	<!--容器end-->
	<!--init code-->
	<script type="text/javascript">
	$(function(){
		var s1 = new SWFObject("<?php
 echo base_url();?>public/plugins/china_map/ChinaMap.swf","ply","600","500","10","#FFFFFF");
		s1.addParam("allowfullscreen","true");
		s1.addParam("allownetworking","all");
		s1.addParam("allowscriptaccess","always");
		s1.addParam("wmode","transparent");
		s1.addVariable("title","");
		s1.addVariable("xmlurl","<?php
 echo base_url();?>public/plugins/china_map/data/d.xml");
		s1.addVariable("jsHandler","eventHandler");
		s1.write("china_map_container");
	});
	</script>
	<!--/init code-->
</div>

<br><br>

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