<?php
/**
 * Register the Book Information metabox
*/

namespace IsaacBookstore\includes;

if ( ! defined( 'ABSPATH' ) ) exit;

class Metabox {
    public $plugin_name;

	public function __construct($plugin_name) {
        $this->plugin_name = $plugin_name;
	}

	public function run() {
        $this->add_action( 'add_meta_boxes', array( &$this, 'meta_fields_add_meta_box' ) );
        $this->add_action( 'save_post', array( &$this, 'meta_fields_save_meta_box_data' ) );
	}

	function add_action( $action, $function, $priority = 10, $accepted_args = 1 ) {
        add_action( $action, $function, $priority, $accepted_args );
    }

	public function render_metabox($post)
	{
		wp_nonce_field( 'meta_fields_save_meta_box_data', 'meta_fields_meta_box_nonce' );
		$author = get_post_meta( $post->ID, '_meta_fields_book_author', true );
		$isbn = get_post_meta( $post->ID, '_meta_fields_book_isbn', true );
		$price = get_post_meta( $post->ID, '_meta_fields_book_price', true );
		echo '<div class="inside">
			<p><strong>Author</strong></p>
			<p><input type="text" id="meta_fields_book_author" name="meta_fields_book_author" value="'. esc_attr( $author ).'" /></p>
			<p><strong>ISBN</strong></p>
			<p><input type="text" id="meta_fields_book_isbn" name="meta_fields_book_isbn" value="'. esc_attr( $isbn ).'" /></p>
			<p><strong>Price</strong></p>
			<p><input type="text" id="meta_fields_book_price" name="meta_fields_book_price" value="'. esc_attr( $price ).'" /></p>
		</div>';
	}
	function meta_fields_save_meta_box_data( $post_id ) {
		if ( ! isset( $_POST['meta_fields_meta_box_nonce'] ) )
			return;
		if ( ! wp_verify_nonce( $_POST['meta_fields_meta_box_nonce'], 'meta_fields_save_meta_box_data' ) )
			return;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;
	
		if ( ! isset( $_POST['meta_fields_book_author'] ) )
			return;
		if ( ! isset( $_POST['meta_fields_book_isbn'] ) )
			return;
		if ( ! isset( $_POST['meta_fields_book_price'] ) )
			return;
	
		$author = sanitize_text_field( $_POST['meta_fields_book_author'] );
		$isbn = sanitize_text_field( $_POST['meta_fields_book_isbn'] );
		$price = sanitize_text_field( $_POST['meta_fields_book_price'] );
	
		update_post_meta( $post_id, '_meta_fields_book_author', $author );
		update_post_meta( $post_id, '_meta_fields_book_isbn', $isbn );
		update_post_meta( $post_id, '_meta_fields_book_price', $price );
	}

	function meta_fields_add_meta_box() {
		add_meta_box(
			'book_meta_data',
			'Book Meta Information',
			array( $this, 'render_metabox' ),
			'book',
		);
	}
}