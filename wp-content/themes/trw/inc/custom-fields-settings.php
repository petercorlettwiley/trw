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

/** 
 * About page options
 */

function trw_acf_options_page() {
  if( function_exists('acf_add_options_page') ) {

    // Register options page.
    $option_page = acf_add_options_page(array(
      'page_title'    => __('About Page Options'),
      'menu_title'    => __('About Page'),
      'menu_slug'     => 'about_page',
      'capability'    => 'edit_posts',
      'redirect'      => false
    ));
  }
}

add_action('acf/init', 'trw_acf_options_page');

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6013503d69846',
	'title' => 'About Page Content',
	'fields' => array(
		array(
			'key' => 'field_60135062b2243',
			'label' => 'Contact Email',
			'name' => 'contact_email',
			'type' => 'email',
			'instructions' => 'Linked email address for the \'contact\' link',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'tyler@trwcreative.com',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_601350deb2244',
			'label' => 'Instagram Link',
			'name' => 'instagram_link',
			'type' => 'url',
			'instructions' => 'URL for the \'instagram\' link',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'https://www.instagram.com/_tylerwray_',
			'placeholder' => '',
		),
		array(
			'key' => 'field_6013513eb2245',
			'label' => 'About Content',
			'name' => 'about_content',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Tyler Wray works to provide art direction and design services for a range of fashion and lifestyle brands.
He is also co-creator and producer of the ongoing multimedia project Everything Is Stories.',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 0,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'about_page',
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