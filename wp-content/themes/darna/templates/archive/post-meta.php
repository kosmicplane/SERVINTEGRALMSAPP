<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/9/2015
 * Time: 8:55 AM
 */
?>
<ul class="entry-meta">
    <li class="entry-meta-author">
        <?php printf('<a href="%1$s"><i class="fa fa-user"></i> %2$s</a>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author())); ?>
    </li>
    <li class="entry-meta-date">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><i class="fa fa-calendar"></i> <?php echo  get_the_date(get_option('date_format'));?> </a>
    </li>
    <?php if (has_category()): ?>
        <li class="entry-meta-category">
            <i class="fa fa-folder-open"></i> <?php echo get_the_category_list(', '); ?>
        </li>
    <?php endif; ?>
    <?php
        if (is_single()) {
	        the_tags('<li class="entry-meta-tags"><i class="fa fa-tags"></i>', ',', '</li>');
        }
    ?>
    <?php if (comments_open() || get_comments_number()) : ?>
        <li class="entry-meta-comment">
            <?php  comments_popup_link(__('<i class="fa fa-comments"></i> 0', 'g5plus-darna'), __('<i class="fa fa-comments"></i> 1', 'g5plus-darna'), __('<i class="fa fa-comments"></i> %', 'g5plus-darna')); ?>
        </li>
    <?php endif; ?>
    <?php edit_post_link( esc_html__( 'Edit', 'g5plus-darna' ), '<li class="edit-link"><i class="fa fa-edit"></i>', '</li>' ); ?>
</ul>
