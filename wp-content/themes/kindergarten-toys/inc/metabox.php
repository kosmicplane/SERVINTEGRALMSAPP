<?php
/**
* Sidebar Metabox.
*
* @package Kindergarten Toys
*/

$kindergarten_toys_post_sidebar_fields = array(
    'global-sidebar' => array(
        'id'        => 'post-global-sidebar',
        'value' => 'global-sidebar',
        'label' => esc_html__( 'Global sidebar', 'kindergarten-toys' ),
    ),
    'right-sidebar' => array(
        'id'        => 'post-left-sidebar',
        'value' => 'right-sidebar',
        'label' => esc_html__( 'Right sidebar', 'kindergarten-toys' ),
    ),
    'left-sidebar' => array(
        'id'        => 'post-right-sidebar',
        'value'     => 'left-sidebar',
        'label'     => esc_html__( 'Left sidebar', 'kindergarten-toys' ),
    ),
    'no-sidebar' => array(
        'id'        => 'post-no-sidebar',
        'value'     => 'no-sidebar',
        'label'     => esc_html__( 'No sidebar', 'kindergarten-toys' ),
    ),
);

function kindergarten_toys_category_add_form_fields_callback() {
    $kindergarten_toys_image_id = null; ?>
    <div id="category_custom_image"></div>
    <input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
    <div style="margin-bottom: 20px;">
        <span><?php esc_html_e('Category Image','kindergarten-toys'); ?></span>
        <a href="#" class="button custom-button-upload" id="custom-button-upload"><?php esc_html_e('Upload Image','kindergarten-toys'); ?></a>
        <a href="#" class="button custom-button-remove" id="custom-button-remove" style="display: none"><?php esc_html_e('Remove Image','kindergarten-toys'); ?></a>
    </div>
    <?php 
}
add_action( 'category_add_form_fields', 'kindergarten_toys_category_add_form_fields_callback' );

function kindergarten_toys_custom_create_term_callback($kindergarten_toys_term_id) {
    // add term meta data
    add_term_meta(
        $kindergarten_toys_term_id,
        'term_image',
        esc_url($_REQUEST['category_custom_image_url'])
    );
}
add_action( 'create_term', 'kindergarten_toys_custom_create_term_callback' );

function kindergarten_toys_category_edit_form_fields_callback($ttObj, $taxonomy) {
    $kindergarten_toys_term_id = $ttObj->term_id;
    $kindergarten_toys_image = '';
    $kindergarten_toys_image = get_term_meta( $kindergarten_toys_term_id, 'term_image', true ); ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="image"><?php esc_html_e('Image','kindergarten-toys'); ?></label></th>
        <td>
        <?php if ( $kindergarten_toys_image ): ?>
            <span id="category_custom_image">
               <img src="<?php echo $kindergarten_toys_image; ?>" style="width: 100%"/>
            </span>
            <input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
            <span>
                <a href="#" class="button custom-button-upload" id="custom-button-upload" style="display: none"><?php esc_html_e('Upload Image','kindergarten-toys'); ?></a>
                <a href="#" class="button custom-button-remove"><?php esc_html_e('Remove Image','kindergarten-toys'); ?></a>                    
            </span>
        <?php else: ?>
            <span id="category_custom_image"></span>
            <input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
            <span>
               <a href="#" class="button custom-button-upload" id="custom-button-upload"><?php esc_html_e('Upload Image','kindergarten-toys'); ?></a>
               <a href="#" class="button custom-button-remove" style="display: none"><?php esc_html_e('Remove Image','kindergarten-toys'); ?></a>
            </span>
            <?php endif; ?>
        </td>
    </tr>
    <?php
}
add_action ( 'category_edit_form_fields', 'kindergarten_toys_category_edit_form_fields_callback', 10, 2 );

function kindergarten_toys_edit_term_callback($kindergarten_toys_term_id) {
    // Check if 'category_custom_image_url' is set in the $_POST array
    if ( isset( $_POST['category_custom_image_url'] ) ) {
        $kindergarten_toys_image = get_term_meta( $kindergarten_toys_term_id, 'term_image' );

        // Sanitize and update or add the meta data
        if ( $kindergarten_toys_image ) {
            update_term_meta( 
                $kindergarten_toys_term_id, 
                'term_image', 
                esc_url( $_POST['category_custom_image_url'] )
            );
        } else {
            add_term_meta( 
                $kindergarten_toys_term_id, 
                'term_image', 
                esc_url( $_POST['category_custom_image_url'] )
            );
        }
    }
}
add_action( 'edit_term', 'kindergarten_toys_edit_term_callback' );