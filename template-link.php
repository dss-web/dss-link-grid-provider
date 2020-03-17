<?php
/**
 * Standard Provider template
 *
 * $this is an instance of the Content Grid Standard Provider object.
 *
 * Available properties:
 * $this->image (array|null) Image.
 * $this->title (string|null) Title
 * $this->text (string|null) Text content / Description
 * $this->call_to_action (array|null)  Call to action link.
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace DSS\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof \Dekode\Hogan\Content_Grid_Provider ) ) {
	return; // Exit if accessed directly.
}

if ( ! empty( $this->image ) ) {


	// printf( '<figure class="%s">',
	// 	esc_attr( hogan_classnames(
	// 		apply_filters( 'hogan/module/content_grid/standard/image/figure_classes', [], $this )
	// 	) )
	// );

	echo wp_get_attachment_image(
		$this->image['id'],
		$this->image['size'],
		$this->image['icon'],
		$this->image['attr']
	);

	// echo '</figure>';
}

if ( ! empty( $this->label ) ) {
	echo '<span>' . esc_textarea( $this->label ) . '</span>';
}

if ( ! empty( $this->title ) ) {
	hogan_component( 'heading', [
		'title' => $this->title,
	] );
}

if ( ! empty( $this->links ) ) {
	write_log( $this->links );
	echo '<ul>';
	foreach ( $this->links as $links ) {
		/*
		[link] => Array
			(
				[title] => PAST
				[url] => http://media.local/eventer/dss-wp-event/past/
				[target] =>
			)
		*/
		printf( '<li><a href="%s" %s>%s</a></li>',
			$links['link']['url'],
			( ! empty( $links['link']['target'] ) ) ? sprintf( 'target=%s',$links['link']['target'] ) : '',
			$links['link']['title']
		);
	}
	echo '</ul>';
}


if ( ! empty( $this->call_to_action ) ) {
	echo '<div>';
	hogan_component( 'button', $this->call_to_action );
	echo '</div>';
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