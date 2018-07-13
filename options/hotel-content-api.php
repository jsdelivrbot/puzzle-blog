<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class Puzzle_Admin {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	protected $key = 'puzzle_options';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	protected $metabox_id = 'puzzle_option_metabox';

	/**
	 * Options Page title
	 * @var string
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

	/**
	 * Holds an instance of the object
	 *
	 * @var Myprefix_Admin
	 */
	protected static $instance = null;

	/**
	 * Returns the running object
	 *
	 * @return Myprefix_Admin
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
			self::$instance->hooks();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 * @since 0.1.0
	 */
	protected function __construct() {
		// Set our title
		$this->title = __( 'Puzzle API', 'puzzle' );
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}


	/**
	 * Register our setting to WP
	 * @since  0.1.0
	 */
	public function init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 * @since 0.1.0
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );

		// Include CMB CSS in the head to avoid FOUC
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo $this->key; ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {

		// hook in our save notices
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );

		global $wpdb;
	    $table_name = $wpdb->prefix . 'hotel_list';
	    $hotels = $wpdb->get_results( "SELECT * FROM $table_name" );
	    $temp = array();
	    foreach ($hotels as $key => $value) {
	        $temp[$value -> HotelCode] = $value -> HotelName;
	    }

		$cmb->add_field( array(
			'name'             => 'Oteller',
			'id'               => 'otel_select',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'custom',
			'options'          => $temp,
			'sanitization_cb'  => 'test_sn'
		) );

		$cmb->add_field( array(
			'name'             => 'Dil Seçimi',
			'id'               => 'otel_language_select',
			'type'             => 'select',
			'show_option_none' => false,
			'default'          => 'tr',
			'options'          => array(
				'tr' => __( 'Türkçe', 'puzzle' ),
				'en'   => __( 'İngilizce', 'puzzle' ),
				'ru'     => __( 'Rusça', 'puzzle' ),
			),
		) );

		$cmb->add_field( array(
			'name'    => 'Güncelleme Seçenekleri',
			'id'      => 'update_select',
			'type'    => 'multicheck',
			'options' => array(
				'mice_room' => 'Mice Otel Odalarını Güncelle',
				'hotel_detail' => 'Otel Detay Güncelle',
				'hotel_detail_room' => 'Oda Kodlarını Güncelle'
			),
		) );

		function test_sn($newval, $field_args, $field){
			global $value;
			global $response;
			$value = $newval;
			$args = $field_args['render_row_cb'][0] -> data_to_save;
			$lang = $args['otel_language_select'];
			$url = 'http://b2b.puzzletur.net/hotel/detail';
	        $params = array('hotels' => $value, 'language' => strtoupper($lang), 'market' => 'SMK_001');
	        $response = get_api_result($url,json_encode($params),false);
	        $response = $response -> returnObject;

	        require_once 'hotel-functions.php';

	        foreach ($args['update_select'] as $key => $item) {
	        	if($item === "mice_room") require_once 'mice-rooms.php';
	        	if($item === "hotel_detail") require_once 'hotel-details.php';
	        	if($item === "hotel_detail_room") require_once 'hotel-room-code-update.php';
	        }

	        exit();

	        require_once('hotel-details.php'); // $detail
	        require_once('hotel-rooms.php'); // $htl_rooms
	        require_once('hotel-concept.php'); // $htl_concept
	        require_once('hotel-room-code-update.php');


			//update_post_meta( $query[0]['post_id'], 'hotel_room_repeat_group', $htl_rooms);


			$slideid = addSlider($slider, $detail['title'].'- Genel');
			$post_id = wp_insert_post( $postarr, false );
			add_post_meta( $post_id, 'hotel_details_select', $slideid, true );
			add_post_meta( $post_id, 'hotel_details_code', $detail['hotelcode'], true );
			add_post_meta( $post_id, 'hotel_details_map', $detail['map'], true );
			wp_set_post_terms($post_id, $feature, 'hotel_feature');
			wp_set_post_terms($post_id, $location, 'hotel_locations');
			wp_redirect( get_permalink( $post_id ) );
			exit();
		}

	}

	/**
	 * Register settings notices for display
	 *
	 * @since  0.1.0
	 * @param  int   $object_id Option key
	 * @param  array $updated   Array of updated fields
	 * @return void
	 */
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'puzzle' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}

	/**
	 * Public getter method for retrieving protected/private variables
	 * @since  0.1.0
	 * @param  string  $field Field to retrieve
	 * @return mixed          Field value or exception is thrown
	 */
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

/**
 * Helper function to get/return the Myprefix_Admin object
 * @since  0.1.0
 * @return Myprefix_Admin object
 */
function puzzle_admin() {
	return Puzzle_Admin::get_instance();
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string $key     Options array key
 * @param  mixed  $default Optional default value
 * @return mixed           Option value
 */
function puzzle_get_option( $key = '', $default = null ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( puzzle_admin()->key, $key, $default );
	}

	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( puzzle_admin()->key, $key, $default );

	$val = $default;

	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}

	return $val;
}

// Get it started
puzzle_admin();
