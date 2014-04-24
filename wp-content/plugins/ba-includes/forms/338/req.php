<?php
function get_form_errors()
{
	$error = '';
	
	///////////////////////////////////////////////////////////////////////////////////
	
	//require_length_min('id', min, 'message')
	//require_length_max('id', max, 'message')
	
	$error .= require_price();

	$error .= require_selection('item_location', __('Please select the item location.'));

	$error .= require_selection('item_condition', __('Please select the item condition.'));

	
	$error .= require_oneof(
		require_length_min('furnituremodel', 2, __('Model is invalid.')),
		require_length_max('furnituremodel', 30, _t('Model must be contents %s chars maximum.',30))
		);

	
    $error .= require_selection_of('furnituretype', 4,  array(
        'kitchen',
        'diningroom',
        'livingroom',
        'bedroom',
        'bathroom',
        'office',
        'outdoorfurniture',
        'storehouse',
        'exposition',
        'other'
        ), _t('Max %s furniture types should be selected.', 4)
		);

	
    $error .= require_selection_of('usedmaterials', 6,  array(
        'naturalwood',
        'woodchipboard',
        'laminat',
        'fibreboard',
        'mdf',
        'pvc',
        'plastic',
        'tamburat',
        'leather',
        'glass',
        'mirror',
        'metal',
        'naturalstone',
        'artificialstone', 
        'other'
        ), _t('Max %s types of used materials should be selected.', 6)
		);



    $error .= require_selection_of('piecesoffurniture', 8,  array(
        'tabouret',
        'chair',
        'computerchair',
        'rockingchair',
        'couch',
        'armchair',
        'sofa',
        'bed',
        'table',
        'coffeetable',
        'computertable',
        'pierglass',
        'wardrobe',
        'secretaire',
        'bookcase',
        'bedsidetable',
        'cupboard',
        'sideboard',
        'inflatablefurniture',
        'chandelier',
        'hanger',
        'pillow',
        'blind',
        'carpet',
        'other'
        ), _t('Max %s pieces of furniture should be selected.', 8)
		);
	//$error .= require_selection_of_one('yndhanur_anuny', array('entaanun1', 'entaanun2', 'entaanun3'), __('inch gri ete vochmeky nshac chi'));


	///////////////////////////////////////////////////////////////////////////////////

	return $error;
}
?>
