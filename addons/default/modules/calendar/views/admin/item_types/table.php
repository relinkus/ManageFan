<?php if(count($item_types) > 0){ ?>
<table>
    <tr>
        <th><?php echo lang('calendar_label.name'); ?></th>
        <th><?php echo lang('calendar_label.about'); ?></th>
        <th><?php echo lang('calendar_label.total_items'); ?></th>
        <th></th>
    </tr>
    <tbody>
        <?php foreach($item_types as $key => $type){ ?>
        <tr>
            <td><?php echo $type->stream_name; ?></td>
            <td><?php echo $type->about; ?></td>
            <td><?php echo $type->total_items; ?></td>
            <td class="actions">
                <?php echo anchor('admin/calendar/create/'.$type->id, 'New entry', 'class="btn green"'); ?>
                <?php echo anchor('admin/calendar/types/fields/'.$type->id, 'Fields', 'class="btn orange"'); ?>
                <?php echo anchor('admin/calendar/types/edit/'.$type->id, 'Edit', 'class="btn orange"'); ?>
                <?php if($type->total_items <= 0) echo anchor('admin/calendar/types/delete/'.$type->id, 'Delete', 'class="confirm btn red delete"'); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
    <div class="no_data"><?php echo lang('calendar_message.no_item_types'); ?></div>
<?php } ?>