<?php

function _ug($catName, $cats, $subcats = false) {
    $result = array();
    
    $result['name'] = $catName;
    $result['cats'] = $cats;
    
    if ($subcats !== false) {
        $result['subcats'] = $subcats;
    }
    
    return (object)$result;
}

function get_add_menu_items($fulllist) {
    $result = '';
    
    foreach($fulllist as $cat) {
        $menuClasses = 'menu-item menu-item-type-custom menu-item-object-custom';
    
        $subCatsHTML = '';
        if (isset($cat->subcats)) {
            $caturl = '#';
            $subCatsHTML .= '<ul class="sub-menu">' . get_add_menu_items($cat->subcats) . '</ul>';
        } else {
            $caturl = site_url('/addnew/?type=' . $cat->cats);
        }
        $result .= '<li class="' . $menuClasses . '"><a href="' . $caturl . '">' . __($cat->name) . '</a>' . $subCatsHTML . '</li>';
    }
    
    return $result;
}

function get_filtered_menu_items($fulllist, &$filtered_list, $filter) {
    foreach($fulllist as $cat) {
        if (isset($cat->subcats)) {
            get_filtered_menu_items($cat->subcats, $filtered_list, $filter);
        }

        if (strpos(";{$filter};", ";{$cat->cats};") !== false) {
            $filtered_list[] = $cat;
        }
    }
}


$fulllist = array(
    _ug('Vacancy', 127),
    _ug('Resume', 362),
    _ug('Service', 321),
    _ug('Event', 374),
    _ug('Real Estate', '286,303', array(
        _ug('House', 267),
        _ug('Flat', 233),
        _ug('Commercial area', 302),
        _ug('Land area', 301),
        _ug('Garage', 381),
        _ug('Construction materials', 303),
    )),
            _ug('Computers / Phones',322, array(
                    _ug('Computers / Networking', 169, array(
                            _ug('Computer', 170),
                            _ug('Notebook / Netbook', 173),
                            _ug('Printer / Scanner / Accessory', 172),
                            _ug('Network / Internet equipment', 175),
                            _ug('Case and inside devices', 291, array(
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
                            _ug('Peripherals', 171, array(
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
                    _ug('Phones / Communication', 3, array(
                            _ug('Cellular phone', 285),
                            _ug('Accessories', 12, array(
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
            _ug('Electronics', '377,384,288,184,393,386,287,15', array(
                    _ug('Photo and Video cameras', 328, array(
                            _ug('Digital SLR camera', 329),
                            _ug('Advanced digital camera', 369),
                            _ug('Compact digital camera', 368),
                            _ug('Film camera', 330),
                            _ug('Camcorder', 331),
                            _ug('Lens', 334),
                            _ug('Speedlight', 333),
                            _ug('Accessory', 370),
                            )),
                    _ug('Car electronics', 384, array(
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
                    _ug('Players', '298,401', array(
                            _ug('Home player', 400),
                            _ug('Car player', 401),
                            _ug('Pocket player', 399),
                            )),		
                    _ug('Speakers', '394,184,393,386', array(
                            _ug('For home', 395),
                            _ug('For computer', 184),
                            _ug('For phone', 393),
                            _ug('For car', 386),						
                            )),		
                    _ug('Headphones', '396,287,15', array(
                            _ug('For computer', 287),
                            _ug('For phone', 15),
                            _ug('Other', 397),						
                            )),	
                    _ug('Microphone', 288),
                    _ug('Other', 327),
                    )),
            _ug('Vehicles / Parts', 39, array(
        _ug('Car', 295),
        _ug('Minibus', 349),
        _ug('Bus', 297),
        _ug('Truck', 298),
        _ug('Water vehicle / Parts', 299),
        _ug('Motorcycle / Parts', 147),
        _ug('Bicycle / Parts', 145),
                    _ug('Accessories', 384, array(
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

            _ug('Machinery / Devices', '317,313', array(
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

            _ug('Clothing / Accessories', 340, array(
        _ug('Clothing', 364),
        _ug('Shoes', 365),
        _ug('Bijouterie', 366),
        _ug('Accessory', 367),
        _ug('Ornament', 360),
    )),
        _ug('Perfumery', 415, array(
                _ug('Perfume', 417),
                _ug('Accessory', 416),
                )),
    _ug('Sport stuff', 343),
    _ug('Gifts', '407,410,380', array(
         _ug('Composition', 409),
         _ug('Flower', 410),
         _ug('Sweets', 408),
         _ug('Toy', 380),
         _ug('Souvenir / Antique', 361),
    )), 
       _ug('Food', 418, array(
                _ug('Pastry', 419),
                _ug('Salad', 420),
                _ug('Other', 421)
               )), 

    _ug('Musical Instrument', 341),
    _ug('Art', 342),
            _ug('Agriculture', '312,301', array(
        _ug('Agricultural machinery', 313),
        _ug('Agricultural product', 314),
        _ug('Land area', 301),
        _ug('Fertilizer / Chemical', 315),
        _ug('Tools', 316),
    )),
            _ug('Business / Production / Materials', '337,314', array(
                    _ug('Business', 308),
                    _ug('Agricultural product', 314),
                    _ug('Construction material', 303),
                    _ug('Other', 310),
    )),	
            _ug('Animals / Plants', '339,315', array(
        _ug('Animal', 371),
                    _ug('Plant', '372,315', array(
                            _ug('Flower', 410),
                            _ug('Houseplant', 411),
                            _ug('Seedling / Seed', 412),
                            _ug('Fertilizer / Chemical', 315),
                            _ug('Accessory', 413),
                            )),
    )),
            _ug('Kid products', 379, array(
        _ug('Toy', '380'),
        _ug('Clothing', '364&forkids=2'),
        _ug('Bijouterie', '366&forkids=2'),
        _ug('Shoes', '365&forkids=2'),
        _ug('Clothing accessory', '367&forkids=2'),
        _ug('Ornament', '360&forkids=2'),
        _ug('Video game device', '326'),
        _ug('Other', '344'),
    )),
 //   _ug('Found item', 363),
    _ug('Disc / Book', 345),
    _ug('Humor', 348),


);
?>

<div id="categoriesMenuContainer">
    <?php
        $filtered_list = array();
        
        $cats = arg($_GET, 'cats', false);
        $cats = str_replace(' ', '', $cats);
        if ($cats !== false) {
            get_filtered_menu_items($fulllist, $filtered_list, $cats);
        }

        if (count($filtered_list) > 0) {
    ?>
    <div class="addnew-menu-container">
        <ul id="menu-addnew-filtered" class="addnew_menu">
            <?php echo get_add_menu_items($filtered_list) ?>
        </ul>
    </div>
    <?php } ?>
    
    <div class="addnew-menu-container">
        <ul id="menu-addnew" class="addnew_menu">
            <?php echo get_add_menu_items($fulllist) ?>
        </ul>
    </div>
</div>


<script src="js/addnewmenu.js"></script>

<link rel="stylesheet" type="text/css" href="styles/style.css" />
