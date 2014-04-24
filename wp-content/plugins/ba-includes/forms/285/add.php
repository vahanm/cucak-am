<?php

function CheckFormForErrors()
{
    return '';
}

helper_price(array('allow_rent' => false, 'allow_donation' => false));








helper_group('general_information', __('General'));


//helper_select_mobile();

helper_item_status();


helper_location('item_location', __('Item location'), USER_LOCATION);



helper_select('item_condition', __('Item condition'), array(  
    array(1, __('new')),  
    array(2, __('used')),  
    array(3, __('broken')) 
    
    ) );

helper_text("phonemodel", __('The model'), __('Please enter the model.'));


helper_select('operation_system', __('Operating system'), array( 
    array(1, __('Feature phone')),  
    array('andr22froyo', 'Android 2.2 Froyo'),
    array('andr23gingerbread', 'Android 2.3 Gingerbread'),
    array('andr3xhoneycomb', 'Android 3.x Honeycomb'),
    array('andr40icecreamsandwich', 'Android 4.0 Ice Cream Sandwich'),
    array('andr41jellybean', 'Android 4.1 Jelly Bean'),
    array('andr42jellybean', 'Android 4.2 Jelly Bean'),
    array('andr43jellybean', 'Android 4.3 Jelly Bean'),
    array('andr44kitkat', 'Android 4.4 KitKat'),
    array('andr4x', 'Android 4.x'),
    /*
    array('appleios1', 'Apple iOS 1'),
    array('appleios2', 'Apple iOS 2'),
    array('appleios3', 'Apple iOS 3'),
    */
    array('appleios4', 'Apple iOS 4'),
    array('appleios511', 'Apple iOS 5'),
    array('appleios60', 'Apple iOS 6'),
    array('appleios70', 'Apple iOS 7'),
    array('windowsmobile5', 'Windows Mobile 5'),
    array('windowsmobile6', 'Windows Mobile 6'),
    array('windowsmobile7', 'Windows Mobile 7'),
    array('windowsphone70', 'Windows Phone 7.0'),
    array('windowsphone75', 'Windows Phone 7.5'),
    array('windowsphone78', 'Windows Phone 7.8'),
    array('windowsphone8', 'Windows Phone 8'),
    array('blackberryos50', 'BlackBerry OS 5.0'),
    array('blackberryos60', 'BlackBerry OS 6.0'),
    array('blackberryos70', 'BlackBerry OS 7.0'),
    array('blackberryos71', 'BlackBerry OS 7.1'),
    array('symbianos8', 'Symbian OS 8'),
    array('symbianos9', 'Symbian OS 9'),
    array('symbianos2', 'Symbian OS 2'),
    array('symbianos3', 'Symbian OS 3'),
    /*
    array('nokiabelle', 'Nokia Belle'),
    array('meego', 'meeGo'),
    array('maemo ', 'Maemo'),
    array('bada', 'bada'),
    array('webos1', 'webOS 1'),
    array('webos2', 'webOS 2'),
    array('webos3', 'webOS 3'),
    */
    array(12,__('other'))
    ) );


helper_select('form', __('Form'), array( 
    array(1, __('bar')),   
    array(2, __('flip')), 
    array(3, __('slide')),     
    array(4, __('swivel')),   
    array(5, __('other'))
    ) );

helper_text("cpumodeltab", __('CPU model'), __('Please enter the model.'));

helper_slider('cpufrequency', __('Frequency'), __('Please select'), 50, 4, 60, '%s ' . 'MHz','200 ' . 'MHz', '3 ' . 'GHz');

helper_slider('core', __('Core quantity'), __('Please select'), 1, 1, 8, __('%s cores'));

helper_slider_by_list('tabram', __('RAM size'), __('Please select'), 1, 13, '%s '. 'MB', array(
    1 => '16 MB',
    2 => '32 MB',
    3 => '64 MB',
    4 => '128 MB',
    5 => '256 MB',
    6 => '384 MB',
    7 => '512 MB',
    8 => '750 MB',
    9 => '1 GB',
    10 => '1.5 GB',
    11 => '2 GB',
    12 => '3 GB',
    13 => '4 GB',

    ),'16 MB', '4 GB');


helper_colors('phonecolor', __('Phone color'));

//helper_creative_design();

helper_yes_no("qwerty", __('QWERTY keyboard'));

helper_slider_by_list('sim', __('SIM card quantity'), __('Please select'), 1, 3, '%s '. __('SIM cards'), array(
    1 => '1 ' . __('SIM card')		
    ),'1 ' . __('SIM card'),'3 ' . __('SIM cards'));




helper_group_sub('display', __('Display'));

helper_slider('diagonal', __('Diagonal'), __('Please select'), 0.1, 11, 70, '%s "', '%s "', '%s "');

helper_select('color', __('Color quantity'), array( 
    array(1, __('black and white')),  
    array(2, __('grayscale')),  
    array(3, __('64K')), 
    array(4, __('256K')),
    array(5, __('16M')),
    array(6, __('other'))
    ) );


    helper_resolution(array(
        'id' => 'resolution',
        'title' => __('Resolution'),
        'suggestions' => array(

/*
                    array(160, 128),
                    array(220, 176),
                    array(320, 240),  ///
                    array(400, 240),  ///
                    array(640, 480),  /// taracvac chi
                    array(854, 480),  /// taracvac chi
*/

                    array(1080, 1920, 'Full HD'),
                    array(800, 1280 ),
                    array(768, 1280),
                    array(720, 1280),
                    array(640, 1136, 'iPhone 5, 5s'),
                    array(640, 960, 'iPhone 4, 4s'),
                    array(540, 960),
                    array(480, 800),
                    array(360, 640),
                    array(320, 480),
               //     array(240, 400),
               //     array(240, 320),
               //     array(128, 128),


/*
                    array(240, 320),
                    array(320, 480, 'iPhone 3GS'),
                    array(480, 640),
                    array(480, 800, 'Galaxy'),
                    array(480, 854),
                    array(480, 1024),
                    array(540, 960),
                    array(600, 800),
                    array(640, 960, 'iPhone 4S'),
                    array(720, 1280),
                    array(800, 1280),
                */
                    )
                ));
/*
         helper_select('resolution', __('Resolution'), array( 
    //array('176x132', '176x132'),
    //array('176x208', '176x208'),
    //array('176x220', '176x220'),
    //array('226x170', '226x170'),
    //array('230x173', '230x173'),
    //array('230x180', '230x180'),
    //array('240x180', '240x180'),
    array('240x320', '240x320'),
    //array('272x480', '272x480'),
    //array('306x230', '306x230'),
    //array('320x240', '320x240'),
    array('320x480', '320x480'),        //iPhone 3GS
    //array('352x416', '352x416'),
    //array('420x293', '420x293'),
    //array('480x272', '480x272'),
    //array('480x272', '480x272'),
    //array('480x320', '480x320'),
    array('480x640', '480x640'),
    array('480x800', '480x800'),
    array('480x854', '480x854'),
    array('480x1024', '480x1024'),
    //array('528x436', '528x436'),
    array('540x960', '540x960'),
    array('600x800', '600x800'),
    //array('640x360', '640x360'),
    //array('640x480', '640x480'),
    array('640x960', '640x960'),        //iPhone 4S
    //array('640x1136', '640x1136'),      //iPhone 5S
    //array('720x480', '720x480'),
    //array('720x576', '720x576'),
    array('720x1280', '720x1280'),
    //array('800x480', '800x480'),
    //array('800x600', '800x600'),
    array('800x1280', '800x1280'),
    //array('854x480', '854x480'),
    //array('864x1152', '864x1152'),
    //array('960x540', '960x540'),
    //array('1024x600', '1024x600'),
    //array('1024x768', '1024x768'),
    //array('1152x768', '1152x768'),
    //array('1152x864', '1152x864'),
    //array('1200x824', '1200x824'),
    //array('1280x720', '1280x720'),
    //array('1280x768', '1280x768'),
    //array('1280x800', '1280x800'),
    //array('1280x854', '1280x854'),
    //array('1280x1024', '1280x1024'),
    //array('1360x768', '1360x768'),
    //array('1366x720', '1366x720'),
    //array('1366x768', '1366x768'),
    //array('1400x1050', '1400x1050'),
    //array('1440x900', '1440x900'),
    array('other', __('other')),  
    ) );

*/
/*
<select name="nminDisplayX">
<option value="0" selected="">--</option>
<option value="320">320</option>
<option value="400">400</option>
<option value="480">480</option>
<option value="540">540</option>
<option value="640">640</option>
<option value="720">720</option>
<option value="768">768</option>
<option value="800">800</option>
<option value="854">854</option>
<option value="960">960</option>
<option value="1080">1080</option>
<option value="1024">1024</option>
<option value="1280">1280</option>
<option value="1366">1366</option>
<option value="1920">1920</option>
</select>
*/

helper_yes_no("touchscreendisplay", __('Touchscreen display'),true);

//helper_yes_no("multitouch", __('Multitouch'));


helper_yes_no("secondary_display", __('Secondary display'), true);











helper_group_sub('cameragroup', __('Camera'));

helper_slider('camresol', __('Camera'), __('Please select'), 0.2, 1, 205, '%s MP');
/*
helper_slider_by_list('camera', __('Camera'), __('Please select'), 1, 9, 'Error', array(
	1 =>  __('no camera'), 	
	2 => _t('%s MP or less', 1), 
	3 => '1.3 ' . 'MP',
	4 => '2 ' . 'MP', 
	5 => '3 ' . 'MP',
	6 => '3.2 ' . 'MP', 
	7 => '5 ' . 'MP',
	8 => '8 ' . 'MP',
	9 => _t('%s MP or more', 10)
	), __('no camera'),_t('%s MP or more', 10));
*/

helper_yes_no("seccamera", __('Camera (secondary)'), true); 

//helper_yes_no("videocall", __('Videocall'), true);

helper_yes_no("camera_flash", __('Camera flash'), true);










helper_group_sub('data', __('Data and memory'));


helper_slider('gsm', __('GSM generations'), __('Please select'), 1, 2, 4, '%s' . 'G', '2' . 'G', '4' . 'G');

helper_yes_no("wifi", 'Wi-Fi', true);

helper_yes_no("bluetooth", 'Bluetooth', true);

helper_yes_no("IrDA", __('IrDA'));

helper_slider_by_list('internal_memory', __('Internal memory'), __('Please select'), 1, 13, 'Error', array(
    1 => __('none'), 
    2 => '64' . 'MB',
    3 => '128' . 'MB', 
    4 => '256' . 'MB', 
    5 => '512' . 'MB',
    6 => '1' . 'GB', 
    7 => '2' . 'GB', 
    8 => '4' . 'GB', 
    9 => '8' . 'GB',
    10 => '16' . 'GB', 
    11 => '32' . 'GB', 
    12 => '64' . 'GB', 
    13 => '128' . 'GB' 
    ),__('none'),'128' . 'GB');


helper_slider_by_list('memory', __('Memory card'), __('Please select'), 1, 10, 'Error', array(
    1 => __('none'), 
    2 => '512' . 'MB',
    3 => '1' . 'GB', 
    4 => '2' . 'GB', 
    5 => '4' . 'GB', 
    6 => '8' . 'GB',
    7 => '16' . 'GB', 
    8 => '32' . 'GB', 
    9 => '64' . 'GB', 
    10 => '128' . 'GB' 
    ),__('none'), '128' . 'GB');








helper_group_sub('features', __('Features'));

helper_yes_no("gps", 'GPS', true);

helper_yes_no("radio", __('Radio'), true);

helper_yes_no("audio_jack", __('3.5 mm audio jack'));





helper_group_sub('extra', __('Extra things'));


helper_yes_no("charger", __('Charger'), true);

helper_yes_no("headphone", __('Headphones'), true);

helper_yes_no("usbcable", __('USB cable'), true);

helper_yes_no("extra_body", __('Extra body'), true);

helper_yes_no("box", __('Box'), true);

helper_yes_no("warranty", __('Warranty'), true);
