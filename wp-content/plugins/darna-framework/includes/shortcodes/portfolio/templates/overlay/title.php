<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/20/15
 * Time: 11:01 AM
 */
$cat = '';
foreach ( $terms as $term ){
    $cat .= $term->name.', ';
}
$cat = rtrim($cat,', ');
?>
<div class="entry-thumbnail title">
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <div class="entry-thumbnail-hover">
        <div class="entry-hover-wrapper">
            <div class="entry-hover-inner">
                <a class="view-gallery prettyPhoto" href="<?php echo esc_url($url_origin) ?>" data-rel="prettyPhoto[pp_gal_<?php echo get_the_ID() ?>]"  title="<?php echo get_the_title() ?>">
                    <i class="fa fa-arrows-alt"></i>
                </a>
                <?php if($show_link_to_detail=='no'){ ?>
                    <div class="title secondary-font"><?php the_title() ?></div>
                <?php }else{ ?>
                    <a href="<?php echo get_permalink(get_the_ID()) ?>"><div class="title secondary-font"><?php the_title() ?></div> </a>
                <?php } ?>

                <span class="category menu-font"><?php echo wp_kses_post($cat) ?></span>
            </div>
        </div>
    </div>

</div>