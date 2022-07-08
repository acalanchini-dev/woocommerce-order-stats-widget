<?php
/**
* Plugin Name:       Woocommerce widget order stats
* Plugin URI:        https://example.com/plugins/the-basics/
* Description:       Aggiunge un widget con le statistiche di ogni tipo di ordine
* Version:           1.0
* Requires at least: 6.0
* Requires PHP:      7.2
* Author:            Alessio Calanchini
* Author URI:
* License:           GPL v2 or later
* License URI:       https://www.gnu.org/licenses/gpl-2.0.html
* Update URI:        https://example.com/my-plugin/
* Text Domain:       wc-widget-order-stats
* Domain Path:       /languages
*
*
* @since      1.0.0
* @package    wc-widget-order-stats
* @author     Alessio Calanchini <ac.calanchini@gmail.com>
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Woocommerce_Widget_Order_stats' ) ) {
    class Woocommerce_Widget_Order_stats {
        
        public $widget;
        /**
        * Definiamo costruttore della classe
        */

        function __construct() {

            // Declare the methods
            $this->define_constants();
            $this->load_dependencies();
          

        }
        /**
        * Define constants
        */

        public function define_constants() {
            define( 'WCOS_PATH', plugin_dir_path( __FILE__ ) );//path fino alla cartella plugin
            define( 'WCOS_URL', plugin_dir_url( __FILE__ ) );//url fino alla cartella plugin
            define( 'WCOS_VERSION', '1.0.0' );
            define( 'WCOS_TEXTDOMAIN', 'wc-widget-order-stats' );
        }

        public function is_woocommerce_active() {
            if ( class_exists( 'WooCommerce' ) ) {
                return true;
            } else {
                return false;
            }
        }

        private function load_dependencies() {

            /**
            * The class responsible ...
            */
            require_once( WCOS_PATH . 'admin/class_widget_order_stats.php' );
           

           

        }

        // Activate method
        public static function activate() {
        }

        //Deactivate method
        public static function deactivate() {
        }

        // Uninstall method
        public static function uninstall() {
        }

    }
}

if ( class_exists( 'Woocommerce_Widget_Order_stats' ) ) {
    register_activation_hook( __FILE__, array( 'Woocommerce_Widget_Order_stats', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'Woocommerce_Widget_Order_stats', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'Woocommerce_Widget_Order_stats', 'uninstall' ) );
    $wc_order_stats = new Woocommerce_Widget_Order_stats();
}