<table class="bawlu form-table">
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Icons', 'baw_lu' ); ?></h3></th>
    <td>
      <p><label><input type="radio" name="bawlu_iconset" id="bawlu_iconset" value="" <?php checked( get_option( 'bawlu_iconset' ), '' ); ?> /> Aucune</p>
      <?php
      $path = dirname( __FILE__ ) . '/../images/ico/*.png';
      foreach ( glob( $path ) as $file ) {
        $file = pathinfo( $file, PATHINFO_FILENAME );
        echo '<p class="bawlu_pics"><label><input type="radio" name="bawlu_iconset" id="bawlu_iconset" value="' . $file . '" ' . checked( get_option( 'bawlu_iconset' ), $file, false ) . '/> ' . $file . ' : ';
        echo '<img src="' . BAWLU_IMAGES_URL . 'ico/' . $file . '.png" /></label></p>';
      }
      ?>
      <em><?php _e('Pictures are in', 'baw_lu'); ?> <strong><?php echo BAWLU_IMAGES_URL; ?>ico/</strong><br /><?php _e('It must be <strong>*.png</strong> format.', 'baw_lu'); ?></em>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"><h3><?php _e( 'Backgrounds', 'baw_lu' ); ?></h3></th>
    <td>
      <p><label><input type="radio" name="bawlu_bgset" id="bawlu_bgset" value="" <?php checked( get_option( 'bawlu_bgset' ), '' ); ?> /> Aucun</p>
      <?php
      $path = dirname( __FILE__ ) . '/../images/bg/*.png';
      foreach ( glob( $path ) as $file ) {
        $file = pathinfo( $file, PATHINFO_FILENAME );
        echo '<p><label><input type="radio" name="bawlu_bgset" id="bawlu_bgset" value="' . $file . '" ' . checked( get_option( 'bawlu_bgset' ), $file, false ) . '/> ' . $file . ' : ';
        echo '<br /><img src="' . BAWLU_IMAGES_URL . 'bg/' . $file . '.png" /></label></p>';
      }
      ?>
      <em><?php _e('Pictures are in', 'baw_lu'); ?> <strong><?php echo BAWLU_IMAGES_URL; ?>bg/</strong><br /><?php _e('It must be <strong>*.png</strong> format.', 'baw_lu'); ?></em>
    </td>
    </tr>
</table>
