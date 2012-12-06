<ul id="shortcuts" class="children-tooltip tooltip-right">
	
	<?php echo '<li class="'.(($this->module == '' ? 'current' : '')) .'">';
	 		echo anchor('admin', lang('global:dashboard'), 'class="shortcut-dashboard"');?></li>
	<li><a href="<?php echo current_url().'#'; ?>" class="shortcut-messages" title="Messages">Messages</a></li>
	<li><a href="<?php echo current_url().'#'; ?>" class="shortcut-agenda" title="Agenda">Agenda</a></li>
	<li><a href="<?php echo current_url().'#'; ?>" class="shortcut-contacts" title="Contacts">Contacts</a></li>
	<li><a href="<?php echo current_url().'#'; ?>" class="shortcut-medias" title="Medias">Medias</a></li>
	<li><a href="<?php echo current_url().'#'; ?>" class="shortcut-stats" title="Stats">Stats</a></li>
	<?php if (array_key_exists('settings', $this->permissions) OR $this->current_user->group == 'admin'): ?>
	<?php echo '<li class="'.(($this->module == 'settings' ? 'current' : '')) .'">';
			 echo anchor('admin/settings', lang('cp_nav_settings'),'class="shortcut-settings"');?></li>
	<?php endif; ?>
	<li><span class="shortcut-notes" title="Notes">Notes</span></li>	
</ul>
