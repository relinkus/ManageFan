<?php if($entries){ ?>

    <?php foreach($entries as $key => $entry){ ?>

        <?php $format = $this->calendar_lib->__format_row_public($entry); ?>

        <div class="blog_post">
            <div class="post_heading">
                <h2><?php echo anchor('calendar/view/'.$categoryid.'/'.$entry->id, $format['out']); ?></h2>
                <p class="post_date">Event date: <?php echo $entry->date_start; ?> - <?php echo $entry->date_end; ?></p>
            </div>
        </div>

    <?php } ?>

<?php } else { ?>

    <?php echo lang('calendar_message.no_entries'); ?>

<?php } ?>
