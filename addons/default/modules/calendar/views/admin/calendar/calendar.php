
<div class="m_calendar">

	<div class="two-columns">
		<?php if ( ! empty($module_details['sections'][$active_section]['shortcuts']) ||  ! empty($module_details['shortcuts'])): ?>

		<?php if ( ! empty($module_details['sections'][$active_section]['shortcuts'])): ?>
			
			<?php foreach ($module_details['sections'][$active_section]['shortcuts'] as $shortcut):
				$name 	= $shortcut['name'];
				$uri	= $shortcut['uri'];
				unset($shortcut['name']);
				unset($shortcut['uri']); ?>
			<a <?php foreach ($shortcut as $attr => $value) echo $attr.'="button green-gradient"'; echo 'href="' . site_url($uri) . '">' . lang($name) . '</a>'; ?>
			<?php endforeach; ?>
			
		<?php endif; ?>
		
		<?php if ( ! empty($module_details['shortcuts'])): ?>
			
			<?php foreach ($module_details['shortcuts'] as $shortcut):
				$name 	= $shortcut['name'];
				$uri	= $shortcut['uri'];
				unset($shortcut['name']);
				unset($shortcut['uri']); ?>
			
			<a <?php foreach ($shortcut as $attr => $value) echo $attr.'="button green-gradient"'; echo 'href="' . site_url($uri) . '">' . lang($name) . '</a>'; ?>
			<?php endforeach; ?>
			
		<?php endif; ?>

	<?php endif; ?>
		
	</div>

<section class="title">
    <h4><span id="loader" style="display:none;"><?php echo Asset::img('module::loader.gif', 'Loading...'); ?></span></h4>
    <?php if($categories){ ?>
        <?php foreach($categories as $key => $category){ ?>
            <a href="javascript:addCategory(<?php echo $category->id; ?>);" id="category-<?php echo $category->id; ?>" class="tooltip-s show-category" style="background-color:<?php echo $category->item_color; ?>;" original-title="<?php echo $category->name; ?>"></a>
        <?php } ?>
    <?php } ?>
</section>

<section class="item">
    <div id="calendar"></div>
</section>

</div>

<script>var SITE_URL = "<?= BASE_URI ?>";</script>
<script src="<?= BASE_URI ?>addons/default/modules/calendar/js/fullcalendar.min.js"></script>
<script src="<?= BASE_URI ?>addons/default/modules/calendar/js/calendar.init.js"></script>
<link rel="stylesheet" href="<?= BASE_URI ?>addons/default/modules/calendar/css/fullcalendar.css">
<link rel="stylesheet" href="<?= BASE_URI ?>addons/default/modules/calendar/css/theme.css">