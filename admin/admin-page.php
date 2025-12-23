<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function operations_bridges_admin_page() {
    ?>
    <div class="wrap">
        <h1>Operations Bridges</h1>

        <form method="post" action="options.php">
            <?php settings_fields( 'operations_bridges' ); ?>

            <table class="form-table">

                <tr>
                    <th>Enable</th>
                    <td>
                        <label class="ob-switch">
                          <input type="checkbox" name="ob_enabled" value="1" <?php checked( 1, get_option( 'ob_enabled' ) ); ?>>
                          <span class="ob-slider"></span>
                       </label>
                    </td>
                </tr>

                <tr>
                    <th>Image</th>
                    <td>
                        <input type="hidden" id="ob_image_id" name="ob_image_id" value="<?php echo esc_attr( get_option( 'ob_image_id' ) ); ?>">
                        <button type="button" class="button" id="ob_image_button">Select Image</button>
                        <div id="ob_image_preview" style="margin-top:10px;">
                            <?php
                            if ( $id = get_option( 'ob_image_id' ) ) {
                                echo wp_get_attachment_image( $id, 'medium' );
                            }
                            ?>
                        </div>
                    </td>
                </tr>

		<?php
			$birth_year = get_option( 'ob_birth_date' );
			$death_year = get_option( 'ob_death_date' );

			// Ensure only year is displayed
			$birth_year = substr($birth_year, -4);
	        	$death_year = substr($death_year, -4);
		?>

		<tr>
			<th>Date of Birth</th>
			<td class="ob-date-field">
			        <input type="text" class="ob-yearpicker" name="ob_birth_date" value="<?php echo esc_attr( $birth_year ); ?>" readonly>
				<span class="dashicons dashicons-calendar-alt ob-calendar-icon"></span>
			</td>	
		</tr>

		<tr>
			<th>Date of Death</th>
			<td class="ob-date-field">
				<input type="text" class="ob-yearpicker" name="ob_death_date" value="<?php echo esc_attr( $death_year ); ?>" readonly>
				<span class="dashicons dashicons-calendar-alt ob-calendar-icon"></span>
			</td>
		</tr>

            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
