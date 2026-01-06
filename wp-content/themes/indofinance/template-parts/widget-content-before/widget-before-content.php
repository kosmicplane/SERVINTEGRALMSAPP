<div class="content-before-main-area">
      <div class="widgets-wrapper-top">
  <div class="widget-left md-4">
       <?php if(is_active_sidebar('ad-before-content-left')):
       dynamic_sidebar('ad-before-content-left');
       endif;
       ?>
  </div>
  <div class="widget-center md-4">
  <?php if(is_active_sidebar('ad-before-content-center')):
       dynamic_sidebar('ad-before-content-center');
       endif;
       ?>
  </div>
  <div class="widget-left md-4">
  <?php if(is_active_sidebar('ad-before-content-right')):
       dynamic_sidebar('ad-before-content-right');
       endif;
       ?>
  </div>
  </div>
</div>

<div class="ad-area-after-header-content">
   <?php if(is_active_sidebar('ad-after-header-content')):
              dynamic_sidebar('ad-after-header-content');
              endif;?>         
        </div>
        <?php get_template_part('template-parts/featured-area');?>
        <div class="ad-area-before-content">
                <?php if(is_active_sidebar('ad-before-main-content')):
                dynamic_sidebar('ad-before-main-content');
       endif;?>
</div>