<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/9/2015
 * Time: 8:54 AM
 */
?>
<div class="entry-date">
    <div class="entry-date-inner">
        <div class="day">
            <?php echo get_the_time('d'); ?>
        </div>
        <div class="month">
            <?php echo get_the_date('M'); ?>
        </div>
    </div>
</div>