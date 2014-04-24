<table class="bawlu form-table">
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Button background color', 'baw_lu' ); ?></h3></th>
    <td>
      #<input type="text" size="6" name="bawlu_colbg" id="bawlu_colbg" maxlength="6" value="<?php echo esc_attr( get_option( 'bawlu_colbg' ) ); ?>" />
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Button text color', 'baw_lu' ); ?></h3></th>
    <td>
      #<input type="text" size="6" name="bawlu_coltext" id="bawlu_coltext" maxlength="6" value="<?php echo esc_attr( get_option( 'bawlu_coltext' ) ); ?>" /><br />
      <em><?php _e('If empty, color will be the one from website\'s CSS.', 'baw_lu'); ?></em>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Font name', 'baw_lu' ); ?></h3></th>
    <td>
      <input type="text" size="20" name="bawlu_fontname" id="bawlu_fontname" value="<?php echo esc_attr( get_option( 'bawlu_fontname' ) ); ?>" /><br />
      <em><?php _e('Can be a list, separated by commas.', 'baw_lu'); ?></em>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Bold font', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_fontbold" id="bawlu_fontbold" <?php checked( get_option( 'bawlu_fontbold' ), 'on' ); ?> /> <?php _e('Yes i want a <strong>bold</strong> font.', 'baw_lu'); ?></label>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Italic font', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_fontital" id="bawlu_fontital" <?php checked( get_option( 'bawlu_fontital' ), 'on' ); ?> /> <?php _e('Yes i want an <em>italic</em> font.', 'baw_lu'); ?></label>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Font size', 'baw_lu' ); ?></h3></th>
    <td>
      <input type="text" size="2" name="bawlu_fontsize" id="bawlu_fontsize" maxlength="2" value="<?php echo (int)get_option( 'bawlu_fontsize' ); ?>" />px<br />
      <em><?php _e('Take care, test the new size of the font in comparison to background image size.', 'baw_lu'); ?></em>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Underline links', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_fontuline" id="bawlu_fontuline" <?php checked( get_option( 'bawlu_fontuline' ), 'on' ); ?> /> <?php _e('Yes i want to underline links.', 'baw_lu'); ?></label><br />
      <em><?php _e('Can be usefull is there is no icon and background.', 'baw_lu'); ?></em>
    </td>
    </tr>
</table>
