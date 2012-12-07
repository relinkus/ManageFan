<!DOCTYPE html>

<!--[if IEMobile 7]><html class="no-js iem7 oldie linen"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie linen" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie linen" lang="en"><![endif]-->
<!--[if (IE 9)&!(IEMobile)]><html class="no-js ie9 linen" lang="en"><![endif]-->
<!--[if (gt IE 9)|(gt IEMobile 7)]><!--><html class="no-js linen" lang="en"><!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $this->settings->site_name; ?></title>
	
	<base href="<?php echo base_url(); ?>" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- http://davidbcalhoun.com/2010/viewport-metatag -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	<!-- For all browsers -->
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

	<!-- Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

	<!-- Additional styles -->
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/agenda.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/dashboard.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/form.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/modal.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/progress-slider.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/switches.css?v=1">
	<link rel="stylesheet" href="system/cms/themes/managefan/css/styles/table.css?v=1">
	<!-- glDatePicker -->
	<link rel="stylesheet" href="system/cms/themes/managefan/js/libs/glDatePicker/developr.css?v=1">

	<!-- jQuery Form Validation -->
	<link rel="stylesheet" href="system/cms/themes/managefan/js/libs/formValidator/developr.validationEngine.css?v=1">
	
	<!-- Webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>

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
	
	<!-- JavaScript at the bottom for fast page loading -->

	<!-- Scripts -->
	
	<?php Asset::js('libs/jquery-1.7.2.min.js'); ?>
	<?php Asset::js('setup.js'); ?>
	<!-- Template functions -->
	<?php Asset::js('developr.input.js'); ?>
	<?php Asset::js('developr.message.js'); ?>
	<?php Asset::js('developr.notify.js'); ?>
	<?php Asset::js('developr.modal.js'); ?>
	<?php Asset::js('developr.navigable.js'); ?>	
	<?php Asset::js('developr.scroll.js'); ?>	
	<?php Asset::js('developr.progress-slider.js'); ?>	
	<?php Asset::js('developr.tooltip.js'); ?>	
	<?php Asset::js('developr.confirm.js'); ?>
	<?php Asset::js('developr.agenda.js'); ?>	
	<?php Asset::js('developr.tabs.js'); ?>	<!-- Must be loaded last -->
	<?php Asset::js('developr.table.js'); ?>
	
	<!-- Plugins -->
	<?php Asset::js('libs/jquery.tablesorter.min.js'); ?>
	<?php Asset::js('libs/DataTables/jquery.dataTables.min.js'); ?>
	
	<!-- Tinycon -->	

	<?php Asset::js('libs/tinycon.min.js'); ?>	
	
	<?php echo Asset::render_js(); ?>
	<script>

		// Call template init (optional, but faster if called manually)
		$.template.init();

		// Favicon count
		Tinycon.setBubble(2);

		// If the browser support the Notification API, ask user for permission (with a little delay)
		if (notify.hasNotificationAPI() && !notify.isNotificationPermissionSet())
		{
			setTimeout(function()
			{
				notify.showNotificationPermission('Your browser supports desktop notification, click here to enable them.', function()
				{
					// Confirmation message
					if (notify.hasNotificationPermission())
					{
						notify('Notifications API enabled!', 'You can now see notifications even when the application is in background', {
							icon: 'img/demo/icon.png',
							system: true
						});
					}
					else
					{
						notify('Notifications API disabled!', 'Desktop notifications will not be used.', {
							icon: 'img/demo/icon.png'
						});
					}
				});

			}, 2000);
		}

		/*
		 * Handling of 'other actions' menu
		 */

		var otherActions = $('#otherActions'),
			current = false;

		// Other actions
		$('.list .button-group a:nth-child(2)').menuTooltip('Loading...', {

			classes: ['with-mid-padding'],
			ajax: 'ajax-demo/tooltip-content.html',

			onShow: function(target)
			{
				// Remove auto-hide class
				target.parent().removeClass('show-on-parent-hover');
			},

			onRemove: function(target)
			{
				// Restore auto-hide class
				target.parent().addClass('show-on-parent-hover');
			}
		});

		// Delete button
		$('.list .button-group a:last-child').data('confirm-options', {

			onShow: function()
			{
				// Remove auto-hide class
				$(this).parent().removeClass('show-on-parent-hover');
			},

			onConfirm: function()
			{
				// Remove element
				$(this).closest('li').fadeAndRemove();

				// Prevent default link behavior
				return false;
			},

			onRemove: function()
			{
				// Restore auto-hide class
				$(this).parent().addClass('show-on-parent-hover');
			}

		});

		// Demo modal
		function openModal()
		{
			$.modal({
				content: '<p>This is an example of modal window. You can open several at the same time (click links below!), move them and resize them.</p>'+
						  '<p>The plugin provides several other functions to control them, try below:</p>'+
						  '<ul class="simple-list with-icon">'+
						  '    <li><a href="javascript:void(0)" onclick="openModal()">Open new blocking modal</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$.modal.alert(\'This is a non-blocking modal, you can switch between me and the other modal\', { blocker: false })">Open non-blocking modal</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().setModalTitle(\'\')">Remove title</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().setModalTitle(\'New title\')">Change title</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().loadModalContent(\'ajax-demo/auto-setup.html\')">Load Ajax content</a></li>'+
						  '</ul>',
				title: 'Example modal window',
				width: 300,
				scrolling: false,
				actions: {
					'Close' : {
						color: 'red',
						click: function(win) { win.closeModal(); }
					},
					'Center' : {
						color: 'green',
						click: function(win) { win.centerModal(true); }
					},
					'Refresh' : {
						color: 'blue',
						click: function(win) { win.closeModal(); }
					},
					'Abort' : {
						color: 'orange',
						click: function(win) { win.closeModal(); }
					}
				},
				buttons: {
					'Close': {
						classes:	'huge blue-gradient glossy full-width',
						click:		function(win) { win.closeModal(); }
					}
				},
				buttonsLowPadding: true
			});
		};

		// Demo alert
		function openAlert()
		{
			$.modal.alert('This is an alert message', {
				buttons: {
					'Thanks, captain obvious': {
						classes:	'huge blue-gradient glossy full-width',
						click:		function(win) { win.closeModal(); }
					}
				}
			});
		};

		// Demo prompt
		function openPrompt()
		{
			var cancelled = false;

			$.modal.prompt('Please enter a value between 5 and 10:', function(value)
			{
				value = parseInt(value);
				if (isNaN(value) || value < 5 || value > 10)
				{
					$(this).getModalContentBlock().message('Please enter a correct value', { append: false, classes: ['red-gradient'] });
					return false;
				}

				$.modal.alert('Value: <strong>'+value+'</strong>');

			}, function()
			{
				if (!cancelled)
				{
					$.modal.alert('Oh, come on....');
					cancelled = true;
					return false;
				}
			});
		};

		// Demo confirm
		function openConfirm()
		{
			$.modal.confirm('Challenge accepted?', function()
			{
				$.modal.alert('Me gusta!');

			}, function()
			{
				$.modal.alert('Meh.');
			});
		};

		/*
		 * Agenda scrolling
		 * This example shows how to remotely control an agenda. most of the time, the built-in controls
		 * using headers work just fine
		 */

			// Days
		var daysName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],

			// Name display
			agendaDay = $('#agenda-day'),

			// Agenda scrolling
			agenda = $('#agenda').scrollAgenda({
				first: 2,
				onRangeChange: function(start, end)
				{
					if (start != end)
					{
						agendaDay.text(daysName[start].substr(0, 3)+' - '+daysName[end].substr(0, 3));
					}
					else
					{
						agendaDay.text(daysName[start]);
					}
				}
			});

		// Remote controls
		$('#agenda-previous').click(function(event)
		{
			event.preventDefault();
			agenda.scrollAgendaToPrevious();
		});
		$('#agenda-today').click(function(event)
		{
			event.preventDefault();
			agenda.scrollAgendaFirstColumn(2);
		});
		$('#agenda-next').click(function(event)
		{
			event.preventDefault();
			agenda.scrollAgendaToNext();
		});

		// Demo loading modal
		function openLoadingModal()
		{
			var timeout;

			$.modal({
				contentAlign: 'center',
				width: 240,
				title: 'Loading',
				content: '<div style="line-height: 25px; padding: 0 0 10px"><span id="modal-status">Contacting server...</span><br><span id="modal-progress">0%</span></div>',
				buttons: {},
				scrolling: false,
				actions: {
					'Cancel': {
						color:	'red',
						click:	function(win) { win.closeModal(); }
					}
				},
				onOpen: function()
				{
						// Progress bar
					var progress = $('#modal-progress').progress(100, {
							size: 200,
							style: 'large',
							barClasses: ['anthracite-gradient', 'glossy'],
							stripes: true,
							darkStripes: false,
							showValue: false
						}),

						// Loading state
						loaded = 0,

						// Window
						win = $(this),

						// Status text
						status = $('#modal-status'),

						// Function to simulate loading
						simulateLoading = function()
						{
							++loaded;
							progress.setProgressValue(loaded+'%', true);
							if (loaded === 100)
							{
								progress.hideProgressStripes().changeProgressBarColor('green-gradient');
								status.text('Done!');
								/*win.getModalContentBlock().message('Content loaded!', {
									classes: ['green-gradient', 'align-center'],
									arrow: 'bottom'
								});*/
								setTimeout(function() { win.closeModal(); }, 1500);
							}
							else
							{
								if (loaded === 1)
								{
									status.text('Loading data...');
									progress.changeProgressBarColor('blue-gradient');
								}
								else if (loaded === 25)
								{
									status.text('Loading assets (1/3)...');
								}
								else if (loaded === 45)
								{
									status.text('Loading assets (2/3)...');
								}
								else if (loaded === 85)
								{
									status.text('Loading assets (3/3)...');
								}
								else if (loaded === 92)
								{
									status.text('Initializing...');
								}
								timeout = setTimeout(simulateLoading, 50);
							}
						};

					// Start
					timeout = setTimeout(simulateLoading, 2000);
				},
				onClose: function()
				{
					// Stop simulated loading if needed
					clearTimeout(timeout);
				}
			});
		};
		
	</script>
	

	
</head>


<body class="clearfix with-menu with-shortcuts">

		
		<?php file_partial('header'); ?>

		<?php echo $template['body']; ?>
		
	</section>
	<!-- End main content -->

	<!-- Side tabs shortcuts -->
	<?php file_partial('side-tabs-shortcuts'); ?>

	<!-- Sidebar/drop-down menu -->
	<section id="menu" role="complementary">

		<!-- This wrapper is used by several responsive layouts -->
		<div id="menu-content">

			<header>
				Administrator
			</header>

			<div id="profile">
				<?php echo Asset::img('user.png',  array('class' => 'user-icon'));?>
				Hello
				<span class="name">Jon Doe</span>
			</div>

			<!-- By default, this section is made for 4 icons, see the doc to learn how to change this, in "basic markup explained" -->
			<?php file_partial('access'); ?>

			<section class="navigable">
				
					<!-- MENU SIDEBAR VERDE
					<?php file_partial('big-menu-users'); ?>-->
				
			</section>

			<ul class="unstyled-list">
				</ul>

		</div>
		<!-- End content wrapper -->

		<!-- This is optional -->

	<footer id="menu-footer">
		<form action="<?php echo current_url(); ?>" id="change_language" method="get">
				<select id="validation-select" class="select validate[required]" name="lang" onchange="this.form.submit();">
					<?php foreach($this->config->item('supported_languages') as $key => $lang): ?>
						<option value="<?php echo $key; ?>" <?php echo CURRENT_LANGUAGE == $key ? 'selected="selected"' : ''; ?>>
								<?php echo $lang['name']; ?>
							</option>
					<?php endforeach; ?>
				</select>
		</form>
	</footer>
	
	</section>
	<!-- End sidebar/drop-down menu -->

	</body>
</html>