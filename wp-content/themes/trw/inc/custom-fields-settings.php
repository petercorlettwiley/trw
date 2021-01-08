<?php
/**
 * Programmatic registration of custom fields
 *
 * @package trw
 */

/**
 * Post custom fields
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5ff3abb7a8c7e',
	'title' => 'Additional Post Settings',
	'fields' => array(
		array(
			'key' => 'field_5ff3abd0e0424',
			'label' => 'Post Media',
			'name' => 'media',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => 'field_5ff3abebe0425',
			'min' => 0,
			'max' => 0,
			'layout' => 'row',
			'button_label' => 'Add media',
			'sub_fields' => array(
				array(
					'key' => 'field_5ff3abebe0425',
					'label' => 'Media File',
					'name' => 'file',
					'type' => 'file',
					'instructions' => 'Full-size media file to display in the post. Can be image or video.',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',
					'library' => 'all',
					'min_size' => '',
					'max_size' => '',
					'mime_types' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;