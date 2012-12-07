<div class="with-padding">
	<div class="columns">
	<div class="new-row ten-columns">
	<p class="wrapped left-icon icon-info-round">
		<?php if ( $this->uri->segment(2) ) { echo '&nbsp; | &nbsp;'; } ?>
		<?php echo $module_details['description'] ? $module_details['description'] : ''; ?>
	</p>
	</div>
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
	</div>

	<?php if ($groups): ?>
		<table class="simple-table responsive-table" id="sorting-example2">
			<thead>
				<tr>
					<th scope="col" width="40%"><?php echo lang('groups.name');?></th>
					<th scope="col"><?php echo lang('groups.short_name');?></th>
					<th scope="col" width="300"></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="3">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php foreach ($groups as $group):?>
				<tr>
					<th scope="row"><?php echo $group->description; ?></th>
					<td><?php echo $group->name; ?></td>
					<td class="align-right vertical-center">
						<span class="button-group compact">
					<?php echo anchor('admin/groups/edit/'.$group->id, lang('buttons.edit'), 'class="button icon-pencil"'); ?>
					<?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
						<?php echo anchor('admin/groups/delete/'.$group->id, lang('buttons.delete'), array('class'=>'button icon-trash with-tooltip confirm', 'title' => lang('global:delete'))); ?>
					<?php endif; ?>
					<?php echo anchor('admin/permissions/group/'.$group->id, lang('permissions.edit').'&rarr;', array('class'=>'button icon-gear with-tooltip', 'title' => 'Permissions')); ?>
						</span>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
	
	<?php else: ?>
		<section class="title">
			<p><?php echo lang('groups.no_groups');?></p>
		</section>
	<?php endif;?>