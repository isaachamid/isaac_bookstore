<?php

/**
 * Registers Genre And Author taxonomy to the Book post type
 */
namespace IsaacBookstore\includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Taxonomies {
    public $plugin_name;

	public function __construct($plugin_name) {
        $this->plugin_name = $plugin_name;
	}
	public function run() {
        $this->add_action( 'init', array( &$this, 'register_genres' ) );
        $this->add_action( 'init', array( &$this, 'register_author' ) );
	}
	function add_action( $action, $function, $priority = 10, $accepted_args = 1 ) {
        add_action( $action, $function, $priority, $accepted_args );
    }
	function register_genres() {
		$labels = array(
			'name'              => _x( 'Genres', 'taxonomy general name', $this->plugin_name ),
			'singular_name'     => _x( 'Genre', 'taxonomy singular name', $this->plugin_name ),
			'search_items'      => __( 'Search Genres', $this->plugin_name ),
			'all_items'         => __( 'All Genres', $this->plugin_name ),
			'parent_item'       => __( 'Parent Genre', $this->plugin_name ),
			'parent_item_colon' => __( 'Parent Genre:', $this->plugin_name ),
			'edit_item'         => __( 'Edit Genre', $this->plugin_name ),
			'update_item'       => __( 'Update Genre', $this->plugin_name ),
			'add_new_item'      => __( 'Add New Genre', $this->plugin_name ),
			'new_item_name'     => __( 'New Genre Name', $this->plugin_name ),
			'menu_name'         => __( 'Genres', $this->plugin_name ),
		);
		$args   = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'genre' ),
		);
		register_taxonomy( 'genre', array( 'book' ), $args );
	}
	function register_author() {
		$labels = array(
			'name'              => _x( 'Authors', 'taxonomy general name', $this->plugin_name ),
			'singular_name'     => _x( 'Author', 'taxonomy singular name', $this->plugin_name ),
			'search_items'      => __( 'Search Authors', $this->plugin_name ),
			'all_items'         => __( 'All Authors', $this->plugin_name ),
			'parent_item'       => __( 'Parent Author', $this->plugin_name ),
			'parent_item_colon' => __( 'Parent Author:', $this->plugin_name ),
			'edit_item'         => __( 'Edit Author', $this->plugin_name ),
			'update_item'       => __( 'Update Author', $this->plugin_name ),
			'add_new_item'      => __( 'Add New Author', $this->plugin_name ),
			'new_item_name'     => __( 'New Author Name', $this->plugin_name ),
			'menu_name'         => __( 'Authors', $this->plugin_name ),
		);
		$args   = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'author' ),
		);
		register_taxonomy( 'author', array( 'book' ), $args );
	}
}