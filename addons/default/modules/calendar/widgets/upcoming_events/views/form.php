<ol>
	<li class="even">
		<label><?php echo lang('calendar_label.category'); ?>: </label>
		<?php echo form_dropdown('category', $categories, $options['category']); ?>
	</li>
	<li class="even">
		<label><?php echo lang('calendar_label.howmany'); ?>: </label>
		<?php echo form_input('howmany', $options['howmany']); ?>
	</li>
</ol>