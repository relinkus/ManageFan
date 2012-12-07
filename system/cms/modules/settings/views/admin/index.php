<div class="with-padding">

<?php if ($setting_sections): ?>
	<?php echo form_open('admin/settings/edit', 'class="crud"');?>

		<div class="side-tabs same-height">

			<ul class="tabs">
				<?php foreach ($setting_sections as $section_slug => $section_name): ?>
				<li>
					<a href="#<?php echo $section_slug; ?>" title="<?php printf(lang('settings_section_title'), $section_name); ?>">
					<?php echo $section_name; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>

			<?php foreach ($setting_sections as $section_slug => $section_name): ?>
			<div class="tabs-content" id="<?php echo $section_slug;?>">
				
					
					
					<?php $section_count = 1; foreach ($settings[$section_slug] as $setting): ?>
						<div id="<?php echo $setting->slug; ?>" class="<?php echo $section_count++ % 2 == 0 ? 'even' : ''; ?> with-padding">
							<p class="inline-large-label button-height">
							<label for="<?php echo $setting->slug; ?>" class="label">
								<?php echo $setting->title; ?>
								
							</label>
							
								<?php echo $setting->form_control; ?>
							
							
							<span class="info-spot">
							<span class="icon-info-round"></span>
							<span class="info-bubble">
								<?php if($setting->description): echo '<small>'.$setting->description.'</small>'; endif; ?>
							</span>
						</span>
						</p>
							
						</div>
					<?php endforeach; ?>
					
				
			</div>
			<?php endforeach; ?>

		</div>

		<div>
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save') )); ?>
		</div>

	<?php echo form_close(); ?>
<?php else: ?>
	<div>
		<p><?php echo lang('settings_no_settings');?></p>
	</div>
<?php endif; ?>
</div>
