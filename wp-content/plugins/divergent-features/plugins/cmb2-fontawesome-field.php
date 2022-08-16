<?php
class Egemenerd_Field_Fontawesome {

	public function egemenerd_cmb2_fontawesome_hooks() {
		add_filter( 'cmb2_render_egemenerd_fontawesome',  array( $this, 'egemenerd_fontawesome_field' ), 10, 5 );
	}

	public function egemenerd_fontawesome_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {

		// Only enqueue scripts if field is used.
		$this->egemenerd_cmb2_fontawesome_scripts();

		echo $field_type_object->input( array(
			'type'       => 'text',
			'class'      => 'form-control icp icp-auto',
			'value' => $field_escaped_value
		) );

		$field_type_object->_desc( true, true );
	}

	public function egemenerd_cmb2_fontawesome_scripts( ) {
        wp_enqueue_style('egemenerd_cmb2_field_bootstrap_css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', true, '3.7');
        wp_enqueue_style('egemenerd_cmb2_field_fontawesome_css', plugin_dir_url( __FILE__ ) . 'css/fontawesome.min.css', true, '5.0');
        wp_enqueue_style('egemenerd_cmb2_field_iconpicker_css', plugin_dir_url( __FILE__ ) . 'css/fontawesome-iconpicker.min.css', true, '1.0');
        wp_enqueue_script('egemenerd_cmb2_field_bootstrap_js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), '3.7', true );
        wp_enqueue_script('egemenerd_cmb2_field_fontawesome_js', plugin_dir_url( __FILE__ ) . 'js/fontawesome-iconpicker.min.js', array( 'jquery' ), '1.0', true );     
	}
}
$egemenerd_field_fontawesome = new Egemenerd_Field_Fontawesome();
$egemenerd_field_fontawesome->egemenerd_cmb2_fontawesome_hooks();
?>