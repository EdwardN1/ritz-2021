<?php
// REGISTER CUSTOM POST TYPES
// You can register more, just duplicate the register_post_type code inside of the function and change the values. You are set!
if ( ! function_exists( 'create_ritz_offers_post_type' ) ) :

	function create_ritz_offers_post_type() {

		// You'll want to replace the values below with your own.
		register_post_type( 'ritzoffers', // change the name
			array(
				'labels' => array(
					'name' => __( 'Offers & Packages' ), // change the name
					'singular_name' => __( 'ritzoffers' ), // change the name
				),
				'public' => true,
				'supports' => array ( 'title',  'custom-fields' ), // do you need all of these options?
				'taxonomies' => array( 'offercategory'), // do you need categories and tags?
				'hierarchical' => true,
				'menu_icon' => get_bloginfo( 'template_directory' ) . "/assets/images/ritz-icon-white.png",
				'rewrite' => array ( 'slug' => __( 'ritzoffers' ) ) // change the name
			)
		);

	}
	add_action( 'init', 'create_ritz_offers_post_type' );

endif; // ####

/**
 * Add custom taxonomies
 *
 * Additional custom taxonomies can be defined here
 * http://codex.wordpress.org/Function_Reference/register_taxonomy
 */
function add_ritz_offers_custom_taxonomies() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy('offercategory', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => false,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Offers', 'taxonomy general name' ),
			'singular_name' => _x( 'Offer', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Offers' ),
			'all_items' => __( 'All Offers' ),
			'parent_item' => __( 'Parent Offer' ),
			'parent_item_colon' => __( 'Parent Offer:' ),
			'edit_item' => __( 'Edit Offer' ),
			'update_item' => __( 'Update Offer' ),
			'add_new_item' => __( 'Add New Offer' ),
			'new_item_name' => __( 'New Offer Name' ),
			'menu_name' => __( 'Offer Categories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'offers', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_ritz_offers_custom_taxonomies', 0 );