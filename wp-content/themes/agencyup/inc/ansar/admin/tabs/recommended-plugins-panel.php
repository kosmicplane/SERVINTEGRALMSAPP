<?php
/**
 * Recommended Plugins Panel
 *
 * @package agencyup
 */
?>
<div id="recommended-plugins-panel" class="panel-left">
	<?php 
	$agencyup_free_plugins = array(
		
		'elementor' => array(
		    'name'     	=> 'Elementor',
			'slug'     	=> 'elementor',
			'filename' 	=> 'elementor.php',
		),

		'ansar-import' => array(
		    'name'     	=> 'Ansar Import',
			'slug'     	=> 'ansar-import',
			'filename' 	=> 'ansar-import.php',
		),

		
	);
	if( !empty( $agencyup_free_plugins ) ) { ?>
		<div class="recomended-plugin-wrap">
		<?php
		foreach( $agencyup_free_plugins as $agencyup_plugin ) {
			$info 		= agencyup_call_plugin_api( $agencyup_plugin['slug'] ); ?>
			<div class="recom-plugin-wrap w--col">
				<div class="plugin-title-install clearfix">
					<span class="title">
						<?php echo esc_html( $agencyup_plugin['name'] ); ?>	
					</span>
					
					
				    <?php if($agencyup_plugin['slug'] == 'elementor') : ?>
					<p><?php esc_html_e('To use the Elementor layouts and pages, install the Elementor plugin.', 'agencyup'); ?></p>
					<?php endif; ?>	


					 <?php if($agencyup_plugin['slug'] == 'ansar-import') : ?>
					<p><?php esc_html_e('To use the Readymade Elementor Template Install and activate Ansar Demo Import plugin then go to appreance menu, click','agencyup'); ?>   
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=ansar-demo-import' ) ); ?>" style="text-decoration: none;"><?php echo esc_html__('Ansar Demo Importer','agencyup'); ?></a>
					<?php esc_html_e('and Import or Install Elementor Template according to your need.', 'agencyup'); ?>
					</p>
					<?php endif; ?>	

					<?php 
					echo '<div class="button-wrap">';
					echo Agencyup_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $agencyup_plugin['slug'] );
					echo '</div>';
					?>
				</div>
			</div>
			</br>
			<?php
		} ?>
		</div>
	<?php
	} ?>
</div>