<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package remote_startup_solutions
 */

if ( ! function_exists( 'remote_startup_solutions_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function remote_startup_solutions_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$remote_startup_solutions_posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard" itemprop="author"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
    
	echo '<span class="posted-on">' . $remote_startup_solutions_posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function remote_startup_solutions_categorized_blog() {
	if ( false === ( $remote_startup_solutions_all_the_cool_cats = get_transient( 'remote_startup_solutions_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$remote_startup_solutions_all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$remote_startup_solutions_all_the_cool_cats = count( $remote_startup_solutions_all_the_cool_cats );

		set_transient( 'remote_startup_solutions_categories', $remote_startup_solutions_all_the_cool_cats );
	}

	if ( $remote_startup_solutions_all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so remote_startup_solutions_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so remote_startup_solutions_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in remote_startup_solutions_categorized_blog.
 */
function remote_startup_solutions_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'remote_startup_solutions_categories' );
}
add_action( 'edit_category', 'remote_startup_solutions_category_transient_flusher' );
add_action( 'save_post',     'remote_startup_solutions_category_transient_flusher' );


if ( ! function_exists( 'remote_startup_solutions_category_list' ) ) :
/**
 * Prints Categories lists
*/
function remote_startup_solutions_category_list(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$remote_startup_solutions_categories_list = get_the_category_list( esc_html__( ', ', 'remote-startup-solutions' ) );
		if ( $remote_startup_solutions_categories_list && remote_startup_solutions_categorized_blog() ) {
			echo '<span class="category">' . $remote_startup_solutions_categories_list . '</span>';
		}
	}
}
endif;

// Custom meta fields
function remote_startup_solutions_custom_goal_raised() {
  add_meta_box( 'bn_meta', __( 'Kindergartan Meta Feilds', 'remote-startup-solutions' ), 'remote_startup_solutions_meta_goal_raised_callback', 'post', 'normal', 'high' );
}
if (is_admin()){
  add_action('admin_menu', 'remote_startup_solutions_custom_goal_raised');
}

function remote_startup_solutions_meta_goal_raised_callback( $remote_startup_solutions_post ) {
  wp_nonce_field( basename( __FILE__ ), 'remote_startup_solutions_goal_raised_meta' );
  $remote_startup_solutions_bn_stored_meta = get_post_meta( $remote_startup_solutions_post->ID );
  $remote_startup_solutions_age = get_post_meta( $remote_startup_solutions_post->ID, 'remote_startup_solutions_age', true );
  $remote_startup_solutions_size = get_post_meta( $remote_startup_solutions_post->ID, 'remote_startup_solutions_size', true );
  $remote_startup_solutions_price = get_post_meta( $remote_startup_solutions_post->ID, 'remote_startup_solutions_price', true );
  ?>
  <div id="custom_meta_feilds">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-8">
          <td class="left">
            <?php esc_html_e( 'Age', 'remote-startup-solutions' )?>
          </td>
          <td class="left">
            <input type="text" name="remote_startup_solutions_age" id="remote_startup_solutions_age" value="<?php echo esc_attr($remote_startup_solutions_age); ?>" />
          </td>
        </tr>
        <tr id="meta-8">
          <td class="left">
            <?php esc_html_e( 'Size', 'remote-startup-solutions' )?>
          </td>
          <td class="left">
            <input type="text" name="remote_startup_solutions_size" id="remote_startup_solutions_size" value="<?php echo esc_attr($remote_startup_solutions_size); ?>" />
          </td>
        </tr>
        <tr id="meta-8">
          <td class="left">
            <?php esc_html_e( 'Price', 'remote-startup-solutions' )?>
          </td>
          <td class="left">
            <input type="text" name="remote_startup_solutions_price" id="remote_startup_solutions_price" value="<?php echo esc_attr($remote_startup_solutions_price); ?>" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

function remote_startup_solutions_save( $remote_startup_solutions_post_id ) {
  if (!isset($_POST['remote_startup_solutions_goal_raised_meta']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['remote_startup_solutions_goal_raised_meta']) ), basename(__FILE__))) {
      return;
  }

  if (!current_user_can('edit_post', $remote_startup_solutions_post_id)) {
    return;
  }
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

  if( isset( $_POST[ 'remote_startup_solutions_age' ] ) ) {
    update_post_meta( $remote_startup_solutions_post_id, 'remote_startup_solutions_age', strip_tags( wp_unslash( $_POST[ 'remote_startup_solutions_age' ]) ) );
  }
  if( isset( $_POST[ 'remote_startup_solutions_size' ] ) ) {
    update_post_meta( $remote_startup_solutions_post_id, 'remote_startup_solutions_size', strip_tags( wp_unslash( $_POST[ 'remote_startup_solutions_size' ]) ) );
  }
  if( isset( $_POST[ 'remote_startup_solutions_price' ] ) ) {
    update_post_meta( $remote_startup_solutions_post_id, 'remote_startup_solutions_price', strip_tags( wp_unslash( $_POST[ 'remote_startup_solutions_price' ]) ) );
  }
}
add_action( 'save_post', 'remote_startup_solutions_save' );