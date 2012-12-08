<?php if(count($categories) > 0){ ?>
<table>
    <tr>
        <th><?php echo lang('calendar_label.name'); ?></th>
        <th><?php echo lang('calendar_label.item_color'); ?></th>
        <th><?php echo lang('calendar_label.total_items'); ?></th>
        <th></th>
    </tr>
    <tbody>
        <?php foreach($categories as $key => $category){ ?>
        <tr>
            <td><?php echo $category->name; ?></td>
            <td><span style="border:1px solid #000000;padding:3px 6px;background-color: <?php echo $category->item_color; ?>;">&nbsp;</span> <?php echo $category->item_color; ?></td>
            <td><?php echo $category->total_items; ?></td>
            <td class="actions">
                <?php echo anchor('admin/calendar/categories/edit/'.$category->id, 'Edit', 'class="btn orange"'); ?>
                <?php if($category->total_items <= 0) echo anchor('admin/calendar/categories/delete/'.$category->id, 'Delete', 'class="confirm btn red delete"'); ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php } else { ?>
    <div class="no_data"><?php echo lang('calendar_message.no_categories'); ?></div>
<?php } ?>