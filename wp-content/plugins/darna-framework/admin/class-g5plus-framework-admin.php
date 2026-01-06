<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 5/28/2015
 * Time: 5:18 PM
 */
if (!class_exists('g5plusFramework_Admin')) {
	class g5plusFramework_Admin {

		private $prefix;


		private $version;


		public function __construct( $prefix, $version ) {
			$this->prefix = $prefix;
			$this->version = $version;

			add_action('wp_ajax_popup_icon', array($this,'popup_icon'));
		}

		/**
		 * Register the stylesheets for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles() {
			wp_enqueue_style( $this->prefix.'admin', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/css/admin.css'), array(), $this->version, 'all' );
			wp_enqueue_style( $this->prefix.'flaticon', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/flaticon/css/flaticon.css'), array(), $this->version, 'all' );
			wp_enqueue_style( $this->prefix.'font-awesome', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/fonts-awesome/css/font-awesome.min.css'), array(), $this->version, 'all' );
			wp_enqueue_style( $this->prefix.'popup-icon', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/css/popup-icon.css'), array(), $this->version, 'all' );

			wp_enqueue_style( $this->prefix.'bootstrap-tagsinput', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'), array(), $this->version, 'all' );

			wp_enqueue_style('select2', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/jquery.select2/css/select2.min.css'), array(), '4.0.3');




		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts() {

			wp_enqueue_script( $this->prefix .'admin', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/js/admin.js'), array( 'jquery' ), $this->version, false );


			wp_enqueue_script( $this->prefix .'bootstrap-tagsinput', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'), array( 'jquery' ), $this->version, false );

			wp_enqueue_script( 'select2', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/plugins/jquery.select2/js/select2.full.min.js'), array( 'jquery' ), '4.0.3', true);

			wp_enqueue_script( $this->prefix .'media-init', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/js/g5plus-media-init.js'), array( 'jquery' ), $this->version, false );
			if (function_exists('wp_enqueue_media')) {
				wp_enqueue_media();
			}

			wp_enqueue_script( $this->prefix .'popup-icon', plugins_url(PLUGIN_G5PLUS_FRAMEWORK_NAME.'/admin/assets/js/popup-icon.js'), array( 'jquery' ), $this->version, false );

			wp_localize_script( $this->prefix .'admin' , 'g5plus_framework_meta' , array(
				'ajax_url' => admin_url( 'admin-ajax.php?activate-multi=true' )
			) );

		}

		public function dequeue_assets(){
			$screen         = get_current_screen();
			$screen_id      = $screen ? $screen->id : '';
			$screen_ids   = array(
				'widgets',
				'toplevel_page__options'
			);

			if ( in_array( $screen_id, $screen_ids ) ) {
				wp_dequeue_style( 'woocommerce_admin_styles' );
				wp_dequeue_style('yith_wcan_admin');
				wp_dequeue_style('jquery-ui-style');
				wp_dequeue_style('yit-jquery-ui-style');
				wp_dequeue_style('jquery-ui-overcast');

				wp_dequeue_script('woocommerce_settings');

				wp_dequeue_script( 'wpb_ace' );
				wp_deregister_script( 'wpb_ace' );
			}
		}

		public function popup_icon() {
			$icons = array('glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'remove', 'close', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'gear', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'rotate-right', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'dedent', 'outdent', 'indent', 'video-camera', 'photo', 'image', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'edit', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'mail-forward', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'warning', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'gears', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook-f', 'facebook', 'github', 'unlock', 'credit-card', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'group', 'users', 'chain', 'link', 'cloud', 'flask', 'cut', 'scissors', 'copy', 'files-o', 'paperclip', 'save', 'floppy-o', 'square', 'navicon', 'reorder', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'unsorted', 'sort', 'sort-down', 'sort-desc', 'sort-up', 'sort-asc', 'envelope', 'linkedin', 'rotate-left', 'undo', 'legal', 'gavel', 'dashboard', 'tachometer', 'comment-o', 'comments-o', 'flash', 'bolt', 'sitemap', 'umbrella', 'paste', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile-phone', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'mail-reply', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'mail-reply-all', 'reply-all', 'star-half-empty', 'star-half-full', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'unlink', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'toggle-down', 'caret-square-o-down', 'toggle-up', 'caret-square-o-up', 'toggle-right', 'caret-square-o-right', 'euro', 'eur', 'gbp', 'dollar', 'usd', 'rupee', 'inr', 'cny', 'rmb', 'yen', 'jpy', 'ruble', 'rouble', 'rub', 'won', 'krw', 'bitcoin', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'toggle-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'turkish-lira', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'institution', 'bank', 'university', 'mortar-board', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'automobile', 'car', 'cab', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-photo-o', 'file-picture-o', 'file-image-o', 'file-zip-o', 'file-archive-o', 'file-sound-o', 'file-audio-o', 'file-movie-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-bouy', 'life-buoy', 'life-saver', 'support', 'life-ring', 'circle-o-notch', 'ra', 'rebel', 'ge', 'empire', 'git-square', 'git', 'hacker-news', 'tencent-weibo', 'qq', 'wechat', 'weixin', 'send', 'paper-plane', 'send-o', 'paper-plane-o', 'history', 'genderless', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'soccer-ball-o', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'shekel', 'sheqel', 'ils', 'meanpath', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'hotel', 'bed', 'viacoin', 'train', 'subway', 'medium');
			$icons_flat      = array( 'flaticon-34','flaticon-airplane47','flaticon-airplane48','flaticon-airplane49','flaticon-astronaut','flaticon-atom6','flaticon-atom7','flaticon-axe3','flaticon-barrels','flaticon-barrel','flaticon-battery79','flaticon-battery80','flaticon-battery81','flaticon-battery82','flaticon-battery83','flaticon-battery84','flaticon-battery85','flaticon-battery86','flaticon-beaker4','flaticon-beaker5','flaticon-bicycle10','flaticon-binoculars8','flaticon-bottle21','flaticon-bucket8','flaticon-bulldozer','flaticon-bus21','flaticon-bus22','flaticon-cactus1','flaticon-caliper','flaticon-car80','flaticon-car81','flaticon-car82','flaticon-closed41','flaticon-cloud113','flaticon-cloud114','flaticon-cloud119','flaticon-cloud122','flaticon-cloud123','flaticon-compass43','flaticon-construction7','flaticon-control10','flaticon-control9','flaticon-cooling1','flaticon-cooling','flaticon-cow4','flaticon-crane2','flaticon-cube10','flaticon-cube9','flaticon-cutter','flaticon-delivery13','flaticon-dump','flaticon-emergency6','flaticon-equalizer15','flaticon-excavator','flaticon-factory6','flaticon-fish14','flaticon-fish16','flaticon-fish17','flaticon-flashlight6','flaticon-flower77','flaticon-folding1','flaticon-fuel5','flaticon-gauge5','flaticon-gear6','flaticon-gearwheels','flaticon-hammer38','flaticon-jackhammer','flaticon-jerrycan','flaticon-knife13','flaticon-landing4','flaticon-leaf32','flaticon-magnet3','flaticon-magnifying37','flaticon-measuring6','flaticon-microscope4','flaticon-minibus','flaticon-moon20','flaticon-moon21','flaticon-mosquito2','flaticon-motor2','flaticon-motorbike2','flaticon-moving1','flaticon-mushroom6','flaticon-nail3','flaticon-newtons','flaticon-odometer','flaticon-paint49','flaticon-plant23','flaticon-power30','flaticon-pressure3','flaticon-pylon','flaticon-radar5','flaticon-radiation1','flaticon-rain17','flaticon-rain18','flaticon-remote6','flaticon-road17','flaticon-rocket20','flaticon-screwdriver16','flaticon-sedan1','flaticon-snow20','flaticon-snowflake126','flaticon-spider3','flaticon-spirit','flaticon-sportive27','flaticon-square73','flaticon-steering4','flaticon-submarine2','flaticon-sun35','flaticon-sun36','flaticon-switch10','flaticon-switch11','flaticon-switch12','flaticon-switch13','flaticon-switch8','flaticon-switch9','flaticon-tank','flaticon-tape','flaticon-thermometer28','flaticon-toolbox3','flaticon-tools6','flaticon-tower11','flaticon-tractor','flaticon-tree36','flaticon-truck19','flaticon-truck20','flaticon-truck21','flaticon-truck22','flaticon-ufo1','flaticon-umbrella17','flaticon-van14','flaticon-water29','flaticon-weight8','flaticon-wheel13','flaticon-wheel14','flaticon-wind17','flaticon-windmill2','flaticon-windsock1','flaticon-windup','flaticon-wrench44');
			ob_start();
			?>
			<div id="g5plus-framework-popup-icon-wrapper">
				<div class="popup-icon-wrapper">
					<div class="popup-content">
						<div class="icon-search">
							<input placeholder="Search" type="text" id="txtSearch">

							<div class="preview">
								<span></span> <a id="iconPreview" href="javascript:;"><i class="fa fa-home"></i></a>
							</div>
							<div style="clear: both;"></div>
						</div>
						<div class="list-icon">
							<h3>Font Flat</h3>
							<ul id="group-1">
								<?php foreach ($icons_flat as $icon) {
									?>
									<li><a title="<?php echo esc_attr($icon); ?>" href="javascript:;"><i class="<?php echo esc_attr($icon); ?>"></i></a></li>
									<?php

								} ?>
							</ul>
							<br>

							<h3>Font Awesome</h3>
							<ul id="group-1">
								<?php foreach ($icons as $icon) {
									?>
									<li><a title="fa fa-<?php echo esc_attr($icon); ?>" href="javascript:;"><i
												class="fa fa-<?php echo esc_attr($icon); ?>"></i></a></li>
									<?php

								} ?>
							</ul>
						</div>
					</div>
					<div class="popup-bottom">
						<a id="btnSave" href="javascript:;" class="button button-primary">Insert Icon</a>
					</div>
				</div>
			</div>
			<?php
			die(); // this is required to return a proper result
		}


	}
}