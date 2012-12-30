<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Viewport metatags -->
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- iOS webapp metatags -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<!-- iOS webapp icons -->
<link rel="apple-touch-icon" href="touch-icon-iphone.png" />
<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
<link rel="apple-touch-icon" sizes="114x114" href="touch-icon-retina.png" />

<!-- CSS Reset -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/reset.css" media="screen" />
<!--  Fluid Grid System -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fluid.css" media="screen" />
<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dandelion.theme.css" media="screen" />
<!--  Main Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/dandelion.css" media="screen" />
<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/demo.css" media="screen" />

<!-- jQuery JavaScript File -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>

<!-- jQuery-UI JavaScript Files -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/jui/js/jquery-ui-1.8.20.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/jui/js/jquery.ui.timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/jui/js/jquery.ui.touch-punch.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/jui/css/jquery.ui.all.css" media="screen" />

<!-- Plugin Files -->

<!-- FileInput Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.fileinput.js"></script>
<!-- Placeholder Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.placeholder.js"></script>
<!-- Mousewheel Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.mousewheel.min.js"></script>
<!-- Scrollbar Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tinyscrollbar.min.js"></script>
<!-- Tooltips Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/jquery.tipsy-min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tipsy/tipsy.css" />

<!-- DataTables Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/datatables/jquery.dataTables.min.js"></script>

<!-- Demo JavaScript Files -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/demo.tables.js"></script>

<!-- Validation Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/validate/jquery.validate.js"></script>

<!-- Statistic Plugin JavaScript Files (requires metadata and excanvas for IE) -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.metadata.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/excanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/plugins/dandelion.circularstat.min.js"></script>

<!-- Wizard Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/plugins/dandelion.wizard.min.js"></script>

<!-- Fullcalendar Plugin -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/gcal.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.css" media="screen" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.print.css" media="print" />

<!-- Load Google Chart Plugin 
<script type="text/javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>https://www.google.com/jsapi"></script>
<script type="text/javascript">
	// Load the Visualization API and the piechart package.
	google.load('visualization', '1.0', {'packages':['corechart']});
</script>-->
<!-- Debounced resize script for preventing to many window.resize events
      Recommended for Google Charts to perform optimally when resizing 
<script type="text/javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.debouncedresize.js"></script>
-->
<!-- DataTables Plugin -->
<script type="text/javascript" src="plugins/datatables/jquery.dataTables.min.js"></script>

<!-- Demo JavaScript Files  -->
<script type="text/javascript" src="js/demo/demo.tables.js"></script>

<!-- Core JavaScript Files -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/dandelion.core.js"></script>

<!-- Customizer JavaScript File (remove if not needed) -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/core/dandelion.customizer.js"></script>

<title>Dandelion Admin - Dashboard</title>

</head>

<body>

	<!-- Dandelion Customizer (remove if not needed) -->
    <div id="da-customizer">
    	<div id="da-customizer-content">
        	<ul>
            	<li>
                	<span class="da-customizer-title">Background Pattern</span>
                    <span id="da-customizer-body-bg"></span>
                </li>
                <li>
                	<span>Header Pattern</span>
                    <span id="da-customizer-header-bg"></span>
                </li>
                <li>
                	<span>
                    	Layout
                        <span title="This functionality can only provide you the CSS for background and header patterns. Instructions to switch between fixed or fluid layout can be found in the documentation." class="da-tooltip-w da-customizer-tooltip">
                    		[?]
                        </span>
                    </span>
                    <ul id="da-customizer-layouts" class="clearfix">
                    	<li>
                        	<input type="radio" id="da-customizer-fluid" name="da-layout" checked="checked" />
                        	<label for="da-customizer-fluid">Fluid</label>
                        </li>
                    	<li>
                        	<input type="radio" id="da-customizer-fixed" name="da-layout" />
                            <label for="da-customizer-fixed">Fixed</label>
                        </li>
                    </ul>
                </li>
            </ul>
            <div id="da-customizer-button">
            	<button class="da-button red">Get CSS</button>
            </div>
        </div>
        <span id="da-customizer-pulldown"></span>
    </div>

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
                                <a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard.html">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="Dandelion Admin" />
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Header Toolbar Menu -->
                    <div id="da-header-toolbar" class="clearfix">
                        <div id="da-user-profile">
                            <div id="da-user-avatar">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pp.jpg" alt="" />
                            </div>
                            <div id="da-user-info">
                                John Doe
                                <span class="da-user-title">Creative Director</span>
                            </div>
                            <ul class="da-header-dropdown">
                                <li class="da-dropdown-caret">
                                    <span class="caret-outer"></span>
                                    <span class="caret-inner"></span>
                                </li>
                                <li class="da-dropdown-divider"></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/dashboard.html">Dashboard</a></li>
                                <li class="da-dropdown-divider"></li>
                                <li><a href="#">Profile</a></li>
                                <li><a href="#">Settings</a></li>
                                <li><a href="#">Change Password</a></li>
                            </ul>
                        </div>
                        <div id="da-header-button-container">
                        	<ul>
                            	<li class="da-header-button notif">
                                	<span class="da-button-count">32</span>
                                	<a href="#">Notifications</a>
                                    <ul class="da-header-dropdown">
                                        <li class="da-dropdown-caret">
                                            <span class="caret-outer"></span>
                                            <span class="caret-inner"></span>
                                        </li>
                                        <li>
                                        	<span class="da-dropdown-sub-title">Notifications</span>
                                        	<ul class="da-dropdown-sub">
                                                <li class="unread">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="unread">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="read">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="read">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <a class="da-dropdown-sub-footer">
                                            	View all notifications
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            	<li class="da-header-button message">
                                	<span class="da-button-count">5</span>
                                	<a href="#">Messages</a>
                                    <ul class="da-header-dropdown">
                                        <li class="da-dropdown-caret">
                                            <span class="caret-outer"></span>
                                            <span class="caret-inner"></span>
                                        </li>
                                        <li>
                                        	<span class="da-dropdown-sub-title">Messages</span>
                                        	<ul class="da-dropdown-sub">
                                                <li class="unread">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="unread">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="read">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="read">
                                                    <a href="#">
                                                        <span class="message">
                                                            Lorem ipsum dolor sit amet
                                                        </span>
                                                        <span class="time">
                                                            January 21, 2012
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <a class="da-dropdown-sub-footer">
                                            	View all messages
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            	<li class="da-header-button logout">
                                	<a href="index.html">Logout</a>
                                </li>
                            </ul>
                        </div>
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
                            <li class="active"><span><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/16/home.png" alt="Home" />Dashboard</span></li>
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
                            <li class="active home">
                            	<a href="<?php echo $this->createUrl('administration/index');?>">
                                	<!-- Icon Container -->
                                	<span class="da-nav-icon">
                                    	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/home.png" alt="Dashboard" />
                                    </span>
                                	Home
                                </a>
                            </li>
                            <li class="websites">
                            	<a href="<?php echo $this->createUrl('administration/website_list');?>">
                                	<!-- Icon Container -->
                                	<span class="da-nav-icon">
                                    	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/black/32/powerpoint_documents_1.png" alt="Dashboard" />
                                    </span>
                                	Websites
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
                    	
                    </div><!-- end of contents area "da-content-area" -->
                    
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
