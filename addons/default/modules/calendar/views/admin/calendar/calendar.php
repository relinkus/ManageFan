<section class="title">
    <h4><?php echo lang('calendar_title.calendar'); ?><span id="loader" style="display:none;"><?php echo Asset::img('module::loader.gif', 'Loading...'); ?></span></h4>
    <?php if($categories){ ?>
        <?php foreach($categories as $key => $category){ ?>
            <a href="javascript:addCategory(<?php echo $category->id; ?>);" id="category-<?php echo $category->id; ?>" class="tooltip-s show-category" style="background-color:<?php echo $category->item_color; ?>;" original-title="<?php echo $category->name; ?>"></a>
        <?php } ?>
    <?php } ?>
</section>

<section class="item">
    
    <div id="calendar"></div>

</section>