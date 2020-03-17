<?php declare( strict_types = 1 );

/**
 * DSS Link Grid Provider
 *
 * @package     DSS Link Grid Provider
 * @author      Per Soderlind
 * @copyright   2020 Per Soderlind
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: DSS Link Grid Provider
 * Plugin URI: https://github.com/soderlind/dss-link-grid-provider
 * GitHub Plugin URI: https://github.com/soderlind/dss-link-grid-provider
 * Description: description
 * Version:     0.0.1
 * Author:      Per Soderlind
 * Author URI:  https://soderlind.no
 * Text Domain: dss-link-grid-provider
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
namespace DSS\Hogan\Grid;

if ( ! defined('ABSPATH') ) {
	wp_die();
}

add_action('hogan/module/content_grid/register_providers', __NAMESPACE__ . '\\register_link_content_grid_provider', 9);
add_filter( 'hogan/module/content_grid/template/linklist', function ($template_part, $module ) {
	return plugin_dir_path( __FILE__ ) . 'template-link.php';
}, 10, 2 );
add_filter('hogan/module/content_grid/linklist/image/args', function() {
	return [ 'size' => 'medium-3-2' ];
});
function register_link_content_grid_provider( \Dekode\Hogan\Content_Grid $module ) {
	write_log('register_link_content_grid_provider');
	require_once 'class-link-content-grid-provider.php';
	if ( class_exists('\DSS\Hogan\Grid\Link_Content_Grid_Provider') ) {
		write_log('Link_Content_Grid_Provider');
		$module->register_content_grid_provider(new \DSS\Hogan\Grid\Link_Content_Grid_Provider());
	}
}

//phpcs:disable
if ( ! function_exists( 'write_log' ) ) {
	/**
	* Utility function for logging arbitrary variables to the error log.
	*
	* Set the constant WP_DEBUG to true and the constant WP_DEBUG_LOG to true to log to wp-content/debug.log.
	* You can view the log in realtime in your terminal by executing `tail -f debug.log` and Ctrl+C to stop.
	*
	* @param mixed $log Whatever to log.
	*/
	function write_log( $log ) {
		if ( true === WP_DEBUG ) {
			if ( is_scalar( $log ) ) {
				error_log( $log );
			} else {
				error_log( print_r( $log, true ) );
			}
		}
	}
}
//phpcs:enable