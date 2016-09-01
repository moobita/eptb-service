<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

		<title> ระบบบการริหารการสอบ</title>
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

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
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
</head>

<body class="smart-style-6" data-feedly-mini="yes">
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
							<img src="img/avatars/sunny.png" alt="John Doe" class="online" />  
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
					<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->
				
				

				<!-- logout button 
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="login.html" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i>ออกจากระบบ</a> </span>
				</div>
				end logout button -->

				

			

				

			</div>
			<!-- end pulled right: nav area -->

		</header>
		<!-- END HEADER -->

		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					
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
			/*
			$menuItems[] = ['label' => '<i class="fa fa-lg fa-fw fa-pencil-square-o"></i> <span class="menu-item-parent">บันทึกข้อมูลการบริการสอบ</span>', 'url' => ['/trn-edu-testing/create']];
			$menuItems[] = ['label' => '<i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">รายการข้อมูลการบริการสอบ</span>', 'url' => ['/trn-edu-testing']];
			
			$menuItems[] = ['label' => 'บันทึกข้อมูลการบริการสอบ', 'url' => ['/trn-edu-testing']];
			$menuItems[] = ['label' => 'เลือกแบบทดสอบ', 'url' => ['/']];
			$menuItems[] = ['label' => 'รายชื่อผู้ใช้งาน', 'url' => ['/user']];
			$menuItems[] = ['label' => 'ฐานข้อมูลกลาง',
					'url' => ['/user'],
					'items' => [
							['label' => 'หน่วยงาน', 'url' => [ '/ms-institution']],
							['label' => 'ประเภทหน่วยงาน', 'url' => ['/ms-institution-type']],
							['label' => 'จังหวัด', 'url' => ['/ms-province']],
							['label' => 'วัตถุประสงค์ในการสอบ', 'url' => ['/ms-objective']],
							['label' => 'ประเภทของแบบทดสอบ', 'url' => ['/ms-test-type']],
							['label' => 'วิทยากร', 'url' => ['/ms-lecturer']],
							['label' => 'ระดับการศึกษา', 'url' => ['/ms-edu-level']],
					],
			];
			 
			$menuItems[] = '<li>'
					. Html::beginForm(['#'], 'post')
					. Html::submitButton(
							'<span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' . Yii::$app->user->identity->username,
							['class' => 'btn btn-link']
							)
							. Html::endForm()
							. '</li>';
			
							$menuItems[] = '<li>'
									. Html::beginForm(['/site/logout'], 'post')
									. Html::submitButton(
											'<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> '.'Logout',
											['class' => 'btn btn-link']
											)
											. Html::endForm()
											. '</li>';
				
			echo Nav::widget([
					'encodeLabels' => false,
					'items' => $menuItems,
				
			]);
				*/
			
		
    ?>
			<?php 
			
				
echo Nav::widget([
		'encodeLabels' => false,
		'items' => [
				[
						'label' => '<i class="fa fa-lg fa-fw fa-pencil-square-o"></i> <span class="menu-item-parent">บันทึกข้อมูลการบริการสอบ</span>', 
						'url' => ['/trn-edu-testing/create']
				],
				[
				'label' => '<i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">ค้นหาข้อมูลการบริการสอบ</span>',
				'url' => ['/trn-edu-testing/index']
				],
				[
						'label' => '<i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">เลือกแบบทดสอบ</span>', 
						'url' => ['/trn-edu-testing/select']
				],
				[
				'label' => '<i class="fa fa-lg fa-fw fa-print"></i> <span class="menu-item-parent">รายการเพื่อพิมพ์ใบปะหน้าซอง</span>',
				'url' => ['/trn-edu-testing/print-paper']
				],
				[
				'label' => '<i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">รายงานการวิเคราะห์ข้อมูล</span>',
				'url' => ['/trn-edu-testing/print-paper']
				],
				[
				'label' => '<i class="fa fa-lg fa-fw fa-database"></i> <span class="menu-item-parent">ฐานข้อมูลกลาง/ชุดข้อมูล</span>',
				'url' => ['/'],
						
				],
				[
						'label' => '<i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">รายชื่อผู้ดูแลระบบ</span>', 
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
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="txt-color-white">Support By Editotlog Team <span class="hidden-xs"> - Web Application Framework</span> © 2014-2015</span>
				</div>

				<div class="col-xs-6 col-sm-6 text-right hidden-xs">
					<div class="txt-color-white inline-block">
						<i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
						<div class="btn-group dropup">
							<button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
								<i class="fa fa-link"></i> <span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right text-left">
								<li>
									<div class="padding-5">
										<p class="txt-color-darken font-sm no-margin">Download Progress</p>
										<div class="progress progress-micro no-margin">
											<div class="progress-bar progress-bar-success" style="width: 50%;"></div>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="padding-5">
										<p class="txt-color-darken font-sm no-margin">Server Load</p>
										<div class="progress progress-micro no-margin">
											<div class="progress-bar progress-bar-success" style="width: 20%;"></div>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="padding-5">
										<p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
										<div class="progress progress-micro no-margin">
											<div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="padding-5">
										<button class="btn btn-block btn-default">refresh</button>
									</div>
								</li>
							</ul>
						</div>
					</div>
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
