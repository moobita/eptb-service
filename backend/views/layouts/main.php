<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> ระบบบการบริหารการสอบ</title>
		<meta name="description" content="">
		<meta name="author" content="">
			
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>SWUT | <?= Html::encode($this->title) ?></title>
    <?php $path = 'http://editorlog.com/template-editorlog/'?>
   <!-- #FAVICONS -->
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
		<link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		<link rel="apple-touch-icon" href="<?=$path?>img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?=$path?>img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?=$path?>img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?=$path?>img/splash/touch-icon-ipad-retina.png">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?=$path?>img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?=$path?>img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?=$path?>img/splash/iphone.png" media="screen and (max-device-width: 320px)">
<link rel="stylesheet" type="text/css" media="screen"
	href="<?=$path?>css/font-awesome.min.css">
<?php $this->head()?>
<style type="text/css">
body.smart-style-6 .txt-color-magenta, body.smart-style-6 nav ul li.active>a:before
	{
	color: #EDECEC !important;
	
}

body.smart-style-6 .minifyme {
	
	border-radius: 0px !important;
	right: 0px !important;
	padding: 0px !important;
	border-bottom: 0px !important;
	border-radius: 5px 0 0 5px;
}

body:not(.menu-on-top).desktop-detected {
    min-height: auto!important;
}
body{
font-size: 16px;
}
.note{margin-top: -12px;}
label {
    font-weight: 800;
}
.menu-on-top li.active>a {
    font-weight: 700!important;
    background-color: #2196f3;
    color: #fff !important;
}
</style>

</head>

<body class="menu-on-top smart-style-6">
<?php $this->beginBody() ?>
<header id="header">
			<div id="logo-group">

				<!-- PLACE YOUR LOGO HERE -->
				<img src="image/logo_swu.png" alt="โลโก้ ระบบบริหารจัดการข้อสอบ" style="
    width: 250px;
    padding-top: 5px;
    padding-left: 5px;
">
				<!-- END LOGO PLACEHOLDER -->

			</div>

			

			<!-- pulled right: nav area -->
			<div class="pull-right">
				
				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->
				
				<!-- #MOBILE -->
				<!-- Top menu profile link : this shows only when top menu is active -->
				<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
					<li class="">
						<a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
							<img src="image/swut_profile.PNG" alt="John Doe" class="online" />  
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
							</li>
						</ul>
					</li>
				</ul>
				</div>
			

		</header>
		<aside id="left-panel">
			<div class="login-info">
				<span>
				<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="image/swut_profile.PNG" alt="me" class="online" /> 
						<span>
							<?=Yii::$app->user->identity->username?> 
						</span>
						<i class="fa fa-angle-down"></i>
					</a> 
					
				</span>
			</div>
			<!-- end user info -->


    
			<!-- NAVIGATION : This navigation is also responsive-->
			<nav>
			
			<?php 
			
				
echo Nav::widget([
		'encodeLabels' => false,
		'items' => [
    		    [
    		    'label' => '<i class="fa fa-lg fa-fw fa-search"></i> <span class="menu-item-parent">ค้นหาข้อมูล</span>',
    		    'url' => ['/trn-edu-testing/index']
    		    ],
				[
						'label' => '<i class="fa fa-lg fa-fw fa-pencil-square-o"></i> <span class="menu-item-parent">บันทึกข้อมูล</span>', 
						'url' => ['/trn-edu-testing/create']
				],				
				[
						'label' => '<i class="fa fa-lg fa-fw fa-file-text-o"></i> <span class="menu-item-parent">แบบทดสอบ</span>', 
						'url' => ['/trn-edu-testing/select']
				],
				[
				'label' => '<i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">บันทึกสถิติ</span>',
				'url' => ['/trn-edu-testing/record-stat']
				],
				
				
				[
				'label' => '<i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">รายงาน</span>',
				'url' => ['/report/index']
				],
				
				[
				'label' => '<i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">ข้อมูลกลาง</span>',
				'url' => ['/master-data/index'],
				//'url' => Url::to(['/master-data/index', 'vId' => ""]),
				],
				[
						'label' => '<i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">ผู้ใช้งาน</span>', 
						'url' => ['/user/index']
				],
				
				[
				'label' => '<i class="fa fa-lg fa-fw fa-sign-out"></i> <span class="menu-item-parent">ออกจากระบบ</span>',
				
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
				],
		],
		]);
			
		?>	
			</nav>
			
			
<span class="minifyme" data-action="minifyMenu"> 
				<i class="fa fa-arrow-circle-left hit"></i> 
			</span>	
		</aside>
		
		<!-- END NAVIGATION -->
		
		<!-- #MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<!-- breadcrumb -->
				<ol class="breadcrumb">
				<i class="fa fa-lg fa-fw fa-desktop"></i>
					<li><?= Html::encode($this->screen_id) ?></li>
					
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right" style="margin-right:25px">
					<a href="#" id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa fa-grid"></i> Change Grid</a>
					<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa fa-plus"></i> Add</span>
					<button id="search" class="btn btn-ribbon" data-title="search"><i class="fa fa-search"></i> <span class="hidden-mobile">Search</span></button>
				</span> -->

			</div>
			<!-- END RIBBON -->

			<!-- #MAIN CONTENT -->
			<div id="content">		
			<?=$content;?>		
			</div>
			<!-- END #MAIN CONTENT -->
		</div>
		<!-- END #MAIN PANEL -->

		<!-- #PAGE FOOTER -->
		<div class="page-footer" align="left">
			<div class="row" align="left">
				<div class="col-xs-12 col-sm-6" align="left">
					
				</div>

				<div class="col-xs-6 col-sm-6 text-right hidden-xs">
					<span class="txt-color-white">Support By Editotlog Team <span class="hidden-xs"> - Web Application Framework</span> © 2016 - 2017</span>
				</div>
			</div>
		</div>
		<!-- END PAGE FOOTER -->

		<!-- #SHORTCUT AREA : With large tiles (activated via clicking user name tag)
			 Note: These tiles are completely responsive, you can add as many as you like -->
		<div id="shortcut">
			<ul>
				<li>
					<a href="index.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
			</ul>
		</div>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)
		<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->


		<!-- #PLUGINS -->
		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="js/app.config.seed.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="js/bootstrap/bootstrap.min.js"></script>

		<!--[if IE 8]>
			<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->

		<!-- MAIN APP JS FILE -->
		<script src="js/app.seed.js"></script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
	
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>

<?php $this->endBody() ?>
<script>
			if (!window.jQuery) {
				document.write('<script src="<?=$path?>js/libs/jquery-2.1.1.min.js"><\/script>');
			}
		</script>

			<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?=$path?>js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>
</body>
</html>
<?php $this->endPage() ?>
