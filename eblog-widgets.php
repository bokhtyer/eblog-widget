<?php 

if ( !defined('ABSPATH') )
    exit;

/*
Plugin Name: Eblog Widget
Plugin URI: http://www.facebook.com/abidtpi/
Description: Eblog Widget Plugin For Eblog
Version: 1.0.0
Author: BokhtyerAbid
Author URI: http://www.facebook.com/abidtpi/
*/



// register Eblog_Widget widget
function register_eblog_widget() {
    register_widget( 'Recent_Blog_widgets' );
    register_widget( 'Subscriber_widgets' );
}
add_action( 'widgets_init', 'register_eblog_widget' );


require_once  plugin_dir_path( __FILE__ ) . 'widget/eblog-recent-post-widget.php';
require_once  plugin_dir_path( __FILE__ ) . 'widget/eblog-subscriber-widget.php';