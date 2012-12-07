<fieldset id="filters" class="fieldset">

	<legend class="legend"><?php echo lang('global:filters'); ?></legend>
	
	<?php echo form_open(''); ?>
	<?php echo form_hidden('f_module', $module_details['slug']); ?>
		<div class="four-columns six-columns-tablet twelve-columns-mobile clearfix">
				<?php echo lang('user_active', 'f_active'); ?>
				<?php echo form_dropdown('f_active', array(0 => lang('global:select-all'), 1 => lang('global:yes'), 2 => lang('global:no') ), array(0)); ?>
			</div>

			<div class="four-columns six-columns-tablet twelve-columns-mobile clearfix">
				<?php echo lang('user_group_label', 'f_group'); ?>
				<?php echo form_dropdown('f_group', array(0 => lang('global:select-all')) + $groups_select); ?>
			</div>
			<div class="four-columns six-columns-tablet twelve-columns-mobile clearfix">
				<?php echo form_input('f_keywords'); ?>
				<?php echo anchor(current_url(), lang('buttons.cancel'), 'class="cancel"'); ?>
			</div>
	<?php echo form_close(); ?>
</fieldset>