<?php

class My_Custom_Field_Htmlcode extends SiteOrigin_Widget_Field_Text_Input_Base{

	protected function render_field( $value, $instance ) {
		?>
		<textarea type="text" name="<?php echo esc_attr( $this->element_name ) ?>" id="<?php echo esc_attr( $this->element_id ) ?>"
			<?php if ( ! empty( $this->placeholder ) ) echo 'placeholder="' . esc_attr( $this->placeholder ) . '"' ?>
			<?php $this->render_CSS_classes( $this->get_input_classes() ) ?>
			      rows="<?php echo ! empty( $this->rows ) ? intval( $this->rows ) : 15 ?>"
			<?php if( ! empty( $this->readonly ) ) echo 'readonly' ?>><?php echo esc_attr( $value ) ?></textarea>
		<?php
	}

	protected function sanitize_field_input( $value, $instance ) {
		$sanitize_value = preg_replace('/(<(style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $value);

		return $sanitize_value;
	}
}