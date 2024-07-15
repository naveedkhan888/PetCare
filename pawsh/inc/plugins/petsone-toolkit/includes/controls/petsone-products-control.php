<?php
/**
 * Elementor petsone-products control.
 *
 * A control for displaying a select field with the ability to choose currencies.
 *
 * @since 1.0.0
 */
class Elementor_Petsone_Products_Control extends \Elementor\Base_Data_Control {

	/**
	 * Get petsone-products control type.
	 *
	 * Retrieve the control type, in this case `petsone-products`.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Control type.
	 */
	public function get_type() {
		return 'petsone-products';
	}


	/**
	 * Render petsone-products control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
	}

}