<div class="with-padding">
	<div class="columns">
	<div class="new-row ten-columns">
	<p class="wrapped left-icon icon-info-round">
		<?php echo lang('permissions:introduction'); ?>
	</p>
	</div>
</div>


	<table class="simple-table responsive-table" id="sorting-example2">
		<thead>
			<tr>
				<th scope="col" width="50%"><?php echo lang('permissions:group'); ?></th>
				<th scope="col" width="50%"></th>
			</tr>
		</thead>
		<tfoot>
				<tr>
					<td colspan="2">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
		<tbody>
			<?php foreach ($groups as $group): ?>
			<tr>
				<td><?php echo $group->description; ?></td>
				<td class="buttons actions">
					<?php if ($admin_group != $group->name):?>
					<?php echo anchor('admin/permissions/group/' . $group->id, lang('permissions:edit'), array('class'=>'button icon-pencil')); ?>
					<?php else: ?>
					<?php echo lang('permissions:admin_has_all_permissions'); ?>
					<?php endif; ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>