			<?php
			/**
			 **/
			do_action('g5plus_main_wrapper_content_end');
			?>

			</div>
			<!-- Close Wrapper Content -->

            <?php
                $main_footer_class = array('main-footer-wrapper');
                $opt_footer_parallax = g5plus_get_option('footer_parallax','0');
                if($opt_footer_parallax=='1') {
	                $main_footer_class[] = 'enable-parallax';
                }
				$opt_collapse_footer = g5plus_get_option('collapse_footer','0');
	            if($opt_collapse_footer=='1') {
		            $main_footer_class[] = 'footer-collapse-able';
	            }


	            // SHOW FOOTER
                $prefix = 'g5plus_';
	            $footer_show_hide = g5plus_get_meta($prefix . 'footer_show_hide');
	            if (($footer_show_hide === false) || ($footer_show_hide === '')) {
		            $footer_show_hide = '1';
	            }



            ?>
			<?php if ($footer_show_hide == '1'): ?>
	            <footer class="<?php echo join(' ', $main_footer_class) ?>">
	                <div id="wrapper-footer">
	                    <?php
	                    /**
	                     * @hooked - g5plus_footer_widgets - 10
	                     **/
	                    do_action('g5plus_main_wrapper_footer');
	                    ?>
	                </div>
	            </footer>
			<?php endif;?>
		</div>
		<!-- Close Wrapper -->

		<?php
		/**
		 * @hooked - g5plus_back_to_top - 5
		 **/
		do_action('g5plus_after_page_wrapper');
		?>
	<?php wp_footer(); ?>
</body>
</html> <!-- end of site. what a ride! -->