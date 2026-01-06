<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 */
global $g5plus_archive_loop;

if (isset($g5plus_archive_loop['image-size'])) {
    $size = $g5plus_archive_loop['image-size'];
} else {
    $size = 'full';
}

$post_format = get_post_format();
if (!in_array($post_format,array('gallery'))) {
    $size = 'full';
}

$archive_style = 'classic';
if (isset($g5plus_archive_loop['style']) && !empty($g5plus_archive_loop['style'])) {
    $archive_style  = $g5plus_archive_loop['style'];
}

$class = array();
$class[]= "clearfix";

if (get_post_format() == 'audio') {
	$opt_enable_minifile_css = g5plus_get_option('enable_minifile_css','0');
    $min_suffix = ($opt_enable_minifile_css == 1) ? '.min' :  '';
    wp_enqueue_script( 'g5plus-jplayer-js', THEME_URL . 'assets/plugins/jquery.jPlayer/jquery.jplayer.min.js', array( 'jquery' ), '', true );
    wp_enqueue_style( 'g5plus-jplayer-css', THEME_URL . 'assets/plugins/jquery.jPlayer/skin/g5plus/skin'.$min_suffix.'.css', array(), true );
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="entry-wrap clearfix">
        <?php
        $thumbnail = g5plus_post_thumbnail($size);
        if (!empty($thumbnail)) : ?>
            <div class="entry-thumbnail-wrap">
                <?php echo wp_kses_post($thumbnail); ?>
            </div>
        <?php endif; ?>
        <div class="entry-content-wrap">
            <div class="entry-content-top-wrap clearfix">
                <div class="entry-post-format-icon">
                    <?php
                    $icon_post_format = 'fa fa-file-text-o';
                    switch(get_post_format()) {
                        case 'image' :
                            $icon_post_format = 'fa fa-image';
                            break;
                        case 'gallery':
                            $icon_post_format = 'fa fa-image';
                            break;
                        case 'video':
                            $icon_post_format = 'fa fa-video-camera';
                            break;
                        case 'audio':
                            $icon_post_format = 'fa fa-volume-down';
                            break;
                    } ?>
                    <i class="<?php echo esc_attr($icon_post_format); ?>"></i>
                </div>
                <div class="entry-content-top-right">
                    <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <div class="entry-post-meta-wrap">
                        <?php g5plus_post_meta(); ?>
                    </div>
                </div>
            </div>
            <div class="entry-content clearfix">
                <?php the_content(); ?>
            </div>
            <?php
            /**
             * @hooked - g5plus_link_pages - 5
             * @hooked - g5plus_post_tags - 10
             * @hooked - g5plus_post_nav - 20
             *
             **/
            do_action('g5plus_after_single_post_content');
            ?>
        </div>
    </div>
</article>
