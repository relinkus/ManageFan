<section class="title">
    <h4><?php if(isset($entry)){ echo lang('calendar_title.edit_entry'); } else { echo lang('calendar_title.new_entry'); } ?> &rarr; <?php echo $type->stream_name; ?></h4>
</section>

<section class="item">
    
    <?php echo form_open_multipart(uri_string(), 'class="crud"'); ?>
    
        <?php echo form_hidden('basic_data[item_type]', $type->id); ?>
    
        <div class="tabs">
    
            <ul class="tab-menu">
                    <li><a href="#basic-data-tab"><span><?php echo lang('calendar_label.calendar_tab');?></span></a></li>
                    <li><a href="#item-data-tab"><span><?php echo lang('calendar_label.event_tab');?></span></a></li>
            </ul>

            <div class="form_inputs" id="basic-data-tab">

                <fieldset>
                
                    <ul>

                        <li>
                            <label for="basic_data[date_start]"><?php echo lang('calendar_label.date_start'); ?> <span>*</span></label>
                            <div class="input">
                                <?php echo form_input('basic_data[date_start][date]', set_value('basic_data[date_start][date]', @$entry->_date_start->date), 'class="date-picker"'); ?><br/>
                                <?php echo form_dropdown('basic_data[date_start][hour]', $hours, set_value('basic_data[date_start][hour]', @$entry->_date_start->hour)); ?> : <?php echo form_dropdown('basic_data[date_start][minute]', $minutes, set_value('basic_data[date_start][minute]', @$entry->_date_start->minute)); ?>
                            </div>
                        </li>

                        <li>
                            <label for="basic_data[date_end]"><?php echo lang('calendar_label.date_end'); ?> <span>*</span></label>
                            <div class="input">
                                <?php echo form_input('basic_data[date_end][date]', set_value('basic_data[date_end][date]', @$entry->_date_end->date), 'class="date-picker"'); ?><br/>
                                <?php echo form_dropdown('basic_data[date_end][hour]', $hours, set_value('basic_data[date_end][hour]', @$entry->_date_end->hour)); ?> : <?php echo form_dropdown('basic_data[date_end][minute]', $minutes, set_value('basic_data[date_end][minute]', @$entry->_date_end->minute)); ?>
                            </div>
                        </li>
                        
                        <li>
                            <label for="basic_data[recurrence]"><?php echo lang('calendar_label.recurrence'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_dropdown('basic_data[recurrence]', $recurrence, set_value('basic_data[recurrence]', @$entry->recurrence)); ?></div>
                        </li>

                        <li>
                            <label for="basic_data[category]"><?php echo lang('calendar_label.category'); ?> <span>*</span></label>
                            <div class="input">
                                <?php if(is_array($calendar_categories)){ ?>
                                    <?php echo form_dropdown('basic_data[category]', $calendar_categories, set_value('basic_data[category]', @$entry->category)); ?>
                                <?php } else { ?>
                                    <em><?php echo $calendar_categories; ?></em>
                                <?php } ?>
                            </div>
                        </li>

                        <li>
                            <label for="basic_data[restricted_to]"><?php echo lang('calendar_label.restricted_to'); ?></label>
                            <div class="input"><?php echo form_multiselect('basic_data[restricted_to][]', array(0 => lang('global:select-any'), 'guests' => lang('calendar_label.guests')) + $group_options, $restricted_to, 'size="'.(($count = count($group_options)) > 1 ? $count : 2).'"'); ?></div>
                        </li>

                    </ul>
                    
                </fieldset>

            </div>
            
            <div class="form_inputs" id="item-data-tab">

                <fieldset>
                
                    <ul>
                        
                        <?php if(isset($fields)){ ?>

                            <?php foreach( $fields as $field ) { ?>

                                <li>
                                    <label for="<?php echo $field['input_slug'];?>"><?php echo $this->fields->translate_label($field['input_title']);?> <?php echo $field['required'];?>

                                    <?php if( $field['instructions'] != '' ): ?>
                                            <br /><small><?php echo $field['instructions']; ?></small>
                                    <?php endif; ?>
                                    </label>

                                    <div class="input"><?php echo $field['input']; ?></div>
                                </li>

                            <?php } ?>
                            
                        <?php } ?>

                    </ul>
                    
                </fieldset>

            </div>
            
        </div>
    
        <div class="buttons float-right padding-top">
            <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
        </div>
    
    <?php echo form_close(); ?>

</section>