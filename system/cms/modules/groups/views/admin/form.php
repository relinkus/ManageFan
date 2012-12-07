<div class="with-padding">
	<div class="columns">
		<div class="new-row twelve-columns">
<?php if ($this->method == 'edit'): ?>
	
    	<p class="wrapped left-icon icon-info-round"><?php echo sprintf(lang('groups.edit_title'), $group->name); ?></p>
	
<?php else: ?>
	
    	<p class="wrapped left-icon icon-info-round"><?php echo lang('groups.add_title'); ?></p>
	
<?php endif; ?>
</div>

<div class="six-columns twelve-columns-tablet">
<?php echo form_open(uri_string(), 'class="crud"'); ?>



		<p class="inline-label button-height">
			<label for="description" class="label"><?php echo lang('groups.name');?> <span>*</span></label>
			<?php echo form_input('description', $group->description,  'id="description" class="input"');?>
		</p>
		
		<p class="inline-label button-height">
			<label for="name" class="label"><?php echo lang('groups.short_name');?> <span>*</span></label>
			

			<?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
			<?php echo form_input('name', $group->name,  'id="name" class="input"');?>

			<?php else: ?>
			<input type="text" id="name" class="input" value="<?php echo $group->name; ?>"></input>
			<?php endif; ?>
			
		</p>

	<div>
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>
	
<?php echo form_close();?>
</div>

</div>
</div>

<script type="text/javascript">
	jQuery(function($) {
		$('form input[name="description"]').keyup($.debounce(300, function(){

			var slug = $('input[name="name"]');

			$.post(SITE_URL + 'ajax/url_title', { title : $(this).val() }, function(new_slug){
				slug.val( new_slug );
			});
		}));
	});
</script>