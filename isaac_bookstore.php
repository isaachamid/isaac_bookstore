<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://github.com/isaachamid/isaac_bookstore
 * @since             1.0.0
 * @package           Isaac_bookstore
 *
 * @wordpress-plugin
 * Plugin Name:       isaac_bookstore
 * Plugin URI:        https://github.com/isaachamid
 * Description:       Wordpress Plugin Book Store With Custom Taxonomy
 * Version:           1.0.0
 * Author:            Isaac
 * Author URI:        https://github.com/isaachamid/isaac_bookstore
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       isaac_bookstore
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ ."/src/includes/Functions.php";
require_once __DIR__ . '/vendor/autoload.php';

use IsaacBookstore\includes\Activator;
use IsaacBookstore\includes\DeActivator;
use IsaacBookstore\includes\PostType;
use IsaacBookstore\includes\Taxonomy;
use IsaacBookstore\includes\Metabox;
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ISAAC_BOOKSTORE_VERSION', '1.0.0' );

if ( ! class_exists( 'Plugin' ) ) :

class Plugin {

    private static $instance;

    private function __construct() {

        define('ISAAC_BOOK_STORE_NAME', 'isaac_bookstore');

        register_activation_hook(
            __FILE__,
            array( $this, 'activate' )
        );

        register_deactivation_hook(
            __FILE__,
            array( $this, 'deactivate' )
        );

        self::Main();
    }


    public static function Main() {
        // Registers the Book post type
        $postType = new PostType('Books', 'Book', ISAAC_BOOK_STORE_NAME);
        $postType->run();
        // Registers Genre taxonomy to the Book post type
        $genre = new Taxonomy('Genres', 'Genre', 'book', ISAAC_BOOK_STORE_NAME);
        $genre->run();
        // Registers Author taxonomy to the Book post type
        $author = new Taxonomy('Authors', 'Author', 'book', ISAAC_BOOK_STORE_NAME);
        $author->run();
        // Registers the Book Information metabox
        $metabox = new Metabox(ISAAC_BOOK_STORE_NAME);
        $metabox->run();
    }


    public static function instance() {
        if ( is_null( ( self::$instance ) ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function activate() {
         Activator::activate();
    }


    public function deactivate() {
       DeActivator::deActivate();
    }
}

endif;
Plugin::instance();