<?php
$root =dirname(dirname(dirname(dirname(dirname(__FILE__)))));

if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
global $dan_redux_demo; 
$b=$dan_redux_demo['main-color-1'];
$rgba = hex2rgb($b);  
?>
.prettyprint .linenums > li:before {
      background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.title span {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.title span a {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.line-hr-primary {
    width: 70px;
    border-top: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?> !important;
}
.line-hr-secondary {
    border-top: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?> !important;
}
.line-vr-section {
    border-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
#loader .loading {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.navbar .navbar-nav .nav-link:hover,
.navbar .navbar-nav .active {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?> !important;
}
.nav-scroll .icon-bar {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
@media screen and (max-width: 991px) {
    .nav-scroll .navbar-collapse .active {
        color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?> !important;
    }
}

.owl-theme .owl-dots .owl-dot span {
    background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.owl-theme .owl-dots .owl-dot.active span,
.owl-theme .owl-dots .owl-dot:hover span {
    background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.owl-theme .owl-dots .owl-dot.active {
    border-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.owl-theme .owl-dots .owl-dot.active {
    border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.owl-theme .owl-dots .owl-dot:hover {
    border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.owl-theme .owl-dots .owl-dot.active span,
.owl-theme .owl-dots .owl-dot:hover span {
    background-color:  <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.header .frame-inner .frame-1:before {
    border-top: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
    border-left: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.header .frame-inner .frame-2:after {
    border-bottom: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
    border-right: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.slider .owl-theme .owl-dots .owl-dot.active,
.slider-fade .owl-theme .owl-dots .owl-dot.active {
    border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.slider .owl-theme .owl-dots .owl-dot.active span,
.slider .owl-theme .owl-dots .owl-dot:hover span,
.slider-fade .owl-theme .owl-dots .owl-dot.active span,
.slider-fade .owl-theme .owl-dots .owl-dot:hover span {
    background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}

.awards .owl-carousel .owl-item img:hover {
    border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.services .item .con .category {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.services .item .con i:hover {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.services .item .con .btn:hover {
    border-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
    ;
}
.dantext ul li:before {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.services-page .owl-theme .owl-nav [class*=owl-]:hover {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.sidebar .sidebar-widget .phone .icon {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.sidebar .services ul li:before {
    background: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.team .info .social a {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.team .info .social a:hover {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.team-details .content .social-icons.square li a:hover {
 border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.price-box .price-box-inner ul li.pricing-title .pricing-pt-title {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-page .post-cont .tag,
.blog-page .post-cont .date {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-page .post-cont h5 a:hover {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-sidebar .widget ul li a.active {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-sidebar .widget ul li a:hover {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-sidebar ul.tags li:hover,
.blog-sidebar ul.tags li a:hover {
    background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-pagination-wrap li a.active {
    background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
    border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.post-page .post-cont .tag,
.post-page .post-cont .date {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.post-page .post-cont h5 a:hover {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
blockquote {
    border-left: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.post-prev-next a i {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.form-control:active,
.form-control:focus {
    border-bottom: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.flat-btn {
    background: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
a.underline-text {
    border-bottom: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.footer-section p b {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.progress-wrap::after {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.progress-wrap::after {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.progress-wrap svg.progress-circle path {
    stroke: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
div.comment-respond form p.form-submit input[type="submit"] {
  border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
  background: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
ul.blog-pagination-wrap li span {
  background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
  border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-sidebar .widget_categories ul li a:hover {
  color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
ul.wp-tag-cloud li:hover {
  background-color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
section.contact form input[type="submit"] {
  border: 1px solid <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
  background: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
ul.navbar-nav li a:active, ul.navbar-nav li a:hover,
ul.navbar-nav li a:target, ul.navbar-nav li:focus-within a {
  color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?> !important;
}

.blog .blog-page .item:hover h5,
 .blog .blog-page .item:hover span {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.post-cont span.tag {
  color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-page .post-cont .info:after{
    background: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}

.blog-page .post-cont .info:hover {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}
.blog-page .post-cont .tag, .blog-page .post-cont .date {
    color: <?php echo esc_attr($dan_redux_demo['main-color-1']); ?>;
}