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









/*
render_check('tags', __('Tags'),  array( 
	array('tagabstract', __('tagabstract')),
	array('tagbuilding', __('tagbuilding')),
	array('tagmodel', __('tagmodel')),
	array('tagtattoos', __('tagtattoos')),
	array('tagarchitecture', __('tagarchitecture')),
	array('taghealth', __('taghealth')),
	array('tagmonument', __('tagmonument')),
	array('tagphones', __('tagphones')),
	array('tagexibition', __('tagexibition')),
	array('tagcaricature', __('tagcaricature')),
	array('taglandscape', __('taglandscape')),
	array('tagdevices', __('tagdevices')),
	array('taggallery', __('taggallery')),
	array('tagcatalog', __('tagcatalog')),
	array('tagportrait', __('tagportrait')),
	array('tagfantasy', __('tagfantasy')),
	array('tagurbanimages', __('tagurbanimages')),
	array('tagcollage', __('tagcollage')),
	array('tagcampaign', __('tagcampaign')),
	array('tagphotosession', __('tagphotosession')),
	array('taggraphics', __('taggraphics')),
	array('taglogo', __('taglogo')),
	array('tagentertainment', __('tagentertainment')),
	array('tagfruits', __('tagfruits')),
	array('taggroup picture', __('taggroup picture')),
	array('tagmachinery', __('tagmachinery')),
	array('tagsculpture', __('tagsculpture')),
	array('tagdigitalediting', __('tagdigitalediting')),
	array('tagchildren', __('tagchildren')),
	array('tagfurniture', __('tagfurniture')),
	array('tagevents', __('tagevents')),
	array('tagblackandwhite', __('tagblackandwhite')),
	array('tagfoodsweets', __('tagfoodsweets')),
	array('tagmenu', __('tagmenu')),
	array('tagstreetart', __('tagstreetart')),
	array('tagsketch', __('tagsketch')),
	array('taganimals', __('taganimals')),
	array('tagstilllife', __('tagstilllife'))));
*/


render_table_end();

