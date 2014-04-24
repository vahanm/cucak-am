<?php
///////////////////////////////////////////////////////////////////////
render_table_begin();
///////////////////////////////////////////////////////////////////////

//render_group_sub(__('General'));

render_group_sub(__('Description'));

render_item_status();


render_location('item_location', __('Item location'));




render_check('flcomponents', __('Components'),  array( 
    array('flower', __('flower')),
    array('candle', __('candle')),
    array('orplant', __('ornamental plant')),
    array('toy', __('toy')),
    array('colribbon', __('colored ribbon')),
    array('sweets', __('sweets')),
    array('basket', __('basket')),
    array('beverage', __('beverage'))
    ));



render_value('lifetime', __('Lifetime'), 'Error', array(
    10 =>  __('about one week'), 
    20 =>  __('about two weeks'),
    30 =>  __('about one month'),
    40 =>  __('unlimited')
    ));



///////////////////////////////////////////////////////////////////////
render_table_end();
///////////////////////////////////////////////////////////////////////

?>
