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