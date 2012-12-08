<section class="title">
    <h4><?php if(isset($category_details)){ echo lang('calendar_title.edit_category'); } else { echo lang('calendar_title.new_category'); } ?></h4>
</section>

<section class="item">
    
    <?php echo form_open(uri_string(), 'class="crud"'); ?>
    
    <div class="form_inputs">
        <ul>
            <li>
                <label for="category[name]"><?php echo lang('calendar_label.name'); ?> <span>*</span></label>
                <div class="input"><?php echo form_input('category[name]', set_value('category[name]', @$category_details->name), 'id="name"');?></div>
            </li>
            <li>
                <label for="category[item_color]"><?php echo lang('calendar_label.item_color'); ?> <span>*</span><small><?php echo lang('calendar_label.item_color.desc'); ?></small></label>
                <div class="input"><?php echo form_input('category[item_color]', set_value('category[item_color]', @$category_details->item_color), 'id="color-picker"');?></div>
            </li>
        </ul> 
    </div>
    <div class="buttons">
        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
    </div>
    
    <?php echo form_close(); ?>

</section>