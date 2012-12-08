<section class="title">
    <h4><?php if(isset($item_type)){ echo lang('calendar_title.edit_item_type'); } else { echo lang('calendar_title.new_item_type'); } ?></h4>
</section>

<section class="item">
    
    <?php echo form_open(uri_string(), 'class="crud"'); ?>
    
    <div class="tabs">
    
        <ul class="tab-menu">
                <li><a href="#basic-data-tab"><span><?php echo lang('calendar_label.basic_tab');?></span></a></li>
                <li><a href="#template-data-tab"><span><?php echo lang('calendar_label.template_tab');?></span></a></li>
        </ul>

        <div class="form_inputs" id="basic-data-tab">
            
            <fieldset>
            
                <ul>
                    <li>
                        <label for="type[name]"><?php echo lang('calendar_label.name'); ?> <span>*</span></label>
                        <div class="input"><?php echo form_input('type[name]', set_value('type[name]', @$item_type->stream_name), 'id="name"');?></div>
                    </li>
                    <?php if(!isset($item_type)){ ?>
                        <li>
                            <label for="type[slug]"><?php echo lang('calendar_label.slug'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('type[slug]', set_value('type[slug]', @$item_type->stream_slug), 'id="slug"');?></div>
                        </li>
                    <?php } ?>
                    <li>
                        <label for="type[about]"><?php echo lang('calendar_label.about'); ?></label>
                        <div class="input"><?php echo form_textarea('type[about]', set_value('type[about]', @$item_type->about));?></div>
                    </li>
                </ul> 
                
            </fieldset>
                
        </div>
        
        <div class="form_inputs" id="template-data-tab">
            
            <fieldset>
            
                <ul>
                    <li>
                        <label for="type[admin_layout]"><?php echo lang('calendar_label.admin_layout'); ?> <span>*</span><small><?php echo lang('calendar_label.admin_layout.desc'); ?></small></label>
                        <div class="input"><?php echo form_textarea('type[admin_layout]', set_value('type[admin_layout]', @$item_type->admin_layout));?></div>
                    </li>
                    <li>
                        <label for="type[public_layout]"><?php echo lang('calendar_label.public_layout'); ?> <span>*</span><small><?php echo lang('calendar_label.public_layout.desc'); ?></small></label>
                        <div class="input"><?php echo form_textarea('type[public_layout]', set_value('type[public_layout]', @$item_type->public_layout));?></div>
                    </li>
                    <li>
                        <label for="type[public_layout_full]"><?php echo lang('calendar_label.public_layout_full'); ?> <span>*</span><small><?php echo lang('calendar_label.public_layout_full.desc'); ?></small></label>
                        <div class="input"><?php echo form_textarea('type[public_layout_full]', set_value('type[public_layout_full]', @$item_type->public_layout_full));?></div>
                    </li>
                </ul> 
                
            </fieldset>
                
        </div>
        
    </div>
        
    <div class="buttons">
        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
    </div>
    
    <?php echo form_close(); ?>

</section>