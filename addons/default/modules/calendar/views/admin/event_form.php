<section class="title">
    <h4><?php if(isset($download_details)){ echo lang('downloads_edit_download'); } else { echo lang('downloads_new_download'); } ?></h4>
</section>

<section class="item">
    
    <?php echo form_open(uri_string(), 'class="crud"'); ?>
    
    <div class="tabs">
        
        <ul class="tab-menu">
            <li><a href="#calendar-tab"><span><?php echo lang('calendar_label.calendar_tab');?></span></a></li>
            <li><a href="#event-tab"><span><?php echo lang('calendar_label.event_tab');?></span></a></li>
        </ul>
        
        <div class="form_inputs" id="calendar-tab">
            
            <fieldset>
                
                <ul>
                    
                    <li>
                        <label for=""><?php echo lang('calendar_label.date_start'); ?> <span>*</span></label>
                        <div class="input"></div>
                    </li>
                    
                    <li>
                        <label for=""><?php echo lang('calendar_label.date_end'); ?> <span>*</span></label>
                        <div class="input"></div>
                    </li>
                    
                    <li>
                        <label for="restricted_to"><?php echo lang('calendar_label.restricted_to'); ?></label>
                        <div class="input"><?php echo form_multiselect('restricted_to[]', array(-1 => lang('global:select-any'), 0 => lang('calendar_label.guests')) + $group_options, '', 'size="'.(($count = count($group_options)) > 1 ? $count : 2).'"'); ?></div>
                    </li>
                    
                </ul>
                
            </fieldset>
            
        </div>
        
        <div class="form_inputs" id="event-tab">
            
            <fieldset>
                
                <?php if($event_fields){ ?>
                    <ul>
                        <?php foreach($event_fields as $field){ ?>
                        
                            <li>
                                    <label for="<?php echo $field['field_slug'];?>"><?php echo $this->fields->translate_label($field['field_name']);?> <?php echo $field['required'] == 1 ? ' <span>*</span>' : '';?>

                                    <?php if( $field['instructions'] != '' ): ?>
                                            <br /><small><?php echo $field['instructions']; ?></small>
                                    <?php endif; ?>
                                    </label>

                                    <div class="input"><?php echo $field['input']; ?></div>
                            </li>

                        <?php } ?>
                    </ul>
                <?php } ?>
                
            </fieldset>
            
        </div>
        
    </div>
    
    <div class="buttons float-right padding-top">
        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
    </div>
    
    <?php echo form_close(); ?>

</section>