<?php
$opt_social_sharing = g5plus_get_option('social_sharing',array(
	'facebook' => '1',
	'twitter' => '1',
	'linkedin' => '1',
	'tumblr' => '1',
	'pinterest' => '1'
));

$sharing_facebook = isset($opt_social_sharing['facebook']) ? $opt_social_sharing['facebook'] : 0;
$sharing_twitter = isset($opt_social_sharing['twitter']) ? $opt_social_sharing['twitter'] : 0;
$sharing_linkedin = isset($opt_social_sharing['linkedin']) ? $opt_social_sharing['linkedin'] : 0;
$sharing_tumblr = isset($opt_social_sharing['tumblr']) ? $opt_social_sharing['tumblr'] : 0;
$sharing_pinterest = isset($opt_social_sharing['pinterest']) ? $opt_social_sharing['pinterest'] : 0;
if (($sharing_facebook == 1) ||
($sharing_twitter == 1) ||
($sharing_linkedin == 1) ||
($sharing_tumblr == 1) ||
($sharing_pinterest == 1)
) :
?>
    <div class="social-share-wrap">
        <label><?php esc_html_e('Share','g5plus-darna'); ?></label>
        <ul class="social-share">
            <?php if ($sharing_facebook == 1) : ?>
                <li>
                    <a target="_blank"  href="https://www.facebook.com/sharer.php?u= <?php echo esc_attr(urlencode(get_permalink())) ?>"  data-toggle="tooltip"  title="<?php esc_attr_e('Share on Facebook','g5plus-darna');?>">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($sharing_twitter == 1) :  ?>
                <li>
                    <a target="_blank" href="https://twitter.com/share?text=<?php echo esc_attr(urlencode(get_the_title())); ?>&url=<?php echo esc_attr(urlencode(get_permalink())); ?>"  data-toggle="tooltip"  title="<?php esc_attr_e('Share on Twitter','g5plus-darna');?>">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
            <?php endif; ?>


            <?php if ($sharing_linkedin == 1):?>
                <li>
                    <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_attr(urlencode(get_permalink())); ?>&title=<?php echo esc_attr(urlencode(get_the_title())); ?>" data-toggle="tooltip" title="<?php esc_attr_e('Share on Linkedin','g5plus-darna');?>">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </li>
            <?php endif; ?>

            <?php if ($sharing_tumblr == 1) :  ?>
                <li>
                    <a target="_blank" href="http://www.tumblr.com/share/link?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&name=<?php echo esc_attr(urlencode(get_the_title())); ?>" data-toggle="tooltip"  title="<?php esc_attr_e('Share on Tumblr','g5plus-darna');?>">
                    <i class="fa fa-tumblr"></i>
                    </a>
                </li>

            <?php endif; ?>

            <?php if ($sharing_pinterest == 1) :  ?>
                <li>
                    <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo esc_attr(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_attr(urlencode(get_the_title())); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo has_post_thumbnail() ? esc_attr($arrImages[0])  : "" ; ?>" data-toggle="tooltip"  title="<?php esc_attr_e('Share on Pinterest','g5plus-darna');?>">
                    <i class="fa fa-pinterest"></i>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
<?php endif;