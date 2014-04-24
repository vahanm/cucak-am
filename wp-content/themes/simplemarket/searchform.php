<?php
/**
 * Search form
 *
 * @package SimpleMarket
 * @subpackage Template
 * @since SimpleMarket 1.0
 */

if (!is_search())
{
?>
<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
<?php 
//helper_location_combo('qlocationoeq', __('everywhere'));
?>
<select id="qlocationoeq" name="qlocationoeq" style="width: 200px;">
	<option value=""> <?php _e('everywhere') ?> </option>
	<?php
	
	$regions = getRegions();
	
	foreach ($regions as $key => $value) {
		/*?>
		<option value="<?php echo $key; ?>">
		<?php echo $value ?>
		</option>
		<?php*/
		echo '<option value="', $key, '">', $value, '</option>';
	}

?>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" defalutvalue="Type text to searh." />
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" />
</form>

<?php 
}
?>