<?php

function _ug($catName, $cat) {
    return add_url($catName, $cat);
}

function _ue($catName, $cat) {
    echo add_url($catName, $cat);
}

function add_url($catName, $cat) {
    $menuClasses = 'menu-item menu-item-type-custom menu-item-object-custom';

    $subCatsHTML = '';
    if (is_array($cat)) {
        $caturl = '#';
        $subCatsHTML .= '<ul class="sub-menu">' . implode($cat) . '</ul>';
    } else {
        $caturl = site_url('/addnew/?type=' . $cat);
    }
    return '<li class="' . $menuClasses . '"><a href="' . $caturl . '">' . __($catName) . '</a>' . $subCatsHTML . '</li>';
}


echo '<div id="categoriesMenuContainer"><div style="width: 30%; display: none; margin-bottom: 110px;"><ul id="menu-addnew" class="addnew_menu">';

echo implode(array(
    _ug('Vacancy', 127),
    _ug('Resume', 362),
    _ug('Service', 321),
    _ug('Event', 374),
    _ug('Real Estate', array(
        _ug('House', 267),
        _ug('Flat', 233),
        _ug('Commercial area', 302),
        _ug('Land area', 301),
        _ug('Garage', 381),
        _ug('Construction materials', 303),
    )),
   _ug('Computers / Phones', array(
					_ug('Computers / Networking', array(
							_ug('Computer', 170),
							_ug('Notebook / Netbook', 173),
							_ug('Printer / Scanner / Accessory', 172),
							_ug('Network / Internet equipment', 175),
							_ug('Case and inside devices', array(
									_ug('CPU', 176),
									_ug('Motherboard', 180),
									_ug('RAM', 177),
									_ug('Video card', 182),
									_ug('HDD', 181),
									_ug('Optical drive', 183),
									_ug('Cooler', 178),
									_ug('Case', 188),
									_ug('Other', 352),
									)),
							_ug('Peripherals', array(
									_ug('Monitor', 179),
									_ug('Keyboard', 185),
									_ug('Mouse', 186),
									_ug('Speakers', 184),
									_ug('Headphones', 287),
									_ug('Microphone', 288),
									_ug('Web camera', 187),
									_ug('External HDD', 292),
									_ug('External optical drive', 290),
									_ug('USB flash drive', 382),
									_ug('UPS', 294),
									_ug('Other', 355),
									)),
							_ug('Other', 356),
							)),
					_ug('Tablet', 174),
					_ug('Phones / Communication', array(
							_ug('Cellular phone', 285),
							_ug('Accessories', array(
									_ug('Speakers', 393),
									_ug('Headphones', 15),
									_ug('Body / Cover', 359),
									_ug('Spare parts', 16),
									_ug('Battery', 17),
									_ug('Memory card', 14),
									_ug('Charger', 18),
									_ug('USB cable', 23),
									_ug('SIM card', 13),
									_ug('Other', 358),
									)),
							_ug('Radio communication system', 378),
							_ug('Home phone', 305),
							_ug('PBX / System phone', 307),
							_ug('Fax', 306),
							_ug('Other', 311),
							)))),    
			_ug('Electronics', array(
					_ug('Photo and Video cameras', array(
							_ug('Digital SLR camera', 329),
							_ug('Advanced digital camera', 369),
							_ug('Compact digital camera', 368),
							_ug('Film camera', 330),
							_ug('Camcorder', 331),
							_ug('Lens', 334),
							_ug('Speedlight', 333),
							_ug('Accessory', 370),
							)),
					_ug('Car electronics', array(
							_ug('Player', 401),
							_ug('Speakers', 386),
							_ug('TV device', 388),
							_ug('Navigation device', 387),
							_ug('Video registrator', 385),
							_ug('Detector', 389),
							_ug('Other', 392),  
							)),
					_ug('Recording device', 383),
					_ug('TV device', 323),
					_ug('Video system', 325),
					_ug('Video game device', 326),
					_ug('Players', array(
							_ug('Home player', 400),
							_ug('Car player', 401),
							_ug('Pocket player', 399),
							)),		
					_ug('Speakers', array(
							_ug('For home', 395),
							_ug('For computer', 184),
							_ug('For phone', 393),
							_ug('For car', 386),						
							)),		
					_ug('Headphones', array(
							_ug('For computer', 287),
							_ug('For phone', 15),
							_ug('Other', 397),						
							)),	
					_ug('Microphone', 288),
					_ug('Other', 327),
					)),
  _ug('Vehicles / Parts', array(
        _ug('Car', 295),
        _ug('Minibus', 349),
        _ug('Bus', 297),
        _ug('Truck', 298),
        _ug('Water vehicle / Parts', 299),
        _ug('Motorcycle / Parts', 147),
        _ug('Bicycle / Parts', 145),
					_ug('Accessories', array(
							_ug('Player', 401),
							_ug('Speakers', 386),
							_ug('TV device', 388),
							_ug('Navigation device', 387),
							_ug('Video registrator', 385),
							_ug('Detector', 389),
							_ug('Other', 392),  
							)),
		_ug('Spare part', 144),
					_ug('Tool / Device', 296),
    )),

    _ug('Machinery / Devices', array(
        _ug('Agricultural machinery', 313),
        _ug('Construction machinery', 318),
        _ug('Medical equipment', 319),
        _ug('Special machinery', 300),
        _ug('Mechanism', 320),
        _ug('Tools', 304),
    )),
 
    _ug('Household product', 346),
    _ug('Furniture / Interior', 338),
	_ug('Office and School Supply', 324),

    _ug('Clothing / Accessories', array(
        _ug('Clothing', 364),
        _ug('Shoes', 365),
        _ug('Bijouterie', 366),
        _ug('Accessory', 367),
        _ug('Ornament', 360),
    )),

 _ug('Perfumery', array(
      _ug('Perfume', 417),
      _ug('Accessory', 416),
         )),


    _ug('Sport stuff', 343),
    _ug('Creative item', 347),
    _ug('Gifts', array(
         _ug('Composition', 409),
         _ug('Flower', 410),
         _ug('Sweets', 408),
         _ug('Toy', 380),
         _ug('Souvenir / Antique', 361),
    )), 


    _ug('Musical Instrument', 341),
	_ug('Art', 342),
    _ug('Agriculture', array(
        _ug('Agricultural machinery', 313),
        _ug('Agricultural product', 314),
        _ug('Land area', 301),
        _ug('Fertilizer / Chemical', 315),
        _ug('Tools', 316),
    )),
	_ug('Business / Production / Materials', array(
					_ug('Business', 308),
					_ug('Agricultural product', 314),
					_ug('Construction material', 303),
					_ug('Other', 310),
	)),	
	_ug('Animals / Plants', array(
		_ug('Animal', 371),
                    _ug('Plant', array(
                            _ug('Flower', 410),
                            _ug('Houseplant', 411),
                            _ug('Seedling / Seed', 412),
                            _ug('Fertilizer / Chemical', 315),
                            _ug('Accessory', 413),
                            )),
    )),
    _ug('Kid products', array(
        _ug('Toy', '380'),
        _ug('Clothing', '364&forkids=2'),
        _ug('Bijouterie', '366&forkids=2'),
        _ug('Shoes', '365&forkids=2'),
        _ug('Clothing accessory', '367&forkids=2'),
        _ug('Ornament', '360&forkids=2'),
		_ug('Video game device', '326'),
        _ug('Other', '344'),
    )),
    _ug('Found item', 363),
	_ug('Disc / Book', 345),
    _ug('Humor', 348),


));

echo '</ul></div></div>';


?>

<script src="js/addnewmenu.js"></script>

<link rel="stylesheet" type="text/css" href="styles/style.css" />
