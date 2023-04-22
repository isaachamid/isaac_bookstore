<?php
/**
 * Registers the Book post type
*/

namespace IsaacBookstore\includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class PostType {
    public $name;
    public $singular_name;
    public $plugin_name;
	public function __construct($post_type_name, $singular_name, $plugin_name) {
        $this->name = $post_type_name;
        $this->singular_name = $singular_name;
        $this->plugin_name = $plugin_name;
	}

	public function run() {
        $this->add_action('init', array( &$this, 'register_post_type'));
	}

    function add_action($action, $function, $priority = 10, $accepted_args = 1) {
        // Pass variables into WordPress add_action function
        add_action( $action, $function, $priority, $accepted_args );
    }

    function register_post_type() {
        // Default labels.
        $labels = array(
            'name'           => _x( $this->name, 'post type general name', $this->plugin_name ),
            'singular_name'  => _x( $this->singular_name, 'post type singular name', $this->plugin_name ),
            'menu_name'      => _x( $this->name, 'admin menu', $this->plugin_name ),
            'name_admin_bar' => _x( $this->singular_name, 'add new on admin bar', $this->plugin_name ),
            'add_new'        => _x( 'Add New', $this->singular_name, $this->plugin_name ),
            'add_new_item'   => __( 'Add New ' . $this->singular_name, $this->plugin_name ),
            'new_item'       => __( 'New ' . $this->singular_name, $this->plugin_name ),
            'edit_item'      => __( 'Edit ' . $this->singular_name, $this->plugin_name ),
            'view_item'      => __( 'View ' . $this->singular_name, $this->plugin_name ),
            'all_items'      => __( 'All ' . $this->name, $this->plugin_name ),
        );
        $args   = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $this->singular_name ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'comments' )
        );
        // Check that the post type doesn't already exist.
        if (! post_type_exists($this->name)) {
            // Register the post type.
			register_post_type($this->singular_name, $args);
        }
    }
}