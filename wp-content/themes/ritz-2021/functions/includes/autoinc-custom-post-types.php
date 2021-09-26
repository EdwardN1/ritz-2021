<?php
/**
 *
 * Ritz Offers Custom Post Type and Taxonomy
 *
 */

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

endif;

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

/**
 *
 * Ritz Image Gallery Custom Post Type and Taxonomy
 *
 */

if ( ! function_exists( 'create_ritz_image_gallery_post_type' ) ) :

    function create_ritz_image_gallery_post_type() {

        // You'll want to replace the values below with your own.
        register_post_type( 'ritzimagegallery', // change the name
            array(
                'labels' => array(
                    'name' => __( 'Image Gallery' ), // change the name
                    'singular_name' => __( 'ritzimagegallery' ), // change the name
                ),
                'public' => true,
                'supports' => array ( 'title',  'custom-fields', 'page-attributes' ), // do you need all of these options?
                'taxonomies' => array( 'ritzimagegallerycategory'), // do you need categories and tags?
                'hierarchical' => true,
                'menu_icon' => get_bloginfo( 'template_directory' ) . "/assets/images/ritz-icon-white.png",
                'rewrite' => array ( 'slug' => __( 'ritzimagegallery' ) ) // change the name
            )
        );

    }
    add_action( 'init', 'create_ritz_image_gallery_post_type' );

endif;

function add_ritz_image_gallery_custom_taxonomies() {
    // Add new "Locations" taxonomy to Posts
    register_taxonomy('ritzimagegallerycategory', 'post', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => false,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => array(
            'name' => _x( 'Gallery', 'taxonomy general name' ),
            'singular_name' => _x( 'Gallery', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Galleries' ),
            'all_items' => __( 'All Galleries' ),
            'parent_item' => __( 'Parent Gallery' ),
            'parent_item_colon' => __( 'Parent Gallery:' ),
            'edit_item' => __( 'Edit Gallery' ),
            'update_item' => __( 'Update Gallery' ),
            'add_new_item' => __( 'Add New Gallery' ),
            'new_item_name' => __( 'New Gallery Name' ),
            'menu_name' => __( 'Gallery Categories' ),
        ),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'ritzimagegallerycategory', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/locations/"
            'hierarchical' => false // This will allow URL's like "/locations/boston/cambridge/"
        ),
    ));
}
add_action( 'init', 'add_ritz_image_gallery_custom_taxonomies', 0 );

// $which (the position of the filters form) is either 'top' or 'bottom'
add_action( 'restrict_manage_posts', function ( $post_type, $which ) {
    if ( 'top' === $which && 'ritzimagegallery' === $post_type ) {
        $taxonomy = 'ritzimagegallerycategory';
        $tax = get_taxonomy( $taxonomy );            // get the taxonomy object/data
        $cat = filter_input( INPUT_GET, $taxonomy ); // get the selected category slug

        echo '<label class="screen-reader-text" for="ritzimagegallerycategory">Filter by ' .
            esc_html( $tax->labels->singular_name ) . '</label>';

        wp_dropdown_categories( [
            'show_option_all' => $tax->labels->all_items,
            'hide_empty'      => 0, // include categories that have no posts
            'hierarchical'    => $tax->hierarchical,
            'show_count'      => 0, // don't show the category's posts count
            'orderby'         => 'name',
            'selected'        => $cat,
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'value_field'     => 'slug',
        ] );
    }
}, 10, 2 );

function custom_columns( $columns ) {
    if(get_current_screen()->post_type=='ritzimagegallery') {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'ritz_gallery_featured_image' => 'Image',
            'ritz_gallery_category' => 'Category',
            'title' => 'Title',
            'date' => 'Date'
        );
    }
    return $columns;
}
add_filter('manage_posts_columns' , 'custom_columns');

function custom_columns_data( $column, $post_id ) {
    switch ( $column ) {
        case 'ritz_gallery_featured_image':
            $image = get_field('image',$post_id);
            if($image) echo '<img src="'.$image['sizes']['thumbnail'].'" style="max-height:75px;"/>';
            break;
        case 'ritz_gallery_category':
            $image_category = get_field( 'image_category' );
            $term = get_term_by( 'id', $image_category, 'ritzimagegallerycategory' );
            echo esc_html( $term->name );
            break;
    }
}
add_action( 'manage_ritzimagegallery_posts_custom_column' , 'custom_columns_data', 10, 2 );

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
    global $typenow;
    $post_type = 'ritzoffers'; // change to your post type
    $taxonomy  = 'offercategory'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf( __( 'Show all %s', 'textdomain' ), $info_taxonomy->label ),
            'taxonomy'        => $taxonomy,
            'name'            => $taxonomy,
            'orderby'         => 'name',
            'selected'        => $selected,
            'show_count'      => true,
            'hide_empty'      => true,
        ));
    };
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
    global $pagenow;
    $post_type = 'ritzoffers'; // change to your post type
    $taxonomy  = 'offercategory'; // change to your taxonomy
    $q_vars    = &$query->query_vars;
    if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}