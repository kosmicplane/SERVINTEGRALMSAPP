<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>

<?php if ( have_comments() ) : ?>
  <div class="comment__wrap pb-45">
      <div class="comment__wrap-title">
          <h5><?php comments_number( esc_html__(' 0 Comments', 'piohost'), esc_html__(' 1 Comment', 'piohost'), esc_html__('% Comments', 'piohost') ); ?></h5>
      </div>
          <?php wp_list_comments('callback=norcon_theme_comment'); ?>
  </div>
<div class="col-md-12"> 
<!-- START PAGINATION -->
<?php
if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
?>
<div class="pagination_area">
     <nav>
          <ul class="pagination">
               <li> <?php paginate_comments_links( 
              array(
              'prev_text' => wp_specialchars_decode(esc_html__( '<i class="fa fa-angle-left"></i>', 'norcon' ),ENT_QUOTES),
              'next_text' => wp_specialchars_decode(esc_html__( '<i class="fa fa-angle-right"></i>', 'norcon' ),ENT_QUOTES),
              ));  ?>
                </li>
          </ul>
     </nav>
</div>                                       
<?php endif; ?>
<!-- END PAGINATION --> 
</div>
<?php endif; ?>     
<?php
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
$aria_req = ( $req ? " aria-required='true'" : '' );
$comment_args = array(
        'id_form' => 'commentform',        
        'class_form' => 'row',                         
        'title_reply'=> wp_specialchars_decode(esc_html__( 'Leave A Comment', 'norcon' ),ENT_QUOTES),
        'fields' => apply_filters( 'comment_form_default_fields', array(
              
            'author' => ' <div class="col-md-6">
                                <input type="text" name="author" id="name" placeholder="'.esc_attr__('Name *', 'norcon').'" required="'.esc_attr__('required', 'norcon').'">
                          </div>',
            'surname' => '<div class="col-md-6">
                              <input type="text" name="surname" id="surname" placeholder="'.esc_attr__('Surname *', 'norcon').'" required="'.esc_attr__('required', 'norcon').'">
                          </div>',

            'email' => '<div class="col-md-12">
                              <input type="email" name="email" id="email" placeholder="'.esc_attr__('Email Address *', 'norcon').'" required="'.esc_attr__('required', 'norcon').'">
                        </div>',
            ) ),   
            'comment_field' => '<div class="col-md-12">
                                    <textarea name="comment" id="message" cols="40" rows="4" placeholder="'.esc_attr__('Your Comment *', 'norcon').'" required="'.esc_attr__('required', 'norcon').'"></textarea>
                                </div>', 
                
         'label_submit' => esc_html__( 'Post A Comment', 'norcon' ),
         'comment_notes_before' => '',
         'comment_notes_after' => '',               
)
?>
<?php if ( comments_open() ) : ?>
    <?php comment_form($comment_args); ?>
<?php endif; ?> 