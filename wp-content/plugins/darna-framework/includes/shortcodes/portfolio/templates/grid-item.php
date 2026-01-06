<div class="portfolio-item <?php echo esc_attr($cat_filter) ?>">

    <?php
        $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
        $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
        $width = 480;
        $height = 480;
        $thumbnail_url = '';
        if (function_exists('matthewruddy_image_resize_id')) {
	        $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id,$width,$height);
        }
        $url_origin = $arrImages[0];
        $show_link_to_detail = '';
        include(plugin_dir_path( __FILE__ ).'/overlay/'.$overlay_style.'.php');
    ?>

    <div style="display: none">
        <?php
        $meta_values = get_post_meta( get_the_ID(), 'portfolio-format-gallery', false );
        if(count($meta_values) > 0){
            foreach($meta_values as $image){
                $urls = wp_get_attachment_image_src($image,'full');
                $gallery_img = '';
                if(count($urls)>0)
                    $gallery_img = $urls[0];
                ?>
                <div>
                    <a href="<?php echo esc_url($gallery_img) ?>"  data-rel="prettyPhoto[pp_gal_<?php echo get_the_ID()?>]" title="<?php echo "<a href='".$permalink."'>".$title_post."</a>"?>"></a>
                </div>
            <?php        }
        }
        ?>
    </div>

</div>
