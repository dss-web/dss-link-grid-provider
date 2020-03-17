<?php
/**
 * Link Provider class for Hogan Content Grid
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace DSS\Hogan\Grid;

if ( ! \class_exists('\\Dekode\\Hogan\\Base_Content_Grid_Provider') || ! \interface_exists('\\Dekode\\Hogan\\Content_Grid_Provider') ) {
	return;
}

/**
 * Text Content Grid Provider class for Hogan Content Grid
 */
class Link_Content_Grid_Provider extends \Dekode\Hogan\Base_Content_Grid_Provider implements \Dekode\Hogan\Content_Grid_Provider {

	/**
	 * Image
	 *
	 * @var array|null $image
	 */
	public $image;

	/**
	 * Column label content
	 *
	 * @var string $label
	 */
	public $label;

	/**
	 * Column title content
	 *
	 * @var string $title
	 */
	public $title;

	/**
	 * Column text content
	 *
	 * @var string $text
	 */
	public $text;

	/**
	 * Call to action link.
	 *
	 * @var array|null $call_to_action
	 */
	public $call_to_action;

	/**
	 * Get provider identifier, i.e. "text"
	 *
	 * @return string Provider identifier
	 */
	public function get_identifier() : string {
		write_log('get_identifier');
		return 'linklist';
	}

	/**
	 * Get provider acf label, i.e. "Wysiwyg"
	 *
	 * @return string Provider name
	 */
	public function get_name() : string {
		return esc_html__('Link list', 'dss-link-grid-provider');
	}

	/**
	 * Get provider fields
	 *
	 * @param string $field_key Module field key.
	 *
	 * @return array ACF fields
	 */
	public function get_provider_fields( string $field_key ) : array {
		$provider_identifier = $this->get_identifier();

		$constraints_defaults = [
			'min_width'  => '',
			'min_height' => '',
			'max_width'  => '',
			'max_height' => '',
			'min_size'   => '',
			'max_size'   => '',
			'mime_types' => '',
		];

		// Merge $args from filter with $defaults.
		$constraints_args = wp_parse_args(apply_filters('hogan/module/content_grid/' . $provider_identifier . '/image_size/constraints', []), $constraints_defaults);

		/*
		 * Image field.
		 */
		$fields[] = [
			'type'          => 'image',
			'key'           => $field_key . '_image_id',
			'name'          => 'image_id',
			'label'         => __('Add Image', 'dss-link-grid-provider'),
			'required'      => 0,
			'return_format' => 'id',
			'preview_size'  => apply_filters('hogan/module/image/image_size/preview_size', 'thumbnail'), // todo: filter named wrong? Should be content_grid.
			'library'       => apply_filters('hogan/module/image/image_size/library', 'all'), // todo: filter named wrong? Should be content_grid.
			'min_width'     => $constraints_args['min_width'],
			'min_height'    => $constraints_args['min_height'],
			'max_width'     => $constraints_args['max_width'],
			'max_height'    => $constraints_args['max_height'],
			'min_size'      => $constraints_args['min_size'],
			'max_size'      => $constraints_args['max_size'],
			'mime_types'    => $constraints_args['mime_types'],
		];

		/*
		 * Label field.
		 */
		if ( true === apply_filters('hogan/module/content_grid/linklist/label/enabled', false) ) {
			$fields[] = [
				'type'  => 'text',
				'key'   => $field_key . '_label',
				'name'  => 'label',
				'label' => __('Label', 'dss-link-grid-provider'),
			];
		}

		/*
		 * Title field.
		 */
		$fields[] = [
			'type'  => 'text',
			'key'   => $field_key . '_title',
			'name'  => 'title',
			'label' => __('Title', 'dss-link-grid-provider'),

		];

		/*
		 * Text field.
		 */
		// $fields[] = [
		// 	'type'      => 'textarea',
		// 	'key'       => $field_key . '_text',
		// 	'name'      => 'text',
		// 	'label'     => __( 'Add Text', 'dss-link-grid-provider' ),
		// 	'rows'      => 4,
		// 	'new_lines' => '',
		// ];

		$fields[] = [
			'key'          => $this->field_key . '_links',
			'label'        => 'Links',
			'name'         => 'links',
			'type'         => 'repeater',
			'min'          => 1,
			'layout'       => 'block',
			'button_label' => esc_html__('New link', 'hogan-linklist'),
			'sub_fields'   => [
				[
					'key'           => $this->field_key . '_link',
					'label'         => esc_html__('Set link and text', 'hogan-linklist'),
					'name'          => 'link',
					'type'          => 'link',
					'return_format' => 'array',
					'required'      => 1,
				],
			],

		];

		/*
		 * Link field
		 */
		// $fields[] = [
		// 	'type'          => 'link',
		// 	'key'           => $field_key . '_cta',
		// 	'label'         => __( 'Call to action', 'dss-link-grid-provider' ),
		// 	'name'          => 'cta',
		// 	'return_format' => 'array',
		// ];

		return $fields;
	}

	/**
	 * Get rendered content_grid HTML
	 *
	 * @param array $raw_content Content values.
	 *
	 * @return string Content Grid HTML
	 */
	public function get_content_grid_html( array $raw_content ) : string {

		$this->title = $raw_content['title'] ?: null;
		$this->label = $raw_content['label'] ?? null;
		$this->links = $raw_content['links'] ?: null;
		$this->image = $raw_content['image_id'] ?: null;

		if ( null !== $this->image ) {
			$image = wp_parse_args(
				apply_filters('hogan/module/content_grid/' . $this->get_identifier() . '/image/args', []), [
					'size' => 'medium',
					'icon' => false,
					'attr' => [],
				]
			);

			$image['id'] = $raw_content['image_id'];
			$this->image = $image;
		}

		// Call to action button.
		// if ( null !== $this->links ) {
		// 	$cta              = $raw_content['cta'];
		// 	$cta['title']     = $cta['title'] ?: __('Read more', 'dss-link-grid-provider');
		// 	$cta['classname'] = apply_filters('hogan/module/banner/cta_css_classes', '', $this);

		// 	$this->call_to_action = $cta;
		// }

		return parent::render_template();
	}

}
