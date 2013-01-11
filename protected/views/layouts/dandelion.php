<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<!-- Viewport metatags -->
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- iOS webapp metatags -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<!-- iOS webapp icons -->
<link rel="apple-touch-icon" href="touch-icon-iphone.png" />
<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="114x114"
	href="touch-icon-retina.png" />

<!-- CSS Reset -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css"
	media="screen" />
<!--  Fluid Grid System -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/fluid.css"
	media="screen" />
<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/dandelion.theme.css"
	media="screen" />
<!--  Main Stylesheet -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/dandelion.css"
	media="screen" />
<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/demo.css"
	media="screen" />
<!-- Statistics -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/css/core/statistic.css"
	media="screen" />
<!-- jQuery JavaScript File -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>

<!-- jQuery-UI JavaScript Files -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/jui/js/jquery-ui-1.8.20.min.js"></script>
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/jui/js/jquery.ui.timepicker.min.js"></script>
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/jui/js/jquery.ui.touch-punch.min.js"></script>
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->request->baseUrl; ?>/jui/css/jquery.ui.all.css"
	media="screen" />

<!-- Plugin Files -->

<!-- FileInput Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.fileinput.js"></script>
<!-- Placeholder Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.placeholder.js"></script>
<!-- Mousewheel Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.mousewheel.min.js"></script>
<!-- Scrollbar Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tinyscrollbar.min.js"></script>
<!-- Tooltips Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/jquery.tipsy-min.js"></script>
<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/tipsy.css" />

<!-- DataTables Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- Demo JavaScript Files -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/demo.tables.js"></script>

<!-- Validation Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/validate/jquery.validate.js"></script>

<!-- Statistic Plugin JavaScript Files (requires metadata and excanvas for IE) -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.metadata.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/excanvas.js"></script>
<![endif]-->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/plugins/dandelion.circularstat.min.js"></script>

<!-- Wizard Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/plugins/dandelion.wizard.min.js"></script>

<!-- Fullcalendar Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/gcal.js"></script>
<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.css"
	media="screen" />
<link rel="stylesheet"
	href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.print.css"
	media="print" />



<!-- DataTables Plugin -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- Core JavaScript Files -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/dandelion.core.js"></script>

<!-- Customizer JavaScript File (remove if not needed) -->
<script type="text/javascript"
	src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/dandelion.customizer.js"></script>
<!-- jGrowl Plugin -->
<script type="text/javascript"
	src="<?php echo $this->baseurl;?>/plugins/jgrowl/jquery.jgrowl.min.js"></script>
<link rel="stylesheet"
	href="<?php echo $this->baseurl;?>/plugins/jgrowl/jquery.jgrowl.css"
	media="screen" />

<!-- Include the heartcode canvasloader js file -->
<script
	src="<?php echo $this->baseurl;?>/js/heartcode-canvasloader-min-0.9.1.js"></script>
<title>Dandelion Admin - Dashboard</title>

</head>

<body>

	

	<!-- Main Wrapper. Set this to 'fixed' for fixed layout and 'fluid' for fluid layout' -->
	<div id="da-wrapper" class="fluid">

		<!-- Header -->
		<div id="da-header">

			<div id="da-header-top">

				<!-- Container -->
				<div class="da-container clearfix">

					<!-- Logo Container. All images put here will be vertically centere -->
					<div id="da-logo-wrap">
						<div id="da-logo">
							<div id="da-logo-img">
								<a
									href="<?php echo Yii::app()->request->baseUrl; ?>/administration">
									<img
									src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"
									alt="Dandelion Admin" />
								</a>
							</div>
						</div>
					</div>
					<!-- Header Toolbar Menu -->
					 <!-- Header Toolbar Menu -->
                    <div id="da-header-toolbar" class="clearfix">
                        
                    </div>
				</div>
			</div>

			<div id="da-header-bottom">
				<!-- Container -->
				<div class="da-container clearfix">

					<!-- I had search here -->

					<!-- Breadcrumbs -->
					<div id="da-breadcrumb">
						<ul>
							<li class="active"><span><img
									src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/16/home.png"
									alt="Home" /><?php echo $this->page_title?></span></li>
						</ul>
					</div>

				</div>
			</div>
		</div>

		<!-- Content -->
		<div id="da-content">

			<!-- Container -->
			<div class="da-container clearfix">

				<!-- Sidebar Separator do not remove -->
				<div id="da-sidebar-separator"></div>

				<!-- Sidebar -->
				<div id="da-sidebar">

					<!-- Main Navigation -->
					<div id="da-main-nav" class="da-button-container">
						<ul>
							<li class="home"><a
								href="<?php echo $this->createUrl('administration/index');?>"> <!-- Icon Container -->
									<span class="da-nav-icon"> <img
										src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/home.png"
										alt="Dashboard" />
								</span> Home
							</a>
							</li>
							<li class="websites"><a
								href="<?php echo $this->createUrl('administration/website_list');?>">
									<!-- Icon Container --> <span class="da-nav-icon"> <img
										src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/powerpoint_documents_1.png"
										alt="Dashboard" />
								</span> Websites
							</a>
							</li>
							<li class="os"><a
								href="<?php echo $this->createUrl('administration/os_list');?>">
									<!-- Icon Container --> <span class="da-nav-icon"> <img
										src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/windows.png"
										alt="Dashboard" />
								</span> Os
							</a>
							</li>
							<li class="category"><a
								href="<?php echo $this->createUrl('administration/category_list');?>">
									<!-- Icon Container --> <span class="da-nav-icon"> <img
										src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/frames.png"
										alt="Dashboard" />
								</span> Categories
							</a>
							</li>
							<li class="section"><a
								href="<?php echo $this->createUrl('administration/section_list');?>">
									<!-- Icon Container --> <span class="da-nav-icon"> <img
										src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/sign_post.png"
										alt="Dashboard" />
								</span> Sections
							</a>
							</li>
							<li class="application"><a
								href="<?php echo $this->createUrl('administration/applications');?>">
									<!-- Icon Container --> <span class="da-nav-icon"> <img
										src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/applications.png"
										alt="Dashboard" />
								</span> Applications
							</a>
							</li>
							<li class="appsgrabb"><a
								href="<?php echo $this->createUrl('administration/appsgrabb');?>">
									<!-- Icon Container --> <span class="da-nav-icon"> <img
										src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/download.png"
										alt="Dashboard" />
								</span> Apps Grabber
							</a>
							</li>

						</ul>
					</div>

				</div>

				<!-- Main Content Wrapper -->
				<div id="da-content-wrap" class="clearfix">

					<!-- Content Area -->
					<div id="da-content-area">

						<?php echo $content; ?>

					</div>
					<!-- end of contents area "da-content-area" -->

				</div>

			</div>

		</div>

		<!-- Footer -->
		<div id="da-footer">
			<div class="da-container clearfix">
				<p>Copyright 2012. Dandelion Admin. All Rights Reserved.
			
			</div>
		</div>

	</div>

</body>
</html>
