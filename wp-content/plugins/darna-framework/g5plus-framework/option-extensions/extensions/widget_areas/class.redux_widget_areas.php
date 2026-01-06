<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @author      Dovy Paukstys (dovy)
 * @version     3.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'Redux_Widget_Areas' ) ) {

    /**
     * Main ReduxFramework customizer extension class
     *
     * @since       1.0.0
     */
    class Redux_Widget_Areas {

        // Protected vars
        private $extension_url;
        private $extension_dir;
        /**
        * Array of enabled widget_areas
        *
        * @since    1.0.0
        *
        * @var      array
        */
        protected $widget_areas = array();        
        protected $orig = array();        

        /**
        * Class Constructor. Defines the args for the extions class
        *
        * @since       1.0.0
        * @access      public
        * @param       array $sections Panel sections.
        * @param       array $args Class constructor arguments.
        * @param       array $extra_tabs Extra panel tabs.
        * @return      void
        */
        public function __construct( $parent ) {

            $this->parent = $parent;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );

                // Customize: hoantv
                $this->extension_url = apply_filters('redux/_extension_url',$this->extension_url);
            }
            add_action( 'init', array(&$this, 'register_custom_widget_areas') , 1000 );
            add_action( 'wp_loaded', array($this, 'add_widget_area_area'), 100 );
            //add_action( 'load-widgets.php', array( $this, '_enqueue' ), 100 );
			add_action( 'wp_ajax_g5core_delete_widget_area', array( $this, 'redux_delete_widget_area_area' ) );

	        add_action('admin_menu', array($this, 'sidebars_menu'), 20);

        }

	    public function sidebars_menu() {
		    add_theme_page(
			    esc_html__( 'Sidebars Management', 'g5plus-darna' ),
			    esc_html__( 'Sidebars Management', 'g5plus-darna' ),
			    'manage_options',
			    'g5core_sidebars',
			    array($this, 'sidebars_page')
		    );

		    $current_page = isset( $_GET['page'] ) ? $_GET['page'] : '';
		    if ( $current_page == 'g5core_sidebars' ) {
			    add_action( 'admin_init', array( $this, '_enqueue' ) );
		    }

	    }

	    public function sidebars_page() {
		    $index = 0;
		    $sidebars = $this->get_widget_areas();
		    ?>
		    <div class="wrap g5core-sidebars-wrap">
			    <h1><?php echo esc_html__('Sidebars Management','g5plus-darna') ?></h1>
			    <div class="g5core-sidebars-row">
				    <div class="g5core-sidebars-col-left">
					    <div id="g5core-add-widget">
						    <div class="sidebar-name">
							    <h3><?php esc_html_e('Create Widget Area', 'g5plus-darna'); ?></h3>
						    </div>
						    <div class="sidebar-description">
							    <form id="addWidgetAreaForm" action="" method="post">
								    <div class="widget-content">
									    <input id="g5core-add-widget-input" name="g5core-add-widget-input" type="text" class="regular-text" required="required"
									           title="<?php echo esc_attr(esc_html__('Name','g5plus-darna')); ?>"
									           placeholder="<?php echo esc_attr(esc_html__('Name','g5plus-darna')); ?>" />
								    </div>
								    <div class="widget-control-actions">
									    <?php wp_nonce_field('g5core_add_sidebar_action', 'g5core_add_sidebar_nonce') ?>
									    <input class="g5core-sidebar-add-sidebar button button-primary button-hero" type="submit" value="<?php echo esc_attr(esc_html__('Create Widget Area', 'g5plus-darna')); ?>" />
								    </div>
							    </form>
						    </div>
					    </div>
				    </div>
				    <div class="g5core-sidebars-col-right">
					    <table class="wp-list-table widefat fixed striped table-view-list">
						    <thead>
							    <tr>
								    <th style="width: 50px">#</th>
								    <th><?php echo esc_html__('Name','g5plus-darna') ?></th>
								    <th style="width: 100px"></th>
							    </tr>
						    </thead>
						    <tbody>
							    <?php if ($sidebars): ?>
								    <?php foreach ($sidebars as $k => $v): $index++; ?>
									    <tr>
										    <td><?php echo esc_html($index) ?></td>
										    <td><?php echo esc_html($v) ?></td>
										    <td>
											    <button type="button" class="button button-small button-secondary g5core-sidebars-remove-item"
											            data-id="<?php echo esc_attr($k) ?>">
												    <?php echo esc_html__('Remove','g5plus-darna') ?>
											    </button>
										    </td>
									    </tr>
								    <?php endforeach; ?>
							    <?php else: ?>
								    <tr>
									    <td colspan="3">
										    <?php echo esc_html__('No Sidebars defined','g5plus-darna') ?>
									    </td>
								    </tr>
							    <?php endif; ?>
						    </tbody>
					    </table>
				    </div>
			    </div>
		    </div>


		    <?php
	    }

        /**
         * Function to create a new widget_area
         *
         * @since     1.0.0
         *
         * @param    string    Name of the widget_area to be deleted.
         *
         * @return    string     'widget_area-deleted' if successful.
         *
         */
        function add_widget_area_area() {
	        if (!isset($_POST['g5core_add_sidebar_nonce']) || !wp_verify_nonce(sanitize_text_field($_POST['g5core_add_sidebar_nonce']), 'g5core_add_sidebar_action')) {
		        return;
	        }
	        $widget_name = $_POST['g5core-add-widget-input'];
	        if (!empty($widget_name)) {
		        $this->widget_areas = $this->get_widget_areas();

		        $widget_name = $this->check_widget_area_name($widget_name);

		        $widgetId = sanitize_key($widget_name);

		        $this->widget_areas[$widgetId] = $widget_name;

		        $this->save_widget_areas();

		        wp_redirect($_POST['_wp_http_referer']);
		        die();
	        }
        }        


        /**
         * Before we create a new widget_area, verify it doesn't already exist. If it does, append a number to the name.
         *
         * @since     1.0.0
         *
         * @param    string    $name    Name of the widget_area to be created.
         *
         * @return    name     $name      Name of the new widget_area just created.
         *
         */
        function check_widget_area_name($name) {
	        global $wp_registered_sidebars;
	        if(empty($wp_registered_sidebars))
		        return $name;

	        $taken = array();
	        foreach ( $wp_registered_sidebars as $widget_area ) {
		        $taken[] = $widget_area['name'];
	        }

	        $taken = array_merge($taken, $this->widget_areas);

	        if(in_array($name, $taken)) {
		        $counter  = substr($name, -1);
		        if(!is_numeric($counter)) {
			        $new_name = $name . " 1";
		        } else {
			        $new_name = substr($name, 0, -1) . ((int) $counter + 1);
		        }

		        $name = $this->check_widget_area_name($new_name);
	        }
	        return $name;
        }

        function save_widget_areas() {
        	set_theme_mod( 'redux-widget-areas', array_unique( $this->widget_areas ));
        }

        /**
         * Register and display the custom widget_area areas we have set.
         *
         * @since     1.0.0
         *
         */
        function register_custom_widget_areas() {
            // If the single instance hasn't been set, set it now.
            if ( empty($this->widget_areas) ) {
                $this->widget_areas = $this->get_widget_areas();
            }
            $this->orig = array_unique(apply_filters('redux/'.$this->parent->args['opt_name'].'/widget_areas', array()));
			/* deprecated */
            $this->orig = array_unique(apply_filters('redux/widget_areas', $this->orig));

            if ( !empty( $this->orig ) && $this->orig != $this->widget_areas ) {
            	$this->widget_areas = array_unique(array_merge($this->widget_areas, $this->orig));
            	$this->save_widget_areas();
            }

            $options = array(
              'before_title'  => '<h3 class="widgettitle">', 
              'after_title'   => '</h3>',
              'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">', 
              'after_widget'  => '</div>'
            );
              
            $options = apply_filters('redux_custom_widget_args', $options);
                  
            if(is_array($this->widget_areas)) {
                foreach (array_unique($this->widget_areas) as $widget_area) { 
                    $options['class']   = 'redux-custom';
                    $options['name']    = $widget_area;
                    $options['id']      = sanitize_key( $widget_area );
                    register_sidebar($options);
                }
            }
        }


        /**
         * Return the widget_areas array.
         *
         * @since     1.0.0
         *
         * @return    array    If not empty, active redux widget_areas are returned.
         */
        public function get_widget_areas() {

            // If the single instance hasn't been set, set it now.
            if ( !empty($this->widget_areas) ) {
                return $this->widget_areas;
            }

            $db = get_theme_mod('redux-widget-areas');

            if (!empty($db)) {
                $this->widget_areas = array_unique(array_merge($this->widget_areas, $db));
            }

            return $this->widget_areas;

        }

		/**
		 * Before we create a new widget_area, verify it doesn't already exist. If it does, append a number to the name.
		 *
		 * @since     1.0.0
		 *
		 * @param    string    Name of the widget_area to be deleted.
		 *
		 * @return    string     'widget_area-deleted' if successful.
		 *
		 */
		function redux_delete_widget_area_area() {
			if (!check_ajax_referer('g5core-delete-widget-area-action','_wpnonce')) return;
			if(!empty($_REQUEST['name'])) {
				$name = strip_tags( ( stripslashes( $_REQUEST['name'] ) ) );
				$this->widget_areas = $this->get_widget_areas();
				if( array_key_exists($name, $this->widget_areas )) {
					unset($this->widget_areas[$name]);
					$this->save_widget_areas();
				}
				echo "widget-area-deleted";
			}
			die();
		}


        /**
        * Enqueue CSS/JS for the customizer controls
        *
        * @since       1.0.0
        * @access      public
        * @global      $wp_styles
        * @return      void
        */
        function _enqueue(){

	        wp_enqueue_script(
		        'redux-widget_areas-js',
		        $this->extension_url.'assets/js/widget_areas.js',
		        array('jquery'),
		        time(),
		        true
	        );

	        wp_localize_script(
		        'redux-widget_areas-js',
		        'g5core_widget_areas_variable',
		        array(
			        'ajax_url' => wp_nonce_url(admin_url('admin-ajax.php?action=g5core_delete_widget_area'), 'g5core-delete-widget-area-action', '_wpnonce'),
			        'confirm_delete' => esc_html__('Are you sure to delete this widget areas?', 'g5plus-darna')
		        )
	        );


	        wp_enqueue_style('redux-widget_areas-css',$this->extension_url.'assets/css/widget-areas.css' , array(), time(), 'screen');

        	/*wp_enqueue_style( 'dashicons' );

            wp_enqueue_script(
                'redux-widget_areas-js', 
                $this->extension_url.'assets/js/widget_areas.js', 
                array('jquery'),
                time(),
                true
            );      

            wp_enqueue_style(
                'redux-widget_areas-css', 
                $this->extension_url.'assets/css/widget_areas.css', 
                time(),
                true
            );
            $widgets = array();
            if (!empty($this->widget_areas)) {
            	foreach ($this->widget_areas as $widget) {
            		$widgets[$widget] = 1;
            	}
            }
            

            wp_localize_script( 'redux-widget_areas-js', 'redux_widget_areas', array((count($this->orig))) );*/

        }//function   

    } // class

} // if
