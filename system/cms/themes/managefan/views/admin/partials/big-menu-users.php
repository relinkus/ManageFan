<li class="with-right-arrow">

<ul class="big-menu">
	
		<li class="with-right-arrow">
			<a href="<?php echo current_url().'#'; ?>"><?php echo lang('global:profile'); ?></a>
			<ul class="big-menu">
				<li><?php if ($this->settings->enable_profiles) echo anchor('edit-profile', lang('cp_edit_profile_label')) ?></li>
				
				<li><?php echo anchor('admin/logout', lang('cp_logout_label')); ?></li>
				
				
			</ul>
		</li>

</ul>
</li>
