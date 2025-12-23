<?php
/**
 * Plugin Name: Operations Bridges
 * Description: Displays a full-screen memorial popup on the death of a senior member of the British Royal Family.
 * Version: 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'OB_PATH', plugin_dir_path( __FILE__ ) );
define( 'OB_URL', plugin_dir_url( __FILE__ ) );

/**
 * Admin menu
 */
add_action( 'admin_menu', function () {
    add_menu_page(
        'Operations Bridges',
        'Operations Bridges',
        'manage_options',
        'operations-bridges',
        'operations_bridges_admin_page',
        'dashicons-flag',
        1 // ← TOP of the menu (below Dashboard)
    );
});

/**
 * Register settings
 */
add_action( 'admin_init', function () {
    register_setting( 'operations_bridges', 'ob_enabled' );
    register_setting( 'operations_bridges', 'ob_image_id' );
    register_setting( 'operations_bridges', 'ob_birth_date' );
    register_setting( 'operations_bridges', 'ob_death_date' );
});

/**
 * Load admin page
 */
require_once OB_PATH . 'admin/admin-page.php';

/**
 * Enqueue admin assets
 */
add_action( 'admin_enqueue_scripts', function ( $hook ) {
    if ( $hook !== 'toplevel_page_operations-bridges' ) return;

    wp_enqueue_media();

    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style(
        'jquery-ui-css',
        'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css'
    );

    wp_enqueue_style(
        'ob-admin',
        OB_URL . 'admin/admin.css',
        [],
        '1.2'
    );

    wp_enqueue_script(
        'ob-admin',
        OB_URL . 'admin/admin.js',
        [ 'jquery', 'jquery-ui-datepicker' ],
        '1.2',
        true
    );
});

/**
 * Frontend popup
 */
add_action( 'wp_footer', function () {

    if ( ! get_option( 'ob_enabled' ) ) return;

    $image_id = get_option( 'ob_image_id' );
    if ( ! $image_id ) return;

    $image_url  = wp_get_attachment_image_url( $image_id, 'large' );
    $birth_date = esc_html( get_option( 'ob_birth_date' ) );
    $death_date = esc_html( get_option( 'ob_death_date' ) );

    wp_enqueue_style( 'ob-popup', OB_URL . 'public/popup.css', [], '1.1' );
    wp_enqueue_script( 'ob-popup', OB_URL . 'public/popup.js', [], '1.1', true );
    ?>

    <div id="operations-bridges-overlay">
        <div class="operations-bridges-content">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="">
            <p class="operations-bridges-dates">
                <?php echo $birth_date; ?> &ndash; <?php echo $death_date; ?>
            </p>
            <button id="operations-bridges-close">Continue to website</button>
        </div>
    </div>

    <?php
});
