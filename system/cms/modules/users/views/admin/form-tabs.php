
	<?php if ($this->method == 'create'): ?>
		<p class="wrapped left-icon icon-info-round"><?php echo lang('user_add_title');?></p>
		<?php echo form_open_multipart(uri_string(), 'class="crud" autocomplete="off"'); ?>
	
	<?php else: ?>
		<p class="wrapped left-icon icon-info-round"><?php echo sprintf(lang('user_edit_title'), $member->username);?></p>
		<?php echo form_open_multipart(uri_string(), 'class="crud"'); ?>
	<?php endif; ?>


<div class="with-padding">
	<div class="columns">
	<div class="new-row twelve-columns">
	
	<div class="standard-tabs margin-bottom" id="add-tabs">

		<ul class="tabs">
			<li class="active"><a href="#user-basic-data-tab"><span><?php echo lang('profile_user_basic_data_label');?></span></a></li>
			<li><a href="#user-profile-fields-tab"><span><?php echo lang('user_profile_fields_label');?></span></a></li>
		</ul>

		<!-- Content tab -->
		<div class="tabs-content">
			<div class="with-padding" id="user-basic-data-tab">
						<p class="inline-label button-height">
							<label for="email" class="label"><?php echo lang('user_email_label');?><span>*</span></label>
							<?php echo form_input('email', $member->email, 'id="email" class="input"'); ?>
						</p>
						<p class="inline-label button-height">
							<label for="username" class="label"><?php echo lang('user_username');?><span>*</span></label>
							<?php echo form_input('username', $member->username, 'id="username" class="input"'); ?>
						</p>
						
						<p class="inline-label button-height">
							<label for="group_id" class="label"><?php echo lang('user_group_label');?></label>
							<?php echo form_dropdown('group_id', array(0 => lang('global:select-pick')) + $groups_select, $member->group_id, 'id="group_id" class="select validate[required]"'); ?>
						</p>
						<p class="inline-label button-height">
							<label for="active" class="label"><?php echo lang('user_activate_label');?></label>
							<?php $options = array(0 => lang('user_do_not_activate'), 1 => lang('user_active'), 2 => lang('user_send_activation_email')); ?>
								<?php echo form_dropdown('active', $options, $member->active, 'id="active" class="select validate[required]"'); ?>
						</p>
						<p class="inline-label button-height">
							<label for="password" class="label">
								<?php echo lang('user_password_label');?>
								<?php if ($this->method == 'create'): ?> <span>*</span><?php endif; ?></label>
							<?php echo form_password('password', '', 'id="password" class="input" autocomplete="off"'); ?>
						</p>
				</div>
			
			<div class="with-padding" id="user-profile-fields-tab">
						<p class="inline-label button-height">
							<label for="display_name" class="label"><?php echo lang('profile_display_name');?><span>*</span></label>
							<?php echo form_input('display_name', $display_name, 'id="display_name" class="input"'); ?>
						</p>
							
						<?php foreach($profile_fields as $field) { ?>
						<p class="inline-label button-height">
							<label for="<?php echo $field['field_slug']; ?>" class="label">
								<?php echo (lang($field['field_name'])) ? lang($field['field_name']) : $field['field_name'];  ?>
								<?php if ($field['required']){ ?> <span>*</span><?php } ?>
							</label>
							
								<?php echo $field['input']; ?>
				
						</p>
						<?php } ?>
	
			</div>
		</div>
	</div>
	</div>
	</div>

	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>

<?php echo form_close(); ?>

</div>