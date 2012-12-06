<!DOCTYPE html>

<!--[if IEMobile 7]><html class="no-js iem7 oldie linen"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie linen" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie linen" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9 linen" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js linen" lang="en"><!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $this->settings->site_name; ?> - <?php echo lang('login_title');?></title>
	
	<base href="<?php echo base_url(); ?>" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- http://davidbcalhoun.com/2010/viewport-metatag -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	<link rel="stylesheet" href="system/cms/themes/managefan/css/reset.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/style.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/colors.css?v=1">
	<link rel="stylesheet" media="print" href="system/cms/themes/managefan/css/print.css?v=1">
	<!-- For progressively larger displays -->
	<link rel="stylesheet" media="only all and (min-width: 480px)" href="system/cms/themes/managefan/css/480.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 768px)" href="system/cms/themes/managefan/css/768.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 992px)" href="system/cms/themes/managefan/css/992.css?v=1">
	<link rel="stylesheet" media="only all and (min-width: 1200px)" href="system/cms/themes/managefan/css/1200.css?v=1">
	<!-- For Retina displays -->
	<link rel="stylesheet" media="only all and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-device-pixel-ratio: 1.5)" href="system/cms/themes/managefan/css/2x.css?v=1">

	<!-- Additional styles -->
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/form.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/switches.css?v=1">

	<!-- Login pages styles -->
	<link rel="stylesheet" media="screen" href="system/cms/themes/managefan/css/login.css?v=1">

	
	
	<!-- For Modern Browsers -->
	<link rel="shortcut icon" href="system/cms/themes/managefan/img/favicons/favicon.png">
	<!-- For everything else -->
	<link rel="shortcut icon" href="system/cms/themes/managefan/img/favicons/favicon.ico">
	
	<!-- For retina screens -->
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="system/cms/themes/managefan/img/favicons/apple-touch-icon-retina.png">
	<!-- For iPad 1-->
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="system/cms/themes/managefan/img/favicons/apple-touch-icon-ipad.png">
	<!-- For iPhone 3G, iPod Touch and Android -->
	<link rel="apple-touch-icon-precomposed" href="system/cms/themes/managefan/img/favicons/apple-touch-icon.png">
	<!-- iOS web-app metas -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- Startup image for web apps -->
	<link rel="apple-touch-startup-image" href="system/cms/themes/managefan/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
	<link rel="apple-touch-startup-image" href="system/cms/themes/managefan/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
	<link rel="apple-touch-startup-image" href="system/cms/themes/managefan/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

	<!-- Microsoft clear type rendering -->
	<meta http-equiv="cleartype" content="on">

	<!-- IE9 Pinned Sites: http://msdn.microsoft.com/en-us/library/gg131029.aspx -->
	<meta name="application-name" content="Developr Admin Skin">
	<meta name="msapplication-tooltip" content="Cross-platform admin template.">
	<meta name="msapplication-starturl" content="http://www.display-inline.fr/demo/developr">
	<!-- These custom tasks are examples, you need to edit them to show actual pages -->
	<meta name="msapplication-task" content="name=Agenda;action-uri=http://www.display-inline.fr/demo/developr/agenda.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
	<meta name="msapplication-task" content="name=My profile;action-uri=http://www.display-inline.fr/demo/developr/profile.html;icon-uri=http://www.display-inline.fr/demo/developr/img/favicons/favicon.ico">
	
	<?php Asset::js('libs/modernizr.custom.js'); ?>
	<?php Asset::js('libs/jquery-1.7.2.min.js'); ?>
	<!-- JavaScript at the bottom for fast page loading -->

	<!-- Scripts -->
	<?php Asset::js('setup.js'); ?>
	<!-- Template functions -->
	<?php Asset::js('developr.input.js'); ?>
	<?php Asset::js('developr.message.js'); ?>
	<?php Asset::js('developr.notify.js'); ?>
	<?php Asset::js('developr.tooltip.js'); ?>	
	<?php Asset::js('admin/login.js'); ?>
	
	
	<?php echo Asset::render() ?>
	
</head>

<body>

<div id="container">

		<?php $this->load->view('admin/partials/notices') ?>

		<hgroup id="login-title" class="large-margin-bottom">
			<h1 class="login-title-image"></h1>
			<h5><?php echo $this->settings->site_name; ?></h5>
		</hgroup>

		<div id="form-block" class="scratch-metal">
			<?php echo form_open('admin/login'); ?>
				<ul class="inputs black-input large">
					<!-- The autocomplete="off" attributes is the only way to prevent webkit browsers from filling the inputs with yellow -->
					<li><span class="icon-user mid-margin-right"></span><input type="text" name="email" id="login" value="" class="input-unstyled" placeholder="<?php echo lang('email_label'); ?>" autocomplete="off"></li>
					<li><span class="icon-lock mid-margin-right"></span><input type="password" name="password" id="pass" value="" class="input-unstyled" placeholder="<?php echo lang('password_label'); ?>" autocomplete="off"></li>
				</ul>

				<p class="button-height">
					<button type="submit" class="button glossy float-right" id="login"><?php echo lang('login_label'); ?></button>
					<input type="checkbox" name="remember" id="remind" value="1" class="switch tiny mid-margin-right with-tooltip" title="<?php echo lang('user_remember'); ?>">
					<label for="remind"><?php echo lang('user_remember'); ?></label>
				</p>
			<?php echo form_close(); ?>
		</div>

</div>
		
</body>
</html>