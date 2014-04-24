<table class="bawlu form-table">
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Member access only', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_memberaccess" id="bawlu_memberaccess" <?php checked( get_option( 'bawlu_memberaccess' ), 'on' ); ?> /> <?php _e('Only members can vote like/unlike.', 'baw_lu'); ?></label>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Always log by I.P.', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_logbyip" id="bawlu_memberaccess" <?php checked( get_option( 'bawlu_logbyip' ), 'on' ); ?> /> <?php _e('Even if only members can vote, IP address will be used to log instead of user ID.', 'baw_lu'); ?></label>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Use only one button', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_onebutton" id="bawlu_onebutton" <?php checked( get_option( 'bawlu_onebutton' ), 'on' ); ?> /> <?php _e('Yes i only want the "Like" button.', 'baw_lu'); ?></label>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Show values', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_showvalue" id="bawlu_showvalue" <?php checked( get_option( 'bawlu_showvalue' ), 'on' ); ?> /> <?php _e('Yes i want to show how many time each button have been clicked.', 'baw_lu'); ?></label><br />
      <em><?php _e('Show in the text the clics value, example : [ I like (10) ]', 'baw_lu'); ?></em>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Show in pages', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="checkbox" name="bawlu_alsopage" id="bawlu_alsopage" <?php checked( get_option( 'bawlu_alsopage' ), 'on' ); ?> /> <?php _e('Yes i want to show my buttons in <strong>pages</strong> too.', 'baw_lu'); ?></label><br />
      <em><?php _e('Even if unchecked, buttons will be displayed for posts, always.', 'baw_lu'); ?></em>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Buttons alignement', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="radio" name="bawlu_alignment" id="bawlu_alignment" value="left" <?php checked( get_option( 'bawlu_alignment' ), 'left' ); ?> /> <?php _e('I want to align button on the <strong>left</strong>.', 'baw_lu'); ?></label><br />
      <label><input type="radio" name="bawlu_alignment" id="bawlu_alignment" value="right" <?php checked( get_option( 'bawlu_alignment' ), 'right' ); ?> /> <?php _e('I want to align button on the <strong>right</strong>.', 'baw_lu'); ?></label>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Display buttons ?', 'baw_lu' ); ?></h3></th>
    <td>
      <label><input type="radio" name="bawlu_showwhere" id="bawlu_showwhere" value="dessus" <?php checked( get_option( 'bawlu_showwhere' ), 'dessus' ); ?> /> <?php _e('I want to show buttons <strong>above</strong> content.', 'baw_lu'); ?></label><br />
      <label><input type="radio" name="bawlu_showwhere" id="bawlu_showwhere" value="dessous" <?php checked( get_option( 'bawlu_showwhere' ), 'dessous' ); ?> /> <?php _e('I want to show buttons <strong>below</strong> content.', 'baw_lu'); ?></label><br />
      <label><input type="radio" name="bawlu_showwhere" id="bawlu_showwhere" value="manuel" <?php checked( get_option( 'bawlu_showwhere' ), 'manuel' ); ?> /> <?php _e('I want to show buttons with <strong>shortcodes</strong>.', 'baw_lu'); ?><sup>(1)</sup></label><br />
      <sup>1</sup> <code>[bawlu_buttons], [bawlu_counter]</code>
    </td>
    </tr>
</table>
