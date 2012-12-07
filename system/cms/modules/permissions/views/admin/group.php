<div class="with-padding">
	<div class="columns">
	<div class="new-row twelve-columns">
	<p class="wrapped left-icon icon-info-round">
	<?php echo $group->description; ?>
	</p>
	</div>
	

<?php echo form_open(uri_string(), array('class'=> 'crud', 'id'=>'edit-permissions',)); ?>
<table class="simple-table responsive-table" id="sorting-example2">
	<thead>
		<tr>
			<th scope="col"><?php echo form_checkbox(array('id'=>'check-all', 'name' => 'action_to_all', 'class' => 'check-all', 'title' => lang('permissions:checkbox_tooltip_action_to_all'))); ?></th>
			<th scope="col"><?php echo lang('permissions:module'); ?></th>
			<th scope="col"><?php echo lang('permissions:roles'); ?></th>
		</tr>
	</thead>
	<tfoot>
			<tr>
				<td colspan="8">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
	</tfoot>
	<tbody>
		<?php foreach ($permission_modules as $module): ?>
		<tr>
			<td scope="row" class="checkbox-cell">
				<?php /*sprintf(lang('groups.edit_title'), $group->name)*/
				echo form_checkbox(array(
					'id'=> $module['slug'],
					'class' => 'checkbox mid-margin-left',
					'value' => true,
					'name'=>'modules[' . $module['slug'] . ']',
					'checked'=> array_key_exists($module['slug'], $edit_permissions),
					'title' => sprintf(lang('permissions:checkbox_tooltip_give_access_to_module'), $module['name']),
				)); ?>
			</td>
			<td>
				<label class="label" for="<?php echo $module['slug']; ?>">
					<?php echo $module['name']; ?>
				</label>
			</td>
			<td>
			<?php if ( ! empty($module['roles'])): ?>
				<?php foreach ($module['roles'] as $role): ?>
				<label class="label">
					<?php echo form_checkbox(array(
						'class' => 'checkbox mid-margin-left',
						'name' => 'module_roles[' . $module['slug'] . ']['.$role.']',
						'value' => true,
						'checked' => isset($edit_permissions[$module['slug']]) AND array_key_exists($role, (array) $edit_permissions[$module['slug']])
					)); ?>
					<?php echo lang($module['slug'].'.role_'.$role); ?>
				</label>
				<?php endforeach; ?>
			<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div>
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>
<?php echo form_close(); ?>

</div>