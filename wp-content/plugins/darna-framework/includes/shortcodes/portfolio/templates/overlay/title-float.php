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
<figure>
    <img width="<?php echo esc_attr($width) ?>" height="<?php echo esc_attr($height) ?>" src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo get_the_title() ?>"/>
    <figcaption class="<?php if(isset($bg_title_float_style)){ echo esc_attr($bg_title_float_style) ;}?>">
        <div class="fig-title">
            <?php if($show_link_to_detail=='no'){ ?>
                <div class="title secondary-font bold-color primary-color-hover"><?php the_title() ?></div>
            <?php }else{ ?>
                <a href="<?php echo get_permalink(get_the_ID()) ?>"><div class="title secondary-font bold-color primary-color-hover"><?php the_title() ?></div> </a>
            <?php } ?>

            <span class="category menu-font bold-color"><?php echo wp_kses_post($cat) ?></span>
            <?php if($show_link_to_detail!='no'){ ?>
                <a href="<?php echo get_permalink(get_the_ID()) ?>" class="ico-view-detail"><i class="fa fa-eye"></i></a>
            <?php }?>
            <a class="ico-view-gallery prettyPhoto" href="<?php echo esc_url($url_origin) ?>" data-rel="prettyPhoto[pp_gal_<?php echo get_the_ID() ?>]"  title="<?php echo get_the_title() ?>">
                <i class="fa fa-arrows-alt"></i>
            </a>
        </div>
    </figcaption>
</figure>
