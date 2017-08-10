<?php
/*
Plugin Name: Woobizz Hook 17
Plugin URI: http://woobizz.com
Description: Add widget content after proceed to checkout button on cart page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook17
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook17_load_textdomain' );
function woobizzhook17_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook17', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	//Hook(s) 17
	add_action( 'woocommerce_proceed_to_checkout', 'woobizzhook17_display',20);
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook17_admin_notice' );
}
//Add Hook 17
add_action( 'widgets_init', 'woobizzhook17_widget',117);
function woobizzhook17_widget() {
	$args = array(
				'id'            => 'woobizzhook17_id',
				'name'          => __( 'Woobizz Hook 17', 'woobizzhook17' ),
				'description'   => __( 'Add widget content after proceed to checkout button on cart page','woobizzhook17' ),
				'before_title'  => '<h2 class="widgettitle">',
				'before_title'   => '</h2>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'before_widget'  => '</li>',
	);
	register_sidebar( $args );
	add_action( 'woocommerce_proceed_to_checkout', 'woobizzhook17_display',20);
	function woobizzhook17_display(){
		?>
		<div class="woobizzhook17-widget-div">
			<div class="woobizzhook17-widget-content">
				<?php dynamic_sidebar( 'Woobizz Hook 17' ); ?>
			</div>
		</div>
		<?php
	}
}
//Hook17 Notice
function woobizzhook17_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 17 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook17' ); ?></p>
    </div>
    <?php
}