<?php
/**
 * Link List Provider template
 *
 * $this is an instance of the Content Grid Link List Provider object.
 *
 * Available properties:
 * $this->image (array|null) Image.
 * $this->title (string|null) Title
 * $this->links (array|null) Links, []['title' = 'The title', 'url  = 'https://example.com', 'target' = empty|'_blank']
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace DSS\Hogan;

if ( ! defined('ABSPATH') || ! ( $this instanceof \Dekode\Hogan\Content_Grid_Provider ) ) {
	return; // Exit if accessed directly.
}

if ( ! empty($this->image) ) {
	printf(
		'<figure class="%s">',
		esc_attr(
			hogan_classnames(
				apply_filters('hogan/module/content_grid/linklist/image/figure_classes', [], $this)
			)
		)
	);

	echo wp_get_attachment_image(
		$this->image['id'],
		$this->image['size'],
		$this->image['icon'],
		$this->image['attr']
	);

	echo '</figure>';
}

if ( ! empty($this->label) ) {
	echo '<span>' . esc_textarea($this->label) . '</span>';
}

if ( ! empty($this->title) ) {
	hogan_component(
		'heading', [
			'title' => $this->title,
		]
	);
}

if ( ! empty($this->links) ) {
	echo '<ul>';
	foreach ( $this->links as $links ) {
		printf(
			'<li><a href="%s" %s>%s</a></li>',
			$links['link']['url'],
			( ! empty($links['link']['target']) ) ? sprintf('target=%s', $links['link']['target']) : '',
			$links['link']['title']
		);
	}
	echo '</ul>';
}

if ( ! empty($this->call_to_action) ) {
	echo '<div>';
	hogan_component('button', $this->call_to_action);
	echo '</div>';
}
