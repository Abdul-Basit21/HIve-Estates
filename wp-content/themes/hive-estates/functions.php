<?php
/**
 * Hive Estates functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Hive_Estates
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hive_estates_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Hive Estates, use a find and replace
		* to change 'hive-estates' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'hive-estates', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'hive-estates' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'hive_estates_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'hive_estates_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hive_estates_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hive_estates_content_width', 640 );
}
add_action( 'after_setup_theme', 'hive_estates_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hive_estates_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'hive-estates' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'hive-estates' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'hive_estates_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hive_estates_scripts() {
	wp_enqueue_style( 'hive-estates-style', get_stylesheet_uri(), array(), _S_VERSION );


	wp_enqueue_style( 'hive-estates-remixIcon', 'https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css' , array(), _S_VERSION, 'all' );

	//custom ss files enque
	wp_enqueue_style( 'hive-estates-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' , array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'hive-estates-fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.all.min.css' , array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'hive-estates-owlCarousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' , array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'hive-estates-owlCarousel-Theme', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css' , array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'hive-estates-styles', get_template_directory_uri() . '/assets/css/style.css' , array(), _S_VERSION, 'all' );


	
	wp_style_add_data( 'hive-estates-style', 'rtl', 'replace' );

	wp_enqueue_script( 'hive-estates-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'hive-estates-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js' , array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'hive-estates-owlCarousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js' , array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'hive-estates-script', get_template_directory_uri() . '/assets/js/script.js' , array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'hive-estates-script', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js' , array('jquery'), _S_VERSION, true );
	





	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hive_estates_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Add a meta box to pages
function add_custom_class_meta_box() {
    add_meta_box(
        'custom_class_meta_box', // ID
        'Custom Body Class', // Title
        'display_custom_class_meta_box', // Callback function
        'page', // Post type (page)
        'side', // Context (side, normal, etc.)
        'high' // Priority
    );
}
add_action('add_meta_boxes', 'add_custom_class_meta_box');

// Display the meta box
function display_custom_class_meta_box($post) {
    $custom_class = get_post_meta($post->ID, '_custom_body_class', true);
    ?>
    <label for="custom_body_class">Enter Custom Class:</label>
    <input type="text" id="custom_body_class" name="custom_body_class" value="<?php echo esc_attr($custom_class); ?>" style="width: 100%;" />
    <?php
}

// Save the meta box data
function save_custom_class_meta_box($post_id) {
    // Check if the meta box field is set
    if (isset($_POST['custom_body_class'])) {
        update_post_meta($post_id, '_custom_body_class', sanitize_text_field($_POST['custom_body_class']));
    }
}
add_action('save_post', 'save_custom_class_meta_box');

function add_meta_custom_body_class($classes) {
    if (is_page()) {
        global $post;

        // Get the custom class from the post meta
        $custom_class = get_post_meta($post->ID, '_custom_body_class', true);

        if (!empty($custom_class)) {
            $classes[] = $custom_class; // Add the custom class to the body
        }
    }
    return $classes;
}
add_filter('body_class', 'add_meta_custom_body_class');
