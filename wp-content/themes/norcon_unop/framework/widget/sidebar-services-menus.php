<?php

 class servies_menu_Widget extends WP_Widget

{



  public function __construct()

  {

    parent::__construct(

      'servies_menu-widget',

      'Servies Menu',

      array(

        'description' => 'Servies Menu Widget'

      )

    );

  }



  public function widget( $args, $instance )

  {

    // basic output just for this example

?>

<?php global $id1 ; $id1 = get_page_link()?>

<?php global $title1 ; $title1 = get_the_title() ?>



        

      <div class="sidebar-widget categories">
        <div class="widget-content">
            <!-- Services Category -->
            <ul class="services-categories">
              <li><a href="<?php echo esc_url(home_url('/')); ?>?page_id=46">All Services</a></li>
              <?php 

                      $args = array(    

                        'posts_per_page' => $instance['text123'], 

                        'post_type' => 'services',

                      ); 

                      $wp_query = new \WP_Query($args); 

                      while ($wp_query -> have_posts()): $wp_query -> the_post();

                      $title2 = get_the_title()                 

                      ?> 
                      <?php if ($title1 == $title2) { ?>
                      <li class="active"><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
                      <?php } else { ?>
                      <li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
                      <?php } ?> 
               
               <?php endwhile; ?> 
       </ul>
     </div>
   </div>
      
<?php



  ;}

 

  public function form( $instance )

  {

    // removed the for loop, you can create new instances of the widget instead

    ?>

    

    <p>

      <label for="<?php echo esc_attr($this->get_field_id('text123')); ?>">Number posts want show</label><br />

      <input type="text" name="<?php echo esc_attr($this->get_field_name('text123')); ?>" id="<?php echo esc_attr($this->get_field_id('text123')); ?>" value="<?php echo esc_attr($instance['text123']); ?>" class="widefat" />

    </p>

    

    <?php

  }





} 

// end class



// init the widget

add_action( 'widgets_init', create_function('', 'return register_widget("servies_menu_Widget");') );

