<?php
function xmenu_get_transition() {
	return array(
		'none' => esc_html__('None','g5plus-darna'),
		'x-animate-slide-up' => esc_html__('Slide Up','g5plus-darna'),
		'x-animate-slide-down' => esc_html__('Slide Down','g5plus-darna'),
		'x-animate-slide-left' => esc_html__('Slide Left','g5plus-darna'),
		'x-animate-slide-right' => esc_html__('Slide Right','g5plus-darna'),
		'x-animate-sign-flip' => esc_html__('Sign Flip','g5plus-darna'),
	);
}

function xmenu_get_grid () {
	return array(
		'basic' => array(
			'text' => esc_html__('Basic','g5plus-darna'),
			'options' => array(
				'auto' => esc_html__('Automatic','g5plus-darna'),
				'x-col x-col-12-12' => esc_html__('Full Width','g5plus-darna'),
			)
		),
		'halves' => array(
			'text' => esc_html__('Halves','g5plus-darna'),
			'options' => array(
				'x-col x-col-6-12' => esc_html__('1/2','g5plus-darna'),
			)
		),
		'thirds' => array(
			'text' => esc_html__('Thirds','g5plus-darna'),
			'options' => array(
				'x-col x-col-4-12' => esc_html__('1/3','g5plus-darna'),
				'x-col x-col-8-12' => esc_html__('2/3','g5plus-darna'),
			)
		),
		'quarters' => array(
			'text' => esc_html__('Quarters','g5plus-darna'),
			'options' => array(
				'x-col x-col-3-12' => esc_html__('1/4','g5plus-darna'),
				'x-col x-col-9-12' => esc_html__('3/4','g5plus-darna'),
			)
		),
		'fifths' => array(
			'text' => esc_html__('Fifths','g5plus-darna'),
			'options' => array(
				'x-col x-col-2-10' => esc_html__('1/5','g5plus-darna'),
				'x-col x-col-4-10' => esc_html__('2/5','g5plus-darna'),
				'x-col x-col-6-10' => esc_html__('3/5','g5plus-darna'),
				'x-col x-col-8-10' => esc_html__('4/5','g5plus-darna'),
			)
		),
		'sixths' => array(
			'text' => esc_html__('Sixths','g5plus-darna'),
			'options' => array(
				'x-col x-col-2-12' => esc_html__('1/6','g5plus-darna'),
				'x-col x-col-10-12' => esc_html__('5/6','g5plus-darna'),
			)
		),
		'sevenths' => array(
			'text' => esc_html__('Sevenths','g5plus-darna'),
			'options' => array(
				'x-col x-col-1-7' => esc_html__('1/7','g5plus-darna'),
				'x-col x-col-2-7' => esc_html__('2/7','g5plus-darna'),
				'x-col x-col-3-7' => esc_html__('3/7','g5plus-darna'),
				'x-col x-col-4-7' => esc_html__('4/7','g5plus-darna'),
				'x-col x-col-5-7' => esc_html__('5/7','g5plus-darna'),
				'x-col x-col-6-7' => esc_html__('6/7','g5plus-darna'),
			)
		),
		'eighths' => array(
			'text' => esc_html__('Eighths','g5plus-darna'),
			'options' => array(
				'x-col x-col-1-8' => esc_html__('1/8','g5plus-darna'),
				'x-col x-col-3-8' => esc_html__('3/8','g5plus-darna'),
				'x-col x-col-5-8' => esc_html__('5/8','g5plus-darna'),
				'x-col x-col-7-8' => esc_html__('7/8','g5plus-darna'),
			)
		),
		'ninths' => array(
			'text' => esc_html__('Ninths','g5plus-darna'),
			'options' => array(
				'x-col x-col-1-9' => esc_html__('1/9','g5plus-darna'),
				'x-col x-col-2-9' => esc_html__('2/9','g5plus-darna'),
				'x-col x-col-4-9' => esc_html__('4/9','g5plus-darna'),
				'x-col x-col-5-9' => esc_html__('5/9','g5plus-darna'),
				'x-col x-col-7-9' => esc_html__('7/9','g5plus-darna'),
				'x-col x-col-8-9' => esc_html__('8/9','g5plus-darna'),
			)
		),
		'tenths' => array(
			'text' => esc_html__('Tenths','g5plus-darna'),
			'options' => array(
				'x-col x-col-1-10' => esc_html__('1/10','g5plus-darna'),
				'x-col x-col-3-10' => esc_html__('3/10','g5plus-darna'),
				'x-col x-col-7-10' => esc_html__('7/10','g5plus-darna'),
				'x-col x-col-9-10' => esc_html__('9/10','g5plus-darna'),
			)
		),
		'elevenths' => array(
			'text' => esc_html__('Elevenths','g5plus-darna'),
			'options' => array(
				'x-col x-col-1-11' => esc_html__('1/11','g5plus-darna'),
				'x-col x-col-2-11' => esc_html__('2/11','g5plus-darna'),
				'x-col x-col-3-11' => esc_html__('3/11','g5plus-darna'),
				'x-col x-col-4-11' => esc_html__('4/11','g5plus-darna'),
				'x-col x-col-5-11' => esc_html__('5/11','g5plus-darna'),
				'x-col x-col-6-11' => esc_html__('6/11','g5plus-darna'),
				'x-col x-col-7-11' => esc_html__('7/11','g5plus-darna'),
				'x-col x-col-8-11' => esc_html__('8/11','g5plus-darna'),
				'x-col x-col-9-11' => esc_html__('9/11','g5plus-darna'),
				'x-col x-col-10-11' => esc_html__('10/11','g5plus-darna'),
			)
		),
		'twelfths' => array(
			'text' => esc_html__('Twelfths','g5plus-darna'),
			'options' => array(
				'x-col x-col-1-12' => esc_html__('1/12','g5plus-darna'),
				'x-col x-col-5-12' => esc_html__('5/12','g5plus-darna'),
				'x-col x-col-7-12' => esc_html__('7/12','g5plus-darna'),
				'x-col x-col-11-12' => esc_html__('11/12','g5plus-darna'),
			)
		),
	);
}


global $xmenu_item_settings;
$xmenu_item_settings = array(
	'general' => array(
		'text' => esc_html__('General','g5plus-darna'),
		'icon' => 'fa fa-cogs',
		'config' => array(
			'general-heading' => array(
				'text' => esc_html__('General','g5plus-darna'),
				'type' => 'heading'
			),
			'general-url' => array(
				'text' => esc_html__('URL','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
			),
			'general-title' => array(
				'text' => esc_html__('Navigation Label','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
			),
			'general-attr-title' => array(
				'text' => esc_html__('Title Attribute','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
			),
			'general-target' => array(
				'text' => esc_html__('Open link in a new window/tab','g5plus-darna'),
				'type' => 'checkbox',
				'std'  => '',
				'value' => '_blank',
			),
			'general-classes' => array(
				'text' => esc_html__('CSS Classes (optional)','g5plus-darna'),
				'type' => 'array',
				'std'  => '',
			),
			'general-xfn' => array(
				'text' => esc_html__('Link Relationship (XFN)','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
			),
			'general-description' => array(
				'text' => esc_html__('Description','g5plus-darna'),
				'type' => 'textarea',
				'std'  => '',
			),
			'general-other-heading' => array(
				'text' => esc_html__('Other','g5plus-darna'),
				'type' => 'heading'
			),
			'other-disable-text' => array(
				'text' => esc_html__('Disable Text','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-disable-menu-item' => array(
				'text' => esc_html__('Disable Menu Item','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-disable-link' => array(
				'text' => esc_html__('Disable Link','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-display-header-column' => array(
				'text' => esc_html__('Display as a Sub Menu column header','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'other-feature-text' => array(
				'text' => esc_html__('Menu Feature Text','g5plus-darna'),
				'type' => 'text',
				'std' => ''
			),
		)
	),
	'icon' => array(
		'text' => esc_html__('Icon','g5plus-darna'),
		'icon' => 'fa fa-qrcode',
		'config' => array(
			'icon-heading' => array(
				'text' => esc_html__('Icon','g5plus-darna'),
				'type' => 'heading'
			),
			'icon-value' => array(
				'text' => esc_html__('Set Icon','g5plus-darna'),
				'type' => 'icon',
				'std'  => '',
			),
			'icon-position' => array(
				'text' => esc_html__('Icon Position','g5plus-darna'),
				'type' => 'select',
				'std'  => 'left',
				'options' => array(
					'left' => esc_html__('Left of Menu Text','g5plus-darna'),
					'right' => esc_html__('Right of Menu Text','g5plus-darna'),
				)
			),
			'icon-padding' => array(
				'text' => esc_html__('Padding Icon and Text Menu','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Padding between Icon and Text Menu (px). Do not include units','g5plus-darna')
			)
		)
	),
	'image' => array(
		'text' => esc_html__('Image','g5plus-darna'),
		'icon' => 'fa fa-picture-o',
		'config' => array(
			'image-heading' => array(
				'text' => esc_html__('Image','g5plus-darna'),
				'type' => 'heading'
			),
			'image-url' => array(
				'text' => esc_html__('Image Url','g5plus-darna'),
				'type' => 'image',
				'std'  => '',
			),
			'image-size' => array(
				'text' => esc_html__('Image Size','g5plus-darna'),
				'type' => 'select',
				'std'  => 'inherit',
				'options' => xmenu_get_image_size()
			),
			'image-dimensions' => array(
				'text' => esc_html__('Image Dimensions','g5plus-darna'),
				'type' => 'select',
				'std'  => 'inherit',
				'options' => array(
					'inherit' => 'Inherit from Menu Settings',
					'custom' => 'Custom',
				)
			),
			'image-width' => array(
				'text' => esc_html__('Image Width','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Image width attribute (px). Do not include units. Only valid if "Image Dimension" is set to "Custom" above','g5plus-darna')
			),
			'image-height' => array(
				'text' => esc_html__('Image Height','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Image width attribute (px). Do not include units. Only valid if "Image Dimension" is set to "Custom" above','g5plus-darna')
			),
			'image-layout' => array(
				'text' => esc_html__('Image Layout','g5plus-darna'),
				'type' => 'select',
				'std'  => 'image-only',
				'options' => array(
					'image-only' => esc_html__('Image Only','g5plus-darna'),
					'left' => esc_html__('Image Left','g5plus-darna'),
					'right' => esc_html__('Image Right','g5plus-darna'),
					'above' => esc_html__('Image Above','g5plus-darna'),
					'below' => esc_html__('Image Below','g5plus-darna'),
				)
			),
			'image-feature' => array(
				'text' => esc_html__('Use Feature Image','g5plus-darna'),
				'type' => 'checkbox',
				'std'  => '',
				'des' => 'Use Feature Image from Post/Page Menu Item',
			),
		)
	),

	'layout' => array(
		'text' => esc_html__('Layout','g5plus-darna'),
		'icon' => 'fa fa-columns',
		'config' => array(
			'layout-heading' => array(
				'text' => esc_html__('Layout','g5plus-darna'),
				'type' => 'heading'
			),
			'layout-width' => array(
				'text' => esc_html__('Menu Item Width','g5plus-darna'),
				'type' => 'select-group',
				'std'  => 'auto',
				'options' => xmenu_get_grid()
			),
			'layout-text-align' => array(
				'text' => esc_html__('Item Content Alignment','g5plus-darna'),
				'type' => 'select',
				'std'  => 'none',
				'options' => array(
					'none' => esc_html__('Default','g5plus-darna'),
					'left' => esc_html__('Text Left','g5plus-darna'),
					'center' => esc_html__('Text Center','g5plus-darna'),
					'right' => esc_html__('Text Right','g5plus-darna'),
				)
			),
			'layout-padding' => array(
				'text' => esc_html__('Padding','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set padding for menu item. Include the units.','g5plus-darna'),
			),
			'layout-margin' => array(
				'text' => esc_html__('Margin','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set margin for menu item. Include the units.','g5plus-darna'),
			),
			'layout-new-row' => array(
				'text' => esc_html__('New Row','g5plus-darna'),
				'type' => 'checkbox',
				'std'  => ''
			),
		)
	),
	'submenu' => array(
		'text' => esc_html__('Sub Menu','g5plus-darna'),
		'icon' => 'fa fa-list-alt',
		'config' => array(
			'submenu-heading' => array(
				'text' => esc_html__('Sub Menu','g5plus-darna'),
				'type' => 'heading'
			),
			'submenu-type' => array(
				'text' => esc_html__('Sub Menu Type','g5plus-darna'),
				'type' => 'select',
				'std'  => 'standard',
				'options' => array(
					'standard' => esc_html__('Standard','g5plus-darna'),
					'multi-column' => esc_html__('Multi Column','g5plus-darna'),
					/*'stack' => esc_html__('Stack','g5plus-darna'),*/
					'tab' => esc_html__('Tab','g5plus-darna'),
				)
			),
			'submenu-position' => array(
				'text' => esc_html__('Sub Menu Position','g5plus-darna'),
				'type' => 'select',
				'std'  => '',
				'options' => array(
					'' => esc_html__('Automatic','g5plus-darna'),
					'pos-left-menu-parent' => esc_html__('Left of Menu Parent','g5plus-darna'),
					'pos-right-menu-parent' => esc_html__('Right of Menu Parent','g5plus-darna'),
					'pos-center-menu-parent' => esc_html__('Center of Menu Parent','g5plus-darna'),
					'pos-left-menu-bar' => esc_html__('Left of Menu Bar','g5plus-darna'),
					'pos-right-menu-bar' => esc_html__('Right of Menu Bar','g5plus-darna'),
					'pos-full' => esc_html__('Full Size','g5plus-darna'),
				)
			),
			'submenu-width-custom' => array(
				'text' => esc_html__('Sub Menu Width Custom','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set custom Sub Menu Width. Include the units (px/em/%).','g5plus-darna'),
			),
			'submenu-col-width-default' => array(
				'text' => esc_html__('Sub Menu Column Width Default','g5plus-darna'),
				'type' => 'select-group',
				'std'  => 'auto',
				'options' => xmenu_get_grid()
			),
			'submenu-col-spacing-default' => array(
				'text' => esc_html__('Sub Menu Column Spacing Default','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set sub menu column spacing default. Do not include unit.','g5plus-darna'),
			),
			'submenu-list-style' => array(
				'text' => esc_html__('Sub Menu List Style','g5plus-darna'),
				'type' => 'select',
				'std'  => 'none',
				'options' => array(
					'none' => esc_html__('None','g5plus-darna'),
					'disc' => esc_html__('Disc','g5plus-darna'),
					'square' => esc_html__('Square','g5plus-darna'),
					'circle' => esc_html__('Circle','g5plus-darna'),
				)
			),
			'submenu-tab-position' => array(
				'text' => esc_html__('Tab Position','g5plus-darna'),
				'type' => 'select',
				'std'  => 'left',
				'des' => esc_html__('Tab Position set to "Sub Menu Type" is "TAB".','g5plus-darna'),
				'options' => array(
					'left' => esc_html__('Left','g5plus-darna'),
					'right' => esc_html__('Right','g5plus-darna'),
				)
			),
			'submenu-animation' => array(
				'text' => esc_html__('Sub Menu Animation','g5plus-darna'),
				'type' => 'select',
				'std'  => 'x-animate-sign-flip',
				'options' => xmenu_get_transition()
			),
		)
	),
	'custom-content' => array(
		'text' => esc_html__('Custom Content','g5plus-darna'),
		'icon' => 'fa fa-code',
		'config' => array(
			'custom-content-heading' => array(
				'text' => esc_html__('Custom Content','g5plus-darna'),
				'type' => 'heading'
			),
			'custom-content-value' => array(
				'text' => esc_html__('Custom Content','g5plus-darna'),
				'type' => 'textarea',
				'std'  => '',
				'des' => esc_html__('Can contain HTML and shortcodes','g5plus-darna'),
				'height' => '300px'
			),
		)
	),
	'widget' => array(
		'text' => esc_html__('Widget Area','g5plus-darna'),
		'icon' => 'fa-puzzle-piece',
		'config' => array(
			'widget-heading' => array(
				'text' => esc_html__('Widget Area','g5plus-darna'),
				'type' => 'heading'
			),
			'widget-area' => array(
				'text' => esc_html__('Widget Area','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Enter a name for your Widget Area, and a widget area specifically for this menu item will be automatically be created in the <a href="widgets.php" target="_blank">Widgets Screen</a>','g5plus-darna'),
			),
		)
	),
	'customize-style' => array(
		'text' => esc_html__('Customize Style','g5plus-darna'),
		'icon' => 'fa-paint-brush',
		'config' => array(
			'custom-style-menu-heading' => array(
				'text' => esc_html__('Menu Item','g5plus-darna'),
				'type' => 'heading'
			),
			'custom-style-menu-bg-color' => array(
				'text' => esc_html__('Background Color','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-text-color' => array(
				'text' => esc_html__('Text Color','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-bg-color-active' => array(
				'text' => esc_html__('Background Color [Active]','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-text-color-active' => array(
				'text' => esc_html__('Text Color [Active]','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-menu-bg-image' => array(
				'text' => esc_html__('Background Image','g5plus-darna'),
				'type' => 'image',
				'std'  => '',
			),
			'custom-style-menu-bg-image-repeat' => array(
				'text' => esc_html__('Background Image Repeat','g5plus-darna'),
				'type' => 'select',
				'std' => 'no-repeat',
				'hide-label' => 'true',
				'options' => array(
					'no-repeat' => 'no-repeat',
					'repeat' => 'repeat',
					'repeat-x' => 'repeat-x',
					'repeat-y' => 'repeat-y'
				)
			),
			'custom-style-menu-bg-image-attachment' => array(
				'text' => esc_html__('Background Image Attachment','g5plus-darna'),
				'type' => 'select',
				'std' => 'scroll',
				'hide-label' => 'true',
				'options' => array(
					'scroll' => 'scroll',
					'fixed' => 'fixed'
				)
			),
			'custom-style-menu-bg-image-position' => array(
				'text' => esc_html__('Background Image Position','g5plus-darna'),
				'type' => 'select',
				'std' => 'center',
				'hide-label' => 'true',
				'options' => array(
					'center' => 'center',
					'center left' => 'center left',
					'center right' => 'center right',
					'top left' => 'top left',
					'top center' => 'top center',
					'top right' => 'top right',
					'bottom left' => 'bottom left',
					'bottom center' => 'bottom center',
					'bottom right' => 'bottom right'
				)
			),
			'custom-style-menu-bg-image-size' => array(
				'text' => esc_html__('Background Image Size','g5plus-darna'),
				'type' => 'select',
				'std' => 'auto',
				'hide-label' => 'true',
				'options' => array(
					'auto' => 'Keep original',
					'100% auto' => 'Stretch to width',
					'auto 100%' => 'Stretch to height',
					'cover' => 'Cover',
					'contain' => 'Contain'
				)
			),
			'custom-style-sub-menu-heading' => array(
				'text' => esc_html__('Sub Menu','g5plus-darna'),
				'type' => 'heading'
			),
			'custom-style-sub-menu-bg-color' => array(
				'text' => esc_html__('Background Color','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-sub-menu-text-color' => array(
				'text' => esc_html__('Text Color','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-sub-menu-bg-image' => array(
				'text' => esc_html__('Background Image','g5plus-darna'),
				'type' => 'image',
				'std'  => '',
			),
			'custom-style-sub-menu-bg-image-repeat' => array(
				'text' => esc_html__('Background Image Repeat','g5plus-darna'),
				'type' => 'select',
				'std' => 'no-repeat',
				'hide-label' => 'true',
				'options' => array(
					'no-repeat' => 'no-repeat',
					'repeat' => 'repeat',
					'repeat-x' => 'repeat-x',
					'repeat-y' => 'repeat-y'
				)
			),
			'custom-style-sub-menu-bg-image-attachment' => array(
				'text' => esc_html__('Background Image Attachment','g5plus-darna'),
				'type' => 'select',
				'std' => 'scroll',
				'hide-label' => 'true',
				'options' => array(
					'scroll' => 'scroll',
					'fixed' => 'fixed'
				)
			),
			'custom-style-sub-menu-bg-image-position' => array(
				'text' => esc_html__('Background Image Position','g5plus-darna'),
				'type' => 'select',
				'std' => 'center',
				'hide-label' => 'true',
				'options' => array(
					'center' => 'center',
					'center left' => 'center left',
					'center right' => 'center right',
					'top left' => 'top left',
					'top center' => 'top center',
					'top right' => 'top right',
					'bottom left' => 'bottom left',
					'bottom center' => 'bottom center',
					'bottom right' => 'bottom right'
				)
			),
			'custom-style-sub-menu-bg-image-size' => array(
				'text' => esc_html__('Background Image Size','g5plus-darna'),
				'type' => 'select',
				'std' => 'auto',
				'hide-label' => 'true',
				'options' => array(
					'auto' => 'Keep original',
					'100% auto' => 'Stretch to width',
					'auto 100%' => 'Stretch to height',
					'cover' => 'Cover',
					'contain' => 'Contain'
				)
			),
			'custom-style-col-min-width' => array(
				'text' => esc_html__('Column Min Width','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set min-width for Sub Menu Column (px). Not include the units.','g5plus-darna'),
			),
			'custom-style-padding' => array(
				'text' => esc_html__('Padding','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des' => esc_html__('Set padding for Sub Menu. Include the units.','g5plus-darna'),
			),

			'custom-style-feature-menu-text-heading' => array(
				'text' => esc_html__('Menu Feature Text','g5plus-darna'),
				'type' => 'heading'
			),
			'custom-style-feature-menu-text-type' => array(
				'text' => esc_html__('Feature Menu Type','g5plus-darna'),
				'type' => 'select',
				'std'  => '',
				'options' => array(
					'' => esc_html__('Standard','g5plus-darna'),
					'x-feature-menu-not-float' => esc_html__('Not Float','g5plus-darna')
				)
			),
			'custom-style-feature-menu-text-bg-color' => array(
				'text' => esc_html__('Background Color','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-feature-menu-text-color' => array(
				'text' => esc_html__('Text Color','g5plus-darna'),
				'type' => 'color',
				'std'  => '',
			),
			'custom-style-feature-menu-text-top' => array(
				'text' => esc_html__('Position Top','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des'  => 'Position Top (px) Feature Menu Text. Do not include units.',
			),
			'custom-style-feature-menu-text-left' => array(
				'text' => esc_html__('Position Left','g5plus-darna'),
				'type' => 'text',
				'std'  => '',
				'des'  => 'Position Left (px) Feature Menu Text. Do not include units.',
			),
		)
	),
	'responsive' => array(
		'text' => esc_html__('Responsive','g5plus-darna'),
		'icon' => 'fa-desktop',
		'config' => array(
			'responsive-heading' => array(
				'text' => esc_html__('Responsive','g5plus-darna'),
				'type' => 'heading'
			),
			'responsive-hide-mobile-css' => array(
				'text' => esc_html__('Hide item on mobile via CSS','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-desktop-css' => array(
				'text' => esc_html__('Hide item on desktop via CSS','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-mobile-css-submenu' => array(
				'text' => esc_html__('Hide sub menu on mobile via CSS','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-mobile' => array(
				'text' => esc_html__('Remove this item when mobile device is detected via wp_is_mobile()','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-desktop' => array(
				'text' => esc_html__('Remove this item when desktop device is NOT detected via wp_is_mobile()','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-mobile-submenu' => array(
				'text' => esc_html__('Remove sub menu when desktop device is NOT detected via wp_is_mobile()','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
		),
	),
	'responsive' => array(
		'text' => esc_html__('Responsive','g5plus-darna'),
		'icon' => 'fa-desktop',
		'config' => array(
			'responsive-heading' => array(
				'text' => esc_html__('Responsive','g5plus-darna'),
				'type' => 'heading'
			),
			'responsive-hide-mobile-css' => array(
				'text' => esc_html__('Hide item on mobile via CSS','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-desktop-css' => array(
				'text' => esc_html__('Hide item on desktop via CSS','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-mobile-css-submenu' => array(
				'text' => esc_html__('Hide sub menu on mobile via CSS','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-hide-desktop-css-submenu' => array(
				'text' => esc_html__('Hide sub menu on desktop via CSS','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			/*'responsive-remove-mobile' => array(
				'text' => esc_html__('Remove this item when mobile device is detected via wp_is_mobile()','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-desktop' => array(
				'text' => esc_html__('Remove this item when desktop device is NOT detected via wp_is_mobile()','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),
			'responsive-remove-mobile-submenu' => array(
				'text' => esc_html__('Remove sub menu when desktop device is NOT detected via wp_is_mobile()','g5plus-darna'),
				'type' => 'checkbox',
				'std' => ''
			),*/
		),
	)
);

global $xmenu_item_defaults;
$xmenu_item_defaults = xmenu_get_item_defaults($xmenu_item_settings);

function xmenu_get_item_defaults($items_setting, $defaults = array()) {
	if (!$defaults) {
		$defaults = array(
			'nosave-type_label' => '',
			'nosave-type' => '',
			'nosave-change' => 0
		);
	}

	foreach ($items_setting as $seting_key => $setting) {
		foreach ($setting['config'] as $key => $value) {
			if (isset($value['config']) && $value['config']) {

			}
			else {
				if ($value['type'] != 'heading') {
					$defaults[$key] = $value['std'];
				}
			}

		}
	}
	return $defaults;
}
function xmenu_get_image_size($is_setting = 0) {
	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array(
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
			);

		}

	}
	$image_size = array();
	if (!$is_setting) {
		$image_size ['inherit'] = esc_html__('Inherit from Menu Setting','g5plus-darna');
	}
	$image_size ['full'] = esc_html__('Full Size','g5plus-darna');
	foreach ($sizes as $key => $value) {
		$image_size[$key] = ucfirst($key) . ' (' . $value['width'] . ' x ' . $value['height'] .')' . ($value['crop'] ? '[cropped]' : '') ;
	}
	return $image_size;
}