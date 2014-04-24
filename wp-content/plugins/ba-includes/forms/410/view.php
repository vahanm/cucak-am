<?php
///////////////////////////////////////////////////////////////////////
render_table_begin();
///////////////////////////////////////////////////////////////////////

//render_group_sub(__('General'));

render_group_sub(__('Description'));

render_item_status();


render_location('item_location', __('Item location'));




render_value('headsize', __('Head size'), __('%s cm'));

render_value('sizeaperture', __('Final size of the aperture'), __('%s cm'));

render_value('stemlength', __('Stem length'), __('%s cm'));

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
