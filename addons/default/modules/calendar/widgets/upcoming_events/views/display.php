<?php if($entries){ ?>
    <ul>
        <?php foreach($entries as $key => $entry){ ?>
        <li>
            <?php echo anchor('calendar/view/'.$category.'/'.$entry->id, $entry->formated['out']); ?>
        </li>
        <?php } ?>
    </ul>
<?php } else { ?>
    <?php echo lang('calendar_message.no_upcoming'); ?>
<?php } ?>
