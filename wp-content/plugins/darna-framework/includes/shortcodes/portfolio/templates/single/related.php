<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/20/15
 * Time: 1:58 PM
 */
$args = array(
    'post__not_in' => array($post_id),
    'posts_per_page'   => 4,
    'orderby'			=> 'rand',
    'post_type'        => G5PLUS_PORTFOLIO_POST_TYPE,
    'portfolio_category__in'    => $arrCatId,
    'post_status'      => 'publish'
);
$posts_array = new WP_Query( $args );
?>
<div class="portfolio-related portfolio-wrapper darna-col-md-4">
    <?php
    $index=0;
    $column = 4;
    while ( $posts_array->have_posts() ) : $posts_array->the_post();
        $index++;
        $permalink = get_permalink();
        $title_post = get_the_title();
        $terms = wp_get_post_terms( get_the_ID(), array( G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
        $cat = $cat_filter = '';
        foreach ( $terms as $term ){
            $cat_filter .= preg_replace('/\s+/', '', $term->name) .' ';
            $cat .= $term->name.', ';
        }
        $cat = rtrim($cat,', ');
        $overlay_style = 'title-float';
        ?>
        <?php include(DARNA_PORTFOLIO_DIR_PATH.'/templates/grid-item.php'); ?>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
    <div style="clear: both"></div>
</div>