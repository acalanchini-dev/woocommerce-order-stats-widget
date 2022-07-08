<?php

/**
* The file that defines the core plugin class
*
* A class definition that includes attributes and functions used across both the
* public-facing side of the site and the admin area.
*
* @link       ac.com
* @since      1.0.0
*
* @package    wc-widget-order-stats
* @subpackage wc-widget-order-stats/admin
*/

/**
* The core plugin class.
*
* This is used to define internationalization, admin-specific hooks, and
* public-facing site hooks.
*
* Also maintains the unique identifier of this plugin as well as the current
* version of the plugin.
*
* @since      1.0.0
* @package    wc-widget-order-stats
* @subpackage wc-widget-order-stats/admin
* @author     Alessio Calanchini <ac.calanchini@gmail.com>
*/

class Widget_order_stats {

    public function __construct() {
        add_action( 'wp_dashboard_setup', array( $this, 'wc_dashboard_widget_order_stats_init' ) );
    }

    public function wc_dashboard_widget_order_stats_init() {
        wp_add_dashboard_widget( 'woocommerce_dashboard_widget_stats', __( 'WooCommerce order stats', 'woocommerce' ), array( $this, 'wc_dashboard_widget_order_stats' ) );
    }

    function wc_dashboard_widget_order_stats() {
        global $woocommerce;

        $on_hold_count    = 0;
        $processing_count = 0;
        $pending_count = 0;
        $completed_count = 0;
        $failed_count = 0;
        $refunded_count  = 0;
        $cancelled_count = 0;

        foreach ( wc_get_order_types( 'order-count' ) as $type ) {
            $counts            = ( array ) wp_count_posts( $type );
            $on_hold_count    += isset( $counts[ 'wc-on-hold' ] ) ? $counts[ 'wc-on-hold' ] : 0;
            $processing_count += isset( $counts[ 'wc-processing' ] ) ? $counts[ 'wc-processing' ] : 0;
            $pending_count    += isset( $counts[ 'wc-pending' ] ) ? $counts[ 'wc-pending' ] : 0;
            $completed_count    += isset( $counts[ 'wc-completed' ] ) ? $counts[ 'wc-completed' ] : 0;
            $failed_count    += isset( $counts[ 'wc-failed' ] ) ? $counts[ 'wc-failed' ] : 0;
            $refunded_count    += isset( $counts[ 'wc-completed' ] ) ? $counts[ 'wc-refunded' ] : 0;
            $cancelled_count    += isset( $counts[ 'wc-cancelled' ] ) ? $counts[ 'wc-cancelled' ] : 0;
        }

        ?>

<li class='on-hold-orders'>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_status=wc-on-hold&amp;post_type=shop_order' ) ); ?>">
        <?php
        printf(
            _n( '%s order on-hold', '%s orders on-hold', $on_hold_count, 'woocommerce' ),
            $on_hold_count
        );
        ?>
    </a>
</li>

<li class='processing-orders'>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_status=wc-processing&amp;post_type=shop_order' ) ); ?>">
        <?php

        printf(
            _n( '%s order awaiting processing', '%s orders awaiting processing', $processing_count, 'woocommerce' ),
            $processing_count
        );
        ?>
    </a>
</li>

<li class='pending-orders'>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_status=wc-pending&amp;post_type=shop_order' ) ); ?>">
        <?php
        printf(
            _n( '%s order pending', '%s orders pending', $pending_count, 'woocommerce' ),
            $pending_count
        );
        ?>
    </a>
</li>

<li class='completed-orders'>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_status=wc-completed&amp;post_type=shop_order' ) ); ?>">
        <?php
        printf(
            _n( '%s order completed', '%s orders completed', $completed_count, 'woocommerce' ),
            $completed_count
        );

        ?>
    </a>
</li>

<li class='failed-orders'>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_status=wc-failed&amp;post_type=shop_order' ) ); ?>">
        <?php
        printf(
            _n( '%s order failed', '%s orders failed', $failed_count, 'woocommerce' ),
            $failed_count
        );
        ?>
    </a>
</li>

<li class='refunded-orders'>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_status=wc-refunded&amp;post_type=shop_order' ) ); ?>">
        <?php
        printf(
            _n( '%s order refunded', '%s orders refunded', $refunded_count, 'woocommerce' ),
            $refunded_count
        );
        ?>
    </a>
</li>

<li class='cancelled-orders'>
    <a href="<?php echo esc_url( admin_url( 'edit.php?post_status=wc-cancelled&amp;post_type=shop_order' ) ); ?>">
        <?php
        printf(
            _n( '%s order cancelled', '%s orders cancelled', $cancelled_count, 'woocommerce' ),
            $cancelled_count
        );
        ?>
    </a>
</li>

<?php
    }

}
new Widget_order_stats();