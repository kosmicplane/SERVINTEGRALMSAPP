<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_slides
 * @author      Luciano "WebCaos" Ubertini
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( !defined ( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( !class_exists ( 'ReduxFramework_rows' ) ) {

    /**
     * Main ReduxFramework_rows class
     *
     * @since       1.0.0
     */
    class ReduxFramework_rows {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct ( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
            //print '<pre>' . htmlspecialchars( print_r($field , TRUE ) ) . '</pre>';
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render () {
            $defaults = array(
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'url' => true,
                ),
                'content_title' => __ ( 'Rows', 'redux-framework' )
            );

            $this->field = wp_parse_args ( $this->field, $defaults );

            $output_html = '<div class="redux-slides-accordion" data-new-content-title="' . esc_attr ( sprintf ( __ ( 'New %s', 'redux-framework' ), $this->field['content_title'] ) ) . '">';

            $x = 0;

            $multi = ( isset ( $this->field[ 'multi' ] ) && $this->field[ 'multi' ] ) ? ' multiple="multiple"' : "";

            if ( isset ( $this->value ) && is_array ( $this->value ) && !empty ( $this->value ) ) {

                $slides = $this->value;

                foreach ( $slides as $slide ) {
                    if ( empty ( $slide ) ) {
                        continue;
                    }

                    $defaults = array(
                        'title' => '',
                        'description' => '',
                        'sort' => '',
                        'url' => '',
                        'image' => '',
                        'thumb' => '',
                        'attachment_id' => '',
                        'height' => '',
                        'width' => '',
                        'select' => array(),
                    );
                    $slide = wp_parse_args ( $slide, $defaults );

                    if ( empty ( $slide[ 'thumb' ] ) && !empty ( $slide[ 'attachment_id' ] ) ) {
                        $img = wp_get_attachment_image_src ( $slide[ 'attachment_id' ], 'full' );
                        $slide[ 'image' ] = $img[ 0 ];
                        $slide[ 'width' ] = $img[ 1 ];
                        $slide[ 'height' ] = $img[ 2 ];
                    }

                    $output_html .= '<div class="redux-slides-accordion-group"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-slides-header">' . $slide[ 'title' ] . '</span></h3><div><ul class="redux-slides-list">';

                    $hide = '';
                    if ( empty ( $slide[ 'image' ] ) ) {
                        $hide = ' hide';
                    }

                    if ( $this->field[ 'show' ][ 'title' ] ) {
                        $title_type = "text";
                    } else {
                        $title_type = "hidden";
                    }

                    $fields = $this->field['fields'];
                    foreach($fields as $field){
                        $field_type = $field['type'];
                        $placeholder = ( isset ( $field[ 'placeholder' ]) ) ? esc_attr ( $field[ 'placeholder' ]) : __ ( 'Title', 'redux-framework' );
                        switch($field_type){
                            case 'image':{
                                $output_html .= '<li class="field-title">'. $field['title'] .'</li>';
                                $output_html .='<li class="field-input">';
                                $output_html .= '<div class="screenshot' . $hide . '">';
                                $output_html .= '<a class="of-uploaded-image" href="">';
                                $output_html .= '<img class="redux-slides-image" id="image_image_id_' . $x . '" src="' . $slide[ 'thumb' ] . '"  target="_blank" rel="external" />';
                                $output_html .= '</a>';
                                $output_html .= '</div>';

                                //Upload controls DIV
                                $output_html .= '<div class="upload_button_div">';
                                //If the user has WP3.5+ show upload/remove button
                                $output_html .= '<span class="button media_upload_button" id="add_' . $x . '">' .  __ ( 'Upload ', 'redux-framework' ) . $field['title'] . '</span>';

                                $output_html .= '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . $slide[ 'attachment_id' ] . '">' . __ ( 'Remove', 'redux-framework' ) . '</span>';

                                $output_html .= '</div>' . "\n";
                                $output_html .='</li>';

                                if ( $this->field[ 'show' ][ 'url' ] ) {
                                    $url_type = "text";
                                } else {
                                    $url_type = "hidden";
                                }

                                //$output_html .= '<li><input type="' . $url_type . '" id="' . $this->field[ 'id' ] . '-url_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][url]' . $field['name'] .'" value="' . esc_attr ( $slide[ 'url' ] ) . '" class="full-text" placeholder="' . $placeholder . '" /></li>';
                                $output_html .= '<li><input type="hidden" class="slide-sort" name="' . $this->field[ 'name' ] . '[' . $x . '][sort]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-sort_' . $x . '" value="' . $slide[ 'sort' ] . '" />';
                                $output_html .= '<li><input type="hidden" class="upload-id" name="' . $this->field[ 'name' ] . '[' . $x . '][attachment_id]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_id_' . $x . '" value="' . $slide[ 'attachment_id' ] . '" />';
                                $output_html .= '<input type="hidden" class="upload-thumbnail" name="' . $this->field[ 'name' ] . '[' . $x . '][thumb]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-thumb_url_' . $x . '" value="' . $slide[ 'thumb' ] . '" readonly="readonly" />';
                                $output_html .= '<input type="hidden" class="upload" name="' . $this->field[ 'name' ] . '[' . $x . '][image]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_url_' . $x . '" value="' . $slide[ 'image' ] . '" readonly="readonly" />';
                                $output_html .= '<input type="hidden" class="upload-height" name="' . $this->field[ 'name' ] . '[' . $x . '][height]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_height_' . $x . '" value="' . $slide[ 'height' ] . '" />';
                                $output_html .= '<input type="hidden" class="upload-width" name="' . $this->field[ 'name' ] . '[' . $x . '][width]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_width_' . $x . '" value="' . $slide[ 'width' ] . '" /></li>';
                                $output_html .= '<li><a href="javascript:void(0);" class="button deletion redux-slides-remove">' . __ ( 'Delete', 'redux-framework' ) . '</a></li>';

                                break;
                            }
                            case 'text':{
                                $title_block = '';
                                if(array_key_exists('is_title_block',$field) && $field['is_title_block']==1){
                                    $title_block = 'slide-title';
                                }
                                $output_html .= '<li class="field-title">'. $field['title'] .'</li>';
                                $output_html .= '<li class="field-input"><input type="' . $title_type . '" id="' . $this->field[ 'id' ] . '-'. $field['name'].'_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][' . $field['name'] .']" value="' . esc_attr ( $slide[ $field['name'] ] ) . '" placeholder="' . $placeholder . '" class="full-text '. $title_block. '" /></li>';
                                break;
                            }
                            case 'textarea':{
                                $output_html .= '<li class="field-title">'. $field['title'] .'</li>';
                                $output_html .= '<li class="field-input"><textarea name="' . $this->field[ 'name' ] . '[' . $x . '][' . $field['name'] .']" id="' . $this->field[ 'id' ] . '-'.$field['name'].'_' . $x . '" placeholder="' . $placeholder . '" class="large-text" rows="6">' . esc_attr ( $slide[ $field['name'] ] ) . '</textarea></li>';
                                break;
                            }

                            case 'select':{
                                $output_html .= '<li class="field-title">'. $field['title'] .'</li>';
                                $output_html .= '<li class="field-input">';
                                if ( ! empty( $field['options'] ) ) {
                                    $multi = ( isset( $this->field['multi'] ) && $this->field['multi'] ) ? ' multiple="multiple"' : "";
                                    if ( ! empty( $this->field['width'] ) ) {
                                        $width = ' style="' . $this->field['width'] . '"';
                                    } else {
                                        $width = ' style="width: 40%;"';
                                    }
                                    $nameBrackets = "";
                                    if ( ! empty( $multi ) ) {
                                        $nameBrackets = "[]";
                                    }
                                    if ( isset( $this->field['select2'] ) ) { // if there are any let's pass them to js
                                        $select2_params = json_encode( $this->field['select2'] );
                                        $select2_params = htmlspecialchars( $select2_params, ENT_QUOTES );

                                        $output_html.= '<input type="hidden" class="select2_params" value="' . $select2_params . '">';
                                    }

                                    $option_values = $slide[$field['name']];
                                    if ( isset( $this->field['multi'] ) && $this->field['multi'] && isset( $this->field['sortable'] ) && $this->field['sortable'] && ! empty( $this->value ) && is_array( $this->value ) ) {
                                        $origOption             = $this->field['options'];
                                        $field['options'] = array();
                                        foreach ( $option_values as $value ) {
                                            $field['options'][ $value ] = $origOption[ $value ];
                                        }

                                        if ( count( $field['options'] ) < count( $origOption ) ) {
                                            foreach ( $origOption as $key => $value ) {
                                                if ( ! in_array( $key, $field['options'] ) ) {
                                                    $field['options'][ $key ] = $value;
                                                }
                                            }
                                        }
                                    }
                                    $sortable = ( isset( $this->field['sortable'] ) && $this->field['sortable'] ) ? ' select2-sortable"' : "";
                                    $output_html .= '<select ' . $multi . ' id="' . $this->field['id'] . '-'.$field['name'].'_'.$x.'" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] .'['.$x.']['. $field['name'].']' . $nameBrackets . '" class="redux-select-item font-icons ' . $this->field['class'] . $sortable . '"' . $width . ' rows="6">';
                                    $output_html .= '<option></option>';

                                    foreach ( $field['options'] as $k => $v ) {

                                        if (is_array($v)) {
                                            $output_html .= '<optgroup label="' . $k . '">';

                                            foreach($v as $opt => $val) {
                                                $this->make_option($opt, $val, $option_values, $k);
                                            }

                                            $output_html .= '</optgroup>';

                                            continue;
                                        }

                                        $output_html .= $this->make_option($k, $v, $option_values);
                                    }
                                    $output_html .= '</select>';

                                }else{
                                    $output_html .='<strong>' . __( 'No items of this type were found.', 'redux-framework' ) . '</strong>';
                                }
                                $output_html .= '</li>';
                            }
                        }
                    }
                    $output_html .='</ul></div></fieldset></div>';
                    $x ++;
                }
            }

            if ( $x == 0 ) {
                $hide = ' hide';

                if(array_key_exists('fields',$this->field)){
                    $fields = $this->field['fields'];

                    $output_html .= '<div class="redux-slides-accordion-group"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-slides-header">' . esc_attr ( sprintf ( __ ( 'New %s', 'redux-framework' ), $this->field[ 'content_title' ] ) ) . '</span></h3><div>';
                    $output_html .= '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-slides-list">';

                    if ( $this->field[ 'show' ][ 'title' ] ) {
                        $title_type = "text";
                    } else {
                        $title_type = "hidden";
                    }

                    foreach($fields as $field){
                        $field_type = $field['type'];
                        $placeholder = ( isset ( $field[ 'placeholder' ]) ) ? esc_attr ( $field[ 'placeholder' ]) : __ ( 'Title', 'redux-framework' );
                        switch($field_type){
                            case 'image':{
                                $output_html .='<li>';
                                $output_html .= '<div class="screenshot' . $hide . '">';
                                $output_html .= '<a class="of-uploaded-image" href="">';
                                $output_html .= '<img class="redux-slides-image" id="image_image_id_' . $x . '" src=""  target="_blank" rel="external" />';
                                $output_html .= '</a>';
                                $output_html .= '</div>';

                                //Upload controls DIV
                                $output_html .= '<div class="upload_button_div">';
                                //If the user has WP3.5+ show upload/remove button
                                $output_html .= '<span class="button media_upload_button" id="add_' . $x . '">' . __ ( 'Upload ', 'redux-framework' ) . $field['title'] . '</span>';

                                $output_html .= '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . $this->parent->args[ 'opt_name' ] . '[' . $this->field[ 'id' ] . '][attachment_id]">' . __ ( 'Remove', 'redux-framework' ) . '</span>';

                                $output_html .= '</div>' . "\n";
                                $output_html .='</li>';

                                $output_html .= '<li><input type="hidden" class="upload-id" name="' . $this->field[ 'name' ] . '[' . $x . '][attachment_id]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_id_' . $x . '" value="" />';
                                $output_html .= '<input type="hidden" class="upload" name="' . $this->field[ 'name' ] . '[' . $x . '][image]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_url_' . $x . '" value="" readonly="readonly" />';
                                $output_html .= '<input type="hidden" class="upload-height" name="' . $this->field[ 'name' ] . '[' . $x . '][height]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_height_' . $x . '" value="" />';
                                $output_html .= '<input type="hidden" class="upload-width" name="' . $this->field[ 'name' ] . '[' . $x . '][width]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-image_width_' . $x . '" value="" /></li>';
                                $output_html .= '<input type="hidden" class="upload-thumbnail" name="' . $this->field[ 'name' ] . '[' . $x . '][thumb]' . $field['name'] .'" id="' . $this->field[ 'id' ] . '-thumb_url_' . $x . '" value="" /></li>';

                                break;
                            }
                            case 'text':{
                                $title_block = '';
                                if(array_key_exists('is_title_block',$field) && $field['is_title_block']==1){
                                    $title_block = 'slide-title';
                                }
                                $output_html .= '<li><input type="' . $title_type . '" id="' . $this->field[ 'id' ] . '-'. $field['name'].'_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][' . $field['name'] .']" value="" placeholder="' . $placeholder . '" class="full-text '. $title_block. '" /></li>';
                                break;
                            }
                            case 'textarea':{
                                $output_html .= '<li><textarea name="' . $this->field[ 'name' ] . '[' . $x . '][' . $field['name'] .']" id="' . $this->field[ 'id' ] . '-'.$field['name'].'_' . $x . '" placeholder="' . $placeholder . '" class="large-text" rows="6"></textarea></li>';
                                break;
                            }

                            case 'select':{
                                $output_html .= '<li>';
                                if ( ! empty( $field['options'] ) ) {
                                    $multi = ( isset( $this->field['multi'] ) && $this->field['multi'] ) ? ' multiple="multiple"' : "";
                                    if ( ! empty( $this->field['width'] ) ) {
                                        $width = ' style="' . $this->field['width'] . '"';
                                    } else {
                                        $width = ' style="width: 40%;"';
                                    }
                                    $nameBrackets = "";
                                    if ( ! empty( $multi ) ) {
                                        $nameBrackets = "[]";
                                    }
                                    if ( isset( $this->field['select2'] ) ) { // if there are any let's pass them to js
                                        $select2_params = json_encode( $this->field['select2'] );
                                        $select2_params = htmlspecialchars( $select2_params, ENT_QUOTES );

                                        $output_html.= '<input type="hidden" class="select2_params" value="' . $select2_params . '">';
                                    }
                                    if ( isset( $this->field['multi'] ) && $this->field['multi'] && isset( $this->field['sortable'] ) && $this->field['sortable'] && ! empty( $this->value ) && is_array( $this->value ) ) {
                                        $origOption             = $this->field['options'];
                                        $field['options'] = array();

                                        foreach ( $this->value as $value ) {
                                            $field['options'][ $value ] = $origOption[ $value ];
                                        }

                                        if ( count( $field['options'] ) < count( $origOption ) ) {
                                            foreach ( $origOption as $key => $value ) {
                                                if ( ! in_array( $key, $field['options'] ) ) {
                                                    $field['options'][ $key ] = $value;
                                                }
                                            }
                                        }
                                    }
                                    $sortable = ( isset( $this->field['sortable'] ) && $this->field['sortable'] ) ? ' select2-sortable"' : "";
                                    $output_html .= '<select ' . $multi . ' id="' . $this->field['id'] . '-'.$field['name'].'_'.$x.'" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] .'['.$x.']['. $field['name'].']' . $nameBrackets . '" class="redux-select-item font-icons ' . $this->field['class'] . $sortable . '"' . $width . ' rows="6">';
                                    $output_html .= '<option></option>';

                                    foreach ( $field['options'] as $k => $v ) {

                                        if (is_array($v)) {
                                            $output_html .= '<optgroup label="' . $k . '">';

                                            foreach($v as $opt => $val) {
                                                $this->make_option($opt, $val,'', $k);
                                            }

                                            $output_html .= '</optgroup>';

                                            continue;
                                        }

                                        $output_html .= $this->make_option($k, $v);
                                    }
                                    $output_html .= '</select>';

                                }else{
                                    $output_html .='<strong>' . __( 'No items of this type were found.', 'redux-framework' ) . '</strong>';
                                }
                                $output_html .= '</li>';
                            }
                        }
                    }
                }
                $output_html .= '<li><input type="hidden" class="slide-sort" name="' . $this->field[ 'name' ] . '[' . $x . '][sort]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-sort_' . $x . '" value="' . $x . '" />';
                $output_html .= '<li><a href="javascript:void(0);" class="button deletion redux-slides-remove">' . __ ( 'Delete', 'redux-framework' ) . '</a></li>';
                $output_html .= '</ul></div></fieldset></div>';
            }
            $output_html .= '</div><a href="javascript:void(0);" class="button redux-slides-add button-primary" rel-id="' . $this->field[ 'id' ] . '-ul" rel-name="' . $this->field[ 'name' ] . '[title][]' . $this->field['name_suffix'] .'">' . sprintf ( __ ( 'Add %s', 'redux-framework' ), $this->field[ 'content_title' ] ) . '</a><br/>';
            echo $output_html;
        }

        private function make_option($id, $value, $db_value='', $group_name = '') {
            /*if ( is_array( $this->value ) ) {
                $selected = ( is_array( $this->value ) && in_array( $id, $this->value ) ) ? ' selected="selected"' : '';
            } else {
                $selected = selected( $this->value, $id, false );
            }*/
            $selected = '';
            if($id == $db_value)
                $selected = ' selected="selected"' ;
            else
                selected( $this->value, $id, false );


            return '<option value="' . $id . '"' . $selected . '>'. $value . '</option>';
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue () {
            if ( function_exists( 'wp_enqueue_media' ) ) {
                wp_enqueue_media();
            } else {
                wp_enqueue_script( 'media-upload' );
            }
                
            wp_enqueue_style ('redux-field-media-css');


            wp_enqueue_style( 'select2-css' );
            /*wp_enqueue_script(
                'redux-field-rows-select-js',
                ReduxFramework::$_url . 'inc/fields/rows/rows_select.js',
                array( 'jquery', 'select2-js', 'redux-js' ),
                time(),
                true
            );*/


            wp_enqueue_style (
                'redux-field-rows-css',
                ReduxFramework::$_url . 'inc/fields/rows/field_rows.css',
                array(),
                time (),
                'all'
            );

            wp_enqueue_script(
                'redux-field-media-js',
                ReduxFramework::$_url . 'assets/js/media/media' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );

            wp_enqueue_script (
                'redux-field-rows-js',
                ReduxFramework::$_url . 'inc/fields/rows/field_rows.js',
                array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-sortable', 'redux-field-media-js' ),
                time (), 
                true
            );
        }
    }
}