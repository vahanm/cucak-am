<table class="bawlu form-table">
    <tr valign="top">
    <th scope="row"><h3><?php _e( '"I like" text', 'baw_lu' ); ?></h3></th>
    <td>
      <input type="text" size="25" name="bawlu_textlike" id="bawlu_textlike" value="<?php echo esc_attr( get_option( 'bawlu_textlike' ) ); ?>" />
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( '"I unlike" text', 'baw_lu' ); ?></h3></th>
    <td>
      <input type="text" size="25" name="bawlu_textunlike" id="bawlu_textunlike" value="<?php echo esc_attr( get_option( 'bawlu_textunlike' ) ); ?>" />
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Text if user is not connected', 'baw_lu' ); ?></h3></th>
    <td>
      <input type="text" size="60" name="bawlu_textneedlogin" id="bawlu_textneedlogin" value="<?php echo esc_attr( get_option( 'bawlu_textneedlogin' ) ); ?>" /><br />
      <em><?php _e( 'Use {connection} to add a Connection link and {registration} to add a Registration link.', 'baw_lu' ); ?></em>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Text for error cases', 'baw_lu' ); ?></h3></th>
    <td>
      <input type="text" size="60" name="bawlu_texterror" id="bawlu_texterror" value="<?php echo esc_attr( get_option( 'bawlu_texterror' ) ); ?>" />
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Text to cancel a vote', 'baw_lu' ); ?></h3></th>
    <td>
      <input type="text" size="60" name="bawlu_textcancel" id="bawlu_textcancel" value="<?php echo esc_attr( get_option( 'bawlu_textcancel' ) ); ?>" />
    </td>
    </tr>
</table>
