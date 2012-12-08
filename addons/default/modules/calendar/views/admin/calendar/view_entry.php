<section class="title">
    <h4><?php echo lang('calendar_title.view_entry'); ?> #<?php echo $entry->id; ?></h4>
</section>

<section class="item">

    <?php echo form_open(uri_string(), 'class="crud"'); ?>
    
    <div class="form_inputs">
        <ul>
            <li>
                <label for="created_by"><?php echo lang('streams.created_by'); ?></label>
                <div class="input"><?php echo anchor('admin/users/edit/'.$entry->entry->created_by['user_id'], $entry->entry->created_by['display_name']); ?></div>
            </li>
            <li>
                <label for="created"><?php echo lang('streams.created_date'); ?></label>
                <div class="input"><?php echo date('M j Y g:i a', $entry->created_on); ?></div>
            </li>
            <?php if($entry->updated_on > 0){ ?>
                <li>
                    <label for="updated"><?php echo lang('streams.updated_date'); ?></label>
                    <div class="input"><?php echo date('M j Y g:i a', $entry->updated_on); ?></div>
                </li>
            <?php } ?>
            <li>
                <label for="id"><?php echo lang('streams.id'); ?></label>
                <div class="input"><?php echo $entry->id; ?></div>
            </li>
            <li>
                <label for="start_date"><?php echo lang('calendar_label.date_start'); ?></label>
                <div class="input"><?php echo $entry->date_start; ?></div>
            </li>
            <li>
                <label for="date_end"><?php echo lang('calendar_label.date_end'); ?></label>
                <div class="input"><?php echo $entry->date_end; ?></div>
            </li>
            <li>
                <label for="recurrence"><?php echo lang('calendar_label.recurrence'); ?></label>
                <div class="input"><?php echo lang('calendar_label.recurrence.'.$entry->recurrence); ?></div>
            </li>
            <li>
                <label for="category"><?php echo lang('calendar_label.category'); ?></label>
                <div class="input"><?php echo $entry->name; ?></div>
            </li>
            <li>
                <label for="item_type"><?php echo lang('calendar_label.item_type'); ?></label>
                <div class="input"><?php echo $stream->stream_name; ?></div>
            </li>
            <li>
                <label for="restricted_to"><?php echo lang('calendar_label.restricted_to'); ?></label>
                <div class="input"><?php echo $entry->restricted_to; ?></div>
            </li>
            <?php foreach($fields as $key => $field) { ?>
                <li>
                    <label for="<?php echo $field->field_slug; ?>"><?php echo $this->fields->translate_label($field->field_name); ?></label>
                    <div class="input"><?php echo $entry->entry->{$field->field_slug}; ?></div>
                </li>
            <?php } ?>
        </ul> 
    </div>
    <div class="buttons">
        <?php echo anchor('admin/calendar/edit/'.$entry->id, lang('global:edit'), 'class="btn orange"'); ?>
        <?php echo anchor('admin/calendar/delete/'.$entry->id, lang('global:delete'), 'class="btn red delete confirm"'); ?>
        <?php echo anchor('admin/calendar', lang('buttons.cancel'), 'class="btn gray"'); ?>
    </div>
    
    <?php echo form_close(); ?>

</section>