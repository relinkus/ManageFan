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
	
	<?php if (!empty($users)): ?>
	<div class="table-header button-height">
		<div class="float-right">
			Search&nbsp;<input type="text" name="table_search" id="table_search" value="" class="input mid-margin-left">
		</div>
		
		Show<select name="range" class="select blue-gradient glossy" style="display: none">
			<option value="1">10</option>
			<option value="2">20</option>
			<option value="3" selected="selected">40</option>
			<option value="4">100</option>
		</select>
		
		
	</div>
	<table class="table responsive-table" id="sorting-example1">
		<thead>
			<tr>
				<th scope="col"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th><?php echo lang('user_name_label');?></th>
				<th scope="col"><?php echo lang('user_email_label');?></th>
				<th><?php echo lang('user_group_label');?></th>
				<th scope="col"><?php echo lang('user_active'); ?></th>
				<th scope="col" class="align-center hide-on-mobile"><?php echo lang('user_joined_label');?></th>
				<th scope="col" class="align-center hide-on-mobile-portrait"><?php echo lang('user_last_visit_label');?></th>
				<th scope="col" width="152" class="align-right"></th>
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
			<?php $link_profiles = Settings::get('enable_profiles'); ?>
			<?php foreach ($users as $member): ?>
				<tr>
					<td scope="row" class="checkbox-cell"><?php echo form_checkbox('action_to[]', $member->id); ?></td>
					<td>
					<?php if ($link_profiles) : ?>
						<?php echo anchor('admin/users/preview/' . $member->id, $member->display_name, 'target="_blank" class="modal-large"'); ?>
					<?php else: ?>
						<?php echo $member->display_name; ?>
					<?php endif; ?>
					</td>
					<td><?php echo mailto($member->email); ?></td>
					<td><?php echo $member->group_name; ?></td>
					<td><?php echo $member->active ? lang('global:yes') : lang('global:no') ; ?></td>
					<td><?php echo format_date($member->created_on); ?></td>
					<td><?php echo ($member->last_login > 0 ? format_date($member->last_login) : lang('user_never_label')); ?></td>
					<td class="align-right vertical-center">
						<span class="button-group compact">
						<?php echo anchor('admin/users/edit/' . $member->id, lang('global:edit'), array('class'=>'button icon-pencil')); ?>
						<?php echo anchor('admin/users/delete/' . $member->id, lang('global:delete') , array('class'=>'button icon-trash with-tooltip confirm', 'title' => lang('global:delete'))); ?>
						</span>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<form method="post" action="" class="table-footer button-height large-margin-bottom">
				<div class="float-right">
					<div class="button-group">
						<a href="#" title="First page" class="button blue-gradient glossy"><span class="icon-previous"></span></a>
						<a href="#" title="Previous page" class="button blue-gradient glossy"><span class="icon-backward"></span></a>
					</div>

					<div class="button-group">
						<a href="#" title="Page 1" class="button blue-gradient glossy">1</a>
						<a href="#" title="Page 2" class="button blue-gradient glossy active">2</a>
						<a href="#" title="Page 3" class="button blue-gradient glossy">3</a>
						<a href="#" title="Page 4" class="button blue-gradient glossy">4</a>
					</div>

					<div class="button-group">
						<a href="#" title="Next page" class="button blue-gradient glossy"><span class="icon-forward"></span></a>
						<a href="#" title="Last page" class="button blue-gradient glossy"><span class="icon-next"></span></a>
					</div>
				</div>

				With selected:
				<select name="select90" class="select blue-gradient glossy mid-margin-left" style="display: none">
					<option value="0">Delete</option>
					<option value="1">Duplicate</option>
					<option value="2">Put offline</option>
					<option value="3">Put online</option>
					<option value="4">Move to trash</option>
				</select>
				<button type="submit" class="button blue-gradient glossy" style="display: none">Go</button>
			</form>
			
		<?php echo form_open('admin/users/action'); ?>
	
		<div class="table_action_buttons">
			<?php //$this->load->view('admin/partials/buttons', array('buttons' => array('activate', 'delete') )); ?>
		</div>

		<?php echo form_close(); ?>
			<script>

		// Call template init (optional, but faster if called manually)
		$.template.init();

		// Table sort - DataTables
		var table = $('#sorting-advanced'),
			tableStyled = false;

		table.dataTable({
			'aoColumnDefs': [
				{ 'bSortable': false, 'aTargets': [ 0, 5 ] }
			],
			'sPaginationType': 'full_numbers',
			'sDom': '<"dataTables_header"lfr>t<"dataTables_footer"ip>',
			'fnDrawCallback': function( oSettings )
			{
				// Only run once
				if (!tableStyled)
				{
					table.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
					tableStyled = true;
				}
			}
		});

		// Table sort - styled
		$('#sorting-example1').tablesorter({
			headers: {
				0: { sorter: false },
				5: { sorter: false }
			}
		}).on('click', 'tbody td', function(event)
		{
			// Do not process if something else has been clicked
			if (event.target !== this)
			{
				return;
			}

			var tr = $(this).parent(),
				row = tr.next('.row-drop'),
				rows;

			// If click on a special row
			if (tr.hasClass('row-drop'))
			{
				return;
			}

			// If there is already a special row
			if (row.length > 0)
			{
				// Un-style row
				tr.children().removeClass('anthracite-gradient glossy');

				// Remove row
				row.remove();

				return;
			}

			// Remove existing special rows
			rows = tr.siblings('.row-drop');
			if (rows.length > 0)
			{
				// Un-style previous rows
				rows.prev().children().removeClass('anthracite-gradient glossy');

				// Remove rows
				rows.remove();
			}

			// Style row
			tr.children().addClass('anthracite-gradient glossy');

			// Add fake row
			$('<tr class="row-drop">'+
				'<td colspan="'+tr.children().length+'">'+
					'<div class="float-right">'+
						'<button type="submit" class="button glossy mid-margin-right">'+
							'<span class="button-icon"><span class="icon-mail"></span></span>'+
							'Send mail'+
						'</button>'+
						'<button type="submit" class="button glossy">'+
							'<span class="button-icon red-gradient"><span class="icon-cross"></span></span>'+
							'Remove'+
						'</button>'+
					'</div>'+
					'<strong>Name:</strong> John Doe<br>'+
					'<strong>Account:</strong> admin<br>'+
					'<strong>Last connect:</strong> 05-07-2011<br>'+
					'<strong>Email:</strong> john@doe.com'+
				'</td>'+
			'</tr>').insertAfter(tr);

		}).on('sortStart', function()
		{
			var rows = $(this).find('.row-drop');
			if (rows.length > 0)
			{
				// Un-style previous rows
				rows.prev().children().removeClass('anthracite-gradient glossy');

				// Remove rows
				rows.remove();
			}
		});

		// Table sort - simple
	    $('#sorting-example2').tablesorter({
			headers: {
				5: { sorter: false }
			}
		});

	</script>
<?php endif; ?>
</div>
