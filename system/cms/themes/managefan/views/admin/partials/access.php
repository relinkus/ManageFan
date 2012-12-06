<ul id="access" class="children-tooltip">
	
	<li><?php //if ($this->settings->enable_profiles) echo anchor('edit-profile', '<span class="icon-user"></span>', array('title' => lang('cp_edit_profile_label'))) ?></li>
	<?php if (array_key_exists('settings', $this->permissions) OR $this->current_user->group == 'admin'): ?>
	<li><?php //echo anchor('admin/settings', '<span class="icon-gear"></span>',array('title' => lang('cp_nav_settings')));?></li>
	<?php endif; ?>
	<li><?php echo anchor('admin/logout', '<span class="icon-inbox">' ,array('title' => lang('cp_logout_label'))); ?></li>

								
</ul>