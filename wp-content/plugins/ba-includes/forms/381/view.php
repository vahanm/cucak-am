<?php
render_table_begin();

render_group_sub(__('Garage'));

render_location('item_location', __('Garage location'));

render_value('address', __('Address'), '%s ' );

render_value('garage', __('Garage size'), __('for %s cars'), array(
	1 => __('for %s car')
));

render_table_end();
?>
