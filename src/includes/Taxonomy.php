<?php

/**
 * Registers taxonomy to the post type
 */
namespace IsaacBookstore\includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Taxonomy {
    public $taxonomy_name;
    public $post_type_name;
    public $singular_name;
    public $plugin_name;

	public function __construct($taxonomy_name, $singular_name, $post_type_name, $plugin_name) {
        $this->taxonomy_name = $taxonomy_name;
        $this->singular_name = $singular_name;
        $this->post_type_name = $post_type_name;
        $this->plugin_name = $plugin_name;
	}

	public function run() {
        $this->add_action( 'init', array( &$this, 'register' ) );
	}

	function add_action( $action, $function, $priority = 10, $accepted_args = 1 ) {
        add_action( $action, $function, $priority, $accepted_args );
    }
	
	function register() {
		$labels = array(
			'name'              => _x( $this->taxonomy_name, 'taxonomy general name', $this->plugin_name ),
			'singular_name'     => _x( $this->singular_name, 'taxonomy singular name', $this->plugin_name ),
			'search_items'      => __( 'Search ' . $this->taxonomy_name, $this->plugin_name ),
			'all_items'         => __( 'All ' . $this->taxonomy_name, $this->plugin_name ),
			'parent_item'       => __( 'Parent ' . $this->singular_name, $this->plugin_name ),
			'parent_item_colon' => __( 'Parent ' . $this->singular_name . ' :', $this->plugin_name ),
			'edit_item'         => __( 'Edit ' . $this->singular_name, $this->plugin_name ),
			'update_item'       => __( 'Update ' . $this->singular_name, $this->plugin_name ),
			'add_new_item'      => __( 'Add New ' . $this->singular_name, $this->plugin_name ),
			'new_item_name'     => __( 'New ' . $this->singular_name . ' Name', $this->plugin_name ),
			'menu_name'         => __( $this->taxonomy_name, $this->plugin_name ),
		);
		$args   = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $this->singular_name ),
		);
		register_taxonomy($this->singular_name, array($this->post_type_name), $args);
	}
}