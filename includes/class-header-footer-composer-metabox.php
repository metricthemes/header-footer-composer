<?php
/**
 * The file that registers the plugin's metabox
 *
 * @link       https://metricthemes.com
 * @since      1.0.0
 *
 * @package    Header_Footer_Composer
 * @subpackage Header_Footer_Composer/includes
 * @since      1.0.0
 * @author     MetricThemes <support@metricthemes.com>
 * 
 */
 
class Header_Footer_Composer_Meta_Box {

		public function block_type_get_meta( $value ) {
			global $post;
		
			$field = get_post_meta( $post->ID, $value, true );
			if ( ! empty( $field ) ) {
				return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
			} else {
				return false;
			}
		}
		
		public function block_type_add_meta_box() {
			add_meta_box(
				'block_type-block-type',
				__( 'Block Type', 'block_type' ),
				array( $this, 'block_type_html'),
				'mnk_block',
				'normal',
				'high'
			);
		}
				
		
		public function block_type_html( $post) {
			wp_nonce_field( '_block_type_nonce', 'block_type_nonce' ); ?>
		
			<p>
				<label for="block_type_choose_block_type"><?php _e( 'Choose Block type', 'block_type' ); ?></label><br>
				<select name="block_type_choose_block_type" id="block_type_choose_block_type">
					<option value="" <?php echo (array( $this, 'block_type_get_meta')( 'block_type_choose_block_type' ) === '' ) ? 'selected' : '' ?>>Select Block Type</option>
					<option value="header" <?php echo (array( $this, 'block_type_get_meta')( 'block_type_choose_block_type' ) === 'header' ) ? 'selected' : '' ?>>Header</option>
					<option value="footer" <?php echo (array( $this, 'block_type_get_meta')( 'block_type_choose_block_type' ) === 'footer' ) ? 'selected' : '' ?>>Footer</option>
					<option value="custom" <?php echo (array( $this, 'block_type_get_meta')( 'block_type_choose_block_type' ) === 'custom' ) ? 'selected' : '' ?>>Custom Section</option>
				</select>
			</p><?php
		}
		
		public function block_type_save( $post_id ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
			if ( ! isset( $_POST['block_type_nonce'] ) || ! wp_verify_nonce( $_POST['block_type_nonce'], '_block_type_nonce' ) ) return;
			if ( ! current_user_can( 'edit_post', $post_id ) ) return;	
		
			if ( isset( $_POST['block_type_choose_block_type'] ) )
				update_post_meta( $post_id, 'block_type_choose_block_type', esc_attr( $_POST['block_type_choose_block_type'] ) );
		}
		
		
}		