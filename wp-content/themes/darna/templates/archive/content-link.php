<?php
global $g5plus_archive_loop;
$archive_style = 'classic';
if (isset($g5plus_archive_loop['style']) && !empty($g5plus_archive_loop['style'])) {
    $archive_style  = $g5plus_archive_loop['style'];
}
$prefix = 'g5plus_';

$url = g5plus_get_post_meta(get_the_ID(),$prefix . 'post_format_link_url',true);
$text = g5plus_get_post_meta(get_the_ID(),$prefix . 'post_format_link_text',true);

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="entry-wrap clearfix">
        <div class="entry-content-wrap">
            <div class="entry-content-top-wrap clearfix">
                <div class="entry-post-format-icon">
                    <i class="fa fa-link"></i>
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
            <div class="entry-content-link">
                <?php if (empty($url) || empty($text)) : ?>
                    <?php the_content(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url($url); ?>" rel="bookmark">
                        <?php echo esc_html($text); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>