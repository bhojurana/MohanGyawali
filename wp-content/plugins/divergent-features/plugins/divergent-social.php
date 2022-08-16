<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class dvsocial_Admin {

	/**
 	 * Option key, and option page slug
 	 * @var string
 	 */
	private $key = 'dvsocial_options';

	/**
 	 * Options page metabox id
 	 * @var string
 	 */
	private $metabox_id = 'dvsocial_option_metabox';

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
	 * Constructor
	 * @since 0.1.0
	 */
	public function __construct() {
		// Set our title
		$this->title = esc_attr__( 'Divergent - Social Icons', 'divergent' );
        $this->menutitle = esc_attr__( 'Social Icons', 'divergent' );
	}

	/**
	 * Initiate our hooks
	 * @since 0.1.0
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_init', array( $this, 'add_options_page_metabox' ) );
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
		$this->options_page = add_menu_page( $this->title, $this->menutitle, 'manage_options', $this->key, array( $this, 'admin_page_display' ), 'dashicons-twitter' );

		// Include CMB CSS in the head to avoid FOUT
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 * @since  0.1.0
	 */
	public function admin_page_display() {
		?>
    <div class="wrap cmb2-options-page <?php echo esc_attr__($this->key); ?>">
        <div id="divergent-social-wrapper">
                <h1 class="divergent-social-title"><span><?php echo esc_html( get_admin_page_title() ); ?></span></h1>
        <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
        </div>
    </div>
    <?php
	}

	/**
	 * Add the options metabox to the array of metaboxes
	 * @since  0.1.0
	 */
	function add_options_page_metabox() {
        $prefix = 'dv';

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

		// Set our CMB2 fields

		$cmb->add_field( array(
            'id' => $prefix . 'socialicons',
            'type' => 'group',
            'options' => array(
                'group_title'   => esc_attr__( 'Icon {#}', 'divergent' ),
                'add_button' => esc_attr__( 'Add Another Icon', 'divergent' ),
                'remove_button' => esc_attr__( 'Remove Icon', 'divergent' ),
                'sortable' => true,
                'closed' => true
            ),
            'fields' => array(
                array(
                    'name' => esc_attr__( 'Title:', 'divergent'),
                    'id' => $prefix . 'icontitle',
                    'type' => 'text'
                ),
                array(
                    'name' => esc_attr__( 'Select an icon', 'divergent'),
                    'id' => $prefix . 'iconimg',
                    'type' => 'egemenerd_fontawesome',
                    'default' => 'fas fa-twitter'
                ),
                array(
                    'name' => esc_attr__( 'Link:', 'divergent'),
                    'desc' => esc_attr__( 'Example; http://www.themeforest.net', 'divergent'),
                    'id' => $prefix . 'iconlink',
                    'type' => 'text'
                ),
            ),
        ));

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
 * Helper function to get/return the dvsocial_Admin object
 * @since  0.1.0
 * @return dvsocial_Admin object
 */
function dvsocial_admin() {
	static $object = null;
	if ( is_null( $object ) ) {
		$object = new dvsocial_Admin();
		$object->hooks();
	}

	return $object;
}

/**
 * Wrapper function around cmb2_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function dvsocial_get_option( $key = '' ) {
	return cmb2_get_option( dvsocial_admin()->key, $key );
}

// Get it started
dvsocial_admin();