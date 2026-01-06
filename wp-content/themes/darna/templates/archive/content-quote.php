<?php
global $g5plus_archive_loop;


$archive_style = 'classic';
if (isset($g5plus_archive_loop['style']) && !empty($g5plus_archive_loop['style']) ) {
    $archive_style  = $g5plus_archive_loop['style'];
}
$prefix = 'g5plus_';

$quote_content = g5plus_get_post_meta(get_the_ID(),$prefix . 'post_format_quote',true);
$quote_author = g5plus_get_post_meta(get_the_ID(),$prefix . 'post_format_quote_author',true);
$quote_author_url = g5plus_get_post_meta(get_the_ID(),$prefix . 'post_format_quote_author_url',true);

$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
    <div class="entry-wrap clearfix">
        <div class="entry-content-wrap">
            <div class="entry-content-top-wrap clearfix">
                <div class="entry-post-format-icon">
                    <i class="fa fa-quote-left"></i>
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
            <div class="entry-content-quote">
                <?php if (empty($quote_content) || empty($quote_author) || empty($quote_author_url)) : ?>
                    <?php the_content(); ?>
                <?php else : ?>
                    <blockquote>
                        <p><?php echo esc_html($quote_content); ?></p>
                        <cite><a href="<?php echo esc_url($quote_author_url) ?>" title="<?php echo esc_attr($quote_author); ?>"><?php echo esc_html($quote_author); ?></a></cite>
                    </blockquote>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>