<?php

//$my_excerpt = json_decode(get_the_excerpt(), True);
//
//$pcont = '';

//$pcont .= '<div style="float:right;">' . cur_ConvertedString($my_excerpt['post_price_sale'] . ' ' . $my_excerpt['post_currency']) . '</div>';

//$pcont .= '<div style="width: 60%; float: left; margin: 5px; margin-bottom: 30px; padding: 5px;">';
//
//$pcont .= 'Name: <a href="?author=' . $my_excerpt["post_userid"] . '">' . $my_excerpt["post_aname"] . '</a><br/>';
//$pcont .= 'Phone: <a href="callto:' . $my_excerpt["post_phone"] . '">' . $my_excerpt["post_phone"] . '</a><br/>';
//$pcont .= 'E-Mail: <a href="mailto:' . $my_excerpt["post_aemail"] . '">' . $my_excerpt["post_aemail"] . '</a><br/>';
//
//$pcont .= 'Price: ' . cur_Format($my_excerpt['post_price_sale'] . ' ' . $my_excerpt['post_currency']);
//
//$pcont .= '</div>';

//echo $pcont;

render_table_begin();

render_group_sub(__('General'));

render_item_status();


render_location('item_location', __('Item location'));


render_value('item_condition', __('Item condition'), 'Error', array(
	1 => __('new'), 
	2 => __('used'), 
	3 => __('broken'), 
	4 => __('other')
	));



render_table_end();

