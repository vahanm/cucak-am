<?php
///////////////////////////////////////////////////////////////////////
render_table_begin();
///////////////////////////////////////////////////////////////////////

//render_group_sub(__('General'));

render_group_sub(__('Description'));

render_item_status();


render_location('item_location', __('Item location'));


render_value('item_condition', __('Item condition'), 'Error', array(
    1 => __('new'), 
    2 => __('used'), 
    3 => __('broken'), 
    4 => __('other')
    ));



///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
