<?php


filter_item_status();


filter_location(array(
  'id'			=>	'item_location'
, 'title' 		=>	__('Item location')
, 'priority'	=> PRIMARY_FILTER
));




filter_select(array(
	'id'			=>'item_condition'
	, 'title'		=>__('Item condition')
	, 'values'		=>array( 
				array(1, __('new')),  
				array(2, __('used')),  
				array(3, __('broken')) 
				)
			, priority => PRIMARY_FILTER
			));


//filter_text("hddmodel", __('HDD model'), __('Please enter desired model.'));

filter_select(array(
'id'			=>'form_factor'
, 'title'		=>__('Form factor')
, 'values'		=>array( 
	array(1, '1.8"'),  
	array(2, '2.5"'),  
	array(3, '3.5"')
	)
, priority => PRIMARY_FILTER
	));




filter_select(array(
'id'			=>'interface'
, 'title'		=>__('Interface type')
, 'values'		=>array( 			
	array(1, 'ATA/IDE (133MB/s)'),  
	array(2, 'SATA-1 (1.5GB/s)'),     
	array(3, 'SATA-2 (3GB/s)'), 
	array(4, 'SATA-3 (6GB/s)'),
	array(5, 'SAS (6GB/s)'),     
	array(6, 'Fibre Channel (4GB/s)'), 
	array(7, 'SCSI (Ultra 320)'),
	array(8, __('other'))
)
, priority => PRIMARY_FILTER
	));




filter_slider_by_list(array(
  'id'			=>'hddmemorysize'
, 'title'		=>__('Memory size')
, 'min'			=>1
, 'max'			=>34
, 'format'		=>__('%1 - %2')
, 'text'		=>'%s GB'
, 'listItems'	=>array(
	21 => '40 ' . 'GB', 
	22 => '80 ' . 'GB', 
	23 => '120 ' . 'GB', 
	24 => '160 ' . 'GB', 
	25 =>  '250 ' . 'GB',
	26 =>  '320 ' . 'GB',
	27 =>  '500 ' . 'GB',
	28 =>  '640 ' . 'GB',
	29 =>  '750 ' . 'GB',
	30 =>  '1 ' . 'TB',
	31 =>  '1.5 ' . 'TB',
	32 =>  '2 ' . 'TB',
	33 =>  '3'  . 'TB',
	34 =>  '4'  . 'TB'
	)
, 'begin'		=>'1 ' . 'GB'
, 'end'			=>'4 ' . 'TB'
, 'priority'	=>	PRIMARY_FILTER
	));






filter_slider_by_list2('rotational_speed', __('Rotational speed'), 1,5, __('%1 - %2'), '%s RPM', array(
	1 => '4800 ' . 'RPM', 
	2 => '5400 ' . 'RPM', 
	3 => '7200 ' . 'RPM', 
	4 => '10000 ' . 'RPM', 
	5 => '15000 ' . 'RPM', 
	), '4800 ' . 'RPM', '15000 ' . 'RPM');



filter_slider_by_list2('cache', __('Cache size'), 1,10, __('%1 - %2'), '%s MB', array(
	1 => '512 ' . 'KB', 
	2 => '1 ' . 'MB', 
	3 => '2 ' . 'MB', 
	4 => '4 ' . 'MB', 
	5 => '8 ' . 'MB', 
	6 => '16 ' . 'MB', 
	7 => '32 ' . 'MB', 
	8 => '64 ' . 'MB', 
	9 => '128 ' . 'MB', 
	10 => '256 ' . 'MB', 
	), '512 ' . 'KB', '256 ' . 'MB');


filter_yes_no("forlaptop", __('For laptop'));	

?>


