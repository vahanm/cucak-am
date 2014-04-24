<?php
/* Plugin Name: BA HTML Helper
 * Plugin URI: http://www.vmv-pc.no-ip.org
 * Description: HTML helper
 * Version: 1.0
 * Author: Vahan
 * Author URI: http://www.vmv-pc.no-ip.org
 * License: Vahan
**/




define('SECONDARY_FILTER', 0);
define('PRIMARY_FILTER', 1);
define('USED_FILTER', 2);





require_once('home-categories-metro-params.php');


/* ******************************************************** */
/* ************************* Filters ********************** */
/* ************************** BEGIN *********************** */

function show_transaction_type($key) {
    global $wpdb;
    $filtredPostIds = get_specfilter_select_query(false); //(array('allow_sale', 'allow_rent', 'allow_exchange', 'allow_donation', 'allow_exchange', 'allow_donation'));
    
    $bdb_values_query = "SELECT DISTINCT `meta_key` AS val
                            FROM `{$wpdb->prefix}postmeta`
                            WHERE `meta_key` = 'post_$key' AND `meta_value` = '1'";
                                
    if ($filtredPostIds !== false)
        $bdb_values_query .= " AND `post_id` IN ($filtredPostIds)";
    //echo $bdb_values_query;
    $bdb_values = $wpdb->get_results($bdb_values_query);
    
    return count($bdb_values) > 0;
}

function helper_filters_test()
{    
    global $specfilters;
    $cat = arg($_GET, 'cat', '');
    $author = arg($_GET, 'author', '');
    
    $checked_sale       = arg($_GET, 'qallow_saleoeq', 0) == 1;
    $checked_rent       = arg($_GET, 'qallow_rentoeq', 0) == 1;
    $checked_exchange   = arg($_GET, 'qallow_exchangeoeq', 0) == 1;
    $checked_donation   = arg($_GET, 'qallow_donationoeq', 0) == 1;
    $checked_salary     = ($cat == 127) || arg($_GET, 'qallow_salaryoeq', 0) == 1;
    $checked_payment    = ($cat == 321) || arg($_GET, 'qallow_paymentoeq', 0) == 1;
    
    
    $show_sale = true;
    $show_rent = true;
    $show_exchange = true;
    $show_donation = true;
    $show_salary = true;
    $show_payment = true;
    
    if (is_home()) {
        $show_transaction_types = true;
        $only_one = false;
    } else {
        if (!$checked_sale)
            $show_sale = show_transaction_type('allow_sale');

        if (!$checked_rent)
            $show_rent = show_transaction_type('allow_rent');

        if (!$checked_exchange)
            $show_exchange = show_transaction_type('allow_exchange');

        if (!$checked_donation)
            $show_donation = show_transaction_type('allow_donation');

        if (!$checked_salary)
            $show_salary = show_transaction_type('allow_salary');

        if (!$checked_payment)
            $show_payment = show_transaction_type('allow_payment');
    
        $show_transaction_types  = $show_donation
                                || $show_sale
                                || $show_rent
                                || $show_exchange
                                || $show_salary
                                || $show_payment;
        
        $only_one = 1 == ( ($show_donation ? 1 : 0)
                         + ($show_sale ? 1 : 0)
                         + ($show_rent ? 1 : 0)
                         + ($show_exchange ? 1 : 0)
                         + ($show_salary ? 1 : 0)
                         + ($show_payment ? 1 : 0)
                         );
                         
        $only_one_type = !$only_one ? '' : ($show_donation ? '4' : '')   //donation
                                         . ($show_sale ? '1' : '')       //sale
                                         . ($show_rent ? '2' : '')       //rent
                                         . ($show_exchange ? '3' : '')   //exchange
                                         . ($show_salary ? '5' : '')     //salary
                                         . ($show_payment ? '6' : '');   //payment
        
        $show_transaction_types = $show_transaction_types && !$only_one;
        
        $expand_sale        = $checked_sale     || ($only_one && $show_sale);              // true; // 
        $expand_rent        = $checked_rent     || ($only_one && $show_rent);              // true; // 
        $expand_exchange    = $checked_exchange || ($only_one && $show_exchange);          // true; // 
        $expand_donation    = $checked_donation || ($only_one && $show_donation);          // true; // 
        $expand_salary      = $checked_salary   || ($only_one && $show_salary);            // true; // 
        $expand_payment     = $checked_payment  || ($only_one && $show_payment) || filter_select_used('servicesphere');           // true; // 
    }
?>
<input type="hidden" id="filter_cat" value="<?php echo $cat ?>" />
<input type="hidden" id="filter_author" value="<?php echo $author ?>" />
<input type="hidden" id="filter_page" value="" />
<input type="hidden" id="filter_advanced" value="<?php if ($specfilters){ echo '1'; } else { echo '0'; } ?>" />
<input type="hidden" id="filter_only_one" value="<?php echo $only_one_type ?>" />

<div>TEST Mode</div>

<div style="width: 100%; float: left; background-color: #fdfdfd; border: 1px solid #ddd; text-align: center; padding: 5px 0px 5px 0px;">
    <input type="text" value="<?php arg($_GET, 's', '') ?>" class="field" id="filter_searchtext" placeholder="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" defaultvalue="<?php _e('Type text to searh.') ?>" style="margin-right: 4px; width: <?php echo is_home() ? /* 500 */ 617 : (is_author() ? /*465*/ 575 : /*250*/ 366) ?>px;" />
<?php
//helper_location_combo('qlocationoeq', __('everywhere'));

    if (!is_author()) {
        echo '<select id="filter_location" style="width: 200px; margin-right: 4px;">';
        echo '<option value="">', __('everywhere'), '</option>';
        $regions = getRegions();
        foreach ($regions as $key => $value) {
            echo '<option value="', $key, '" ', (arg($_GET, 'qitem_locationomn', 0) == $key) ? 'selected="selected"' : "", '>', $value, '</option>';
        }
        echo '</select>';
    } //if (!is_author())
?>
    <input type="submit" class="submit" id="filter_searchsubmit" value="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" style="margin-right: 4px;" />
    <?php /* <a style="-float: left; margin-left: 4px; margin-top: 4px;" id="filter_ShowHideFilters" href="javascript:;"><?php _e('Advanced search'); ?></a> */ ?>
</div>

<div id="filter_container_filters" style="width: 100%; float: left; background-color: #fdfdfd; border: 1px solid #eee; border-top: 0; <?php if (false && !$specfilters) { echo 'display: none;'; } ?>">
    <div class="filtersdiv" style="<?php if ((!$show_transaction_types) || $cat == 127 || $cat == 321 || $cat == 362 || $cat == 374 || $cat == 348) { echo 'display: none;'; } ?>">
        <div class="filterslbl">
            <select id="transaction-type-select" name="transactiontype" class="checkareabgsum" style="width: 160px;">
                    <option id="filter_allow_alltransactions" rowspan="2" style="vertical-align: middle; <?php if ($only_one) { echo 'display: none;'; } ?>" value="" selected="selected">
                        <?php _e('Transaction type'); ?>
                    </option>
                    <option id="filter_allow_sale" style="<?php if (!$show_sale) { echo 'display: none;'; } ?>" value="1" <?php if ($checked_sale) { ?> selected="selected" <?php } ?>>
                        <?php _e('sale'); ?>
                    </option>
                    <option id="filter_allow_rent" style="<?php if (!$show_rent) { echo 'display: none;'; } ?>" value="2" <?php if ($checked_rent) { ?> selected="selected" <?php } ?>>
                        <?php _e('rent'); ?>
                    </option>
                    <option id="filter_allow_exchange" style="<?php if (!$show_exchange) { echo 'display: none;'; } ?>" value="3" <?php if ($checked_exchange) { ?> selected="selected" <?php } ?>>
                        <?php _e('exchange'); ?>
                    </option>
                    <option id="filter_allow_donation" style="<?php if (!$show_donation) { echo 'display: none;'; } ?>" value="4" <?php if ($checked_donation) { ?> selected="selected" <?php } ?>>
                        <?php _e('donate'); ?>
                    </option>
                <?php if (is_home()) { ?>
                    <option id="filter_allow_salary">
                        <a href="<?php echo site_url('/?cat=127') ?>"><?php _e('job'); ?></a>
                    </option>
                    <option id="filter_allow_payment">
                        <a href="<?php echo site_url('/?cat=321') ?>"><?php _e('service'); ?></a>
                    </option>
                    <option id="filter_allow_vacancy">
                        <a href="<?php echo site_url('/?cat=362') ?>"><?php _e('resume'); ?></a>
                    </option>
                    <option id="filter_allow_meeting">
                        <a href="<?php echo site_url('/?cat=374') ?>"><?php _e('event'); ?></a>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div id="filter_priceforsale" class="filtersctrl" <?php if (!$expand_sale) { ?> style="display:none;" <?php } ?>>
            <p>
                <input type="text" id="filter_sale_price_min" class="txtareabgsum" value="<?php echo ifset($_GET['qsale_realpriceomn']) ?>" onkeypress="return isNumberKey(event)" />
                <span> - </span>
                <input type="text" id="filter_sale_price_max" class="txtareabgsum" value="<?php echo ifset($_GET['qsale_realpriceomx']) ?>" onkeypress="return isNumberKey(event)" />
            
                <select id="filter_sale_currency" class="filter-select-currency">
                    <option value="<?php echo cur_GetCurrency('AMD'); ?>"><?php _e('currency_AMD') ?></option>
                    <option value="<?php echo cur_GetCurrency('USD'); ?>"><?php _e('currency_USD') ?></option>
                    <option value="<?php echo cur_GetCurrency('EUR'); ?>"><?php _e('currency_EUR') ?></option>
                    <option value="<?php echo cur_GetCurrency('RUR'); ?>"><?php _e('currency_RUR') ?></option>
                </select>
            </p>
        </div>
        <div id="filter_priceforrent" class="filtersctrl" <?php if (!$expand_rent) { ?> style="display:none;" <?php } ?>>
            <p>
                <input type="text" id="filter_rent_price_min" class="txtareabgsum" style="width:20%" value="<?php echo $_GET['qrent_realpriceomn'] ?>" onkeypress="return isNumberKey(event)" />
                <span> - </span>
                <input type="text" id="filter_rent_price_max" class="txtareabgsum" style="width:20%" value="<?php echo $_GET['qrent_realpriceomx'] ?>" onkeypress="return isNumberKey(event)" />
            
                <select id="filter_rent_currency" class="txtareabgcurrency" style="width:21%">
                    <option value="<?php echo cur_GetCurrency('AMD'); ?>"><?php _e('currency_AMD') ?></option>
                    <option value="<?php echo cur_GetCurrency('USD'); ?>"><?php _e('currency_USD') ?></option>
                    <option value="<?php echo cur_GetCurrency('EUR'); ?>"><?php _e('currency_EUR') ?></option>
                    <option value="<?php echo cur_GetCurrency('RUR'); ?>"><?php _e('currency_RUR') ?></option>
                </select>
                <select id="filter_rent_frequency" class="txtareabgcurrency" style="width:22%">
                    <option value="720"><?php _e('hourly'); ?></option>
                    <option value="24"><?php _e('daily'); ?></option>
                    <option value="1" selected="selected"><?php _e('monthly'); ?></option>
                    <option value="0.0833333333333333"><?php _e('annually'); ?></option>
                </select>
            </p>
        </div>
        <div id="filter_priceforexchange" class="filtersctrl" <?php if (!$expand_exchange) { ?> style="display:none;" <?php } ?>>
            <p>
                <input type="text" id="filter_exchange_with" disabled="disabled" class="txtbg defaultText" defaultvalue="<?php _e('What do you want in return') ?>" value="<?php echo replace_quotes($_GET['exchange_with']); ?>" size="30" />
                <br />
                <span class="hint"><?php echo sprintf(__('%s characters max'), 120); ?></span>
            </p>
        </div>
        <div id="filter_fordonation" class="filtersctrl" <?php if (!$expand_donation) { ?> style="display:none;" <?php } ?>>
            <p>
                <span style="font-size:110%; font-weight: bold;">
                    <?php _e('I need a donation...!!!') ?>
                </span>
            </p>
        </div>
        <div id="filter_forjob" class="filtersctrl" <?php if (!$expand_salary) { ?> style="display:none;" <?php } ?>>
            <p>
                <span style="font-size:110%; font-weight: bold;">
                    <?php _e('I need a job...!!!') ?>
                </span>
            </p>
        </div>
        <div id="filter_forservice" class="filtersctrl" <?php if (!$expand_payment) { ?> style="display:none;" <?php } ?>>
            <p>
                <span style="font-size:110%; font-weight: bold;">
                    <?php
                    
                    
                        if (WPLANG == 'en_EN')
                            filter_select_only(array(
                              'id'		=>		'servicesphere'
                            , 'values'	=>	array( 
                                        array('financedit', __('Accounting / Finance / Audit')),
                                        array('autoservice', __('Car service')),
                                        array('carechildren', __('Care for children, elderly, sick')),
                                        array('ceremonies', __('Ceremonies organizing')),
                                        array('computereqt', __('Computer equipment / Internet')),
                                        array('cooking', __('Cooking')),
                                        array('education', __('Education / Teaching')),
                                        array('health', __('Health / Medicine')),
                                        array('hairdressing', __('Hairdressing, facial and body care')),
                                        array('houseworks', __('House works')),
                                        array('legalserv', __('Legal services')),
                                        array('mobilehome', __('Mobile / Home phone')),
                                        array('passengercargo', __('Passenger and cargo transportation / Taxi')),
                                        array('mediaphoto', __('Photo / Video / Design')),
                                        array('repairelectrical', __('Repair of electrical equipments')),
                                        array('repairworks', __('Repair works')),
                                        array('salesmarketing', __('Sales / Marketing')),
                                        array('securitybodyguard', __('Security / Bodyguard')),
                                        array('smallbusin', __('Small Business')),
                                        array('standupmeal', __('Stand-up meal organizing')),
                                        array('travelexcursions', __('Travel / Excursions / Guides')),
                                        array('other', __('other')))
                        ));


                        if (WPLANG == 'ru_RU')
                            filter_select_only(array(
                              'id'		=>'servicesphere'
                            , 'values'	=>array( 
                                        array('autoservice', __('Car service')),
                                        array('financedit', __('Accounting / Finance / Audit')),
                                        array('passengercargo', __('Passenger and cargo transportation / Taxi')),
                                        array('health', __('Health / Medicine')),
                                        array('computereqt', __('Computer equipment / Internet')),
                                        array('cooking', __('Cooking')),
                                        array('smallbusin', __('Small Business')),
                                        array('mobilehome', __('Mobile / Home phone')),
                                        array('education', __('Education / Teaching')),
                                        array('standupmeal', __('Stand-up meal organizing')),
                                        array('ceremonies', __('Ceremonies organizing')),
                                        array('securitybodyguard', __('Security / Bodyguard')),
                                        array('hairdressing', __('Hairdressing, facial and body care')),
                                        array('salesmarketing', __('Sales / Marketing')),
                                        array('houseworks', __('House works')),
                                        array('repairelectrical', __('Repair of electrical equipments')),
                                        array('repairworks', __('Repair works')),
                                        array('travelexcursions', __('Travel / Excursions / Guides')),
                                        array('carechildren', __('Care for children, elderly, sick')),
                                        array('mediaphoto', __('Photo / Video / Design')),
                                        array('legalserv', __('Legal services')),
                                        array('other', __('other')))
                        ));


                        if (WPLANG == 'am_HY')
                            filter_select_only(array(
                              'id'		=>'servicesphere'
                            , 'values'	=>array( 
                                        array('salesmarketing', __('Sales / Marketing')),
                                        array('health', __('Health / Medicine')),
                                        array('autoservice', __('Car service')),
                                        array('passengercargo', __('Passenger and cargo transportation / Taxi')),
                                        array('mobilehome', __('Mobile / Home phone')),
                                        array('carechildren', __('Care for children, elderly, sick')),
                                        array('repairelectrical', __('Repair of electrical equipments')),
                                        array('legalserv', __('Legal services')),
                                        array('cooking', __('Cooking')),
                                        array('education', __('Education / Teaching')),
                                        array('computereqt', __('Computer equipment / Internet')),
                                        array('financedit', __('Accounting / Finance / Audit')),
                                        array('ceremonies', __('Ceremonies organizing')),
                                        array('securitybodyguard', __('Security / Bodyguard')),
                                        array('hairdressing', __('Hairdressing, facial and body care')),
                                        array('repairworks', __('Repair works')),
                                        array('houseworks', __('House works')),
                                        array('travelexcursions', __('Travel / Excursions / Guides')),
                                        array('smallbusin', __('Small Business')),
                                        array('standupmeal', __('Stand-up meal organizing')),
                                        array('mediaphoto', __('Photo / Video / Design')),
                                        array('other', __('other')))
                        ));
                    
                    ?>
                </span>
            </p>
        </div>
    </div>
    
    <div class="filtersdiv" id="filter_forfilters">
        <div class="filterslbl">
            <p>
                <?php _e('Filters') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <?php 
                $excludeList = array('item_location', 'sale_realprice', 'rent_realprice', 'allow_sale', 'allow_rent', 'allow_exchange', 'allow_donation', 'allow_salary', 'allow_payment', '', '', '', '');
                
                foreach($specfilters as $id => $filter)
                {
                    if (in_array($id, $excludeList))
                        continue;
                    
                    foreach($filter as $type => $value)
                    {
                        switch($type)
                        {
                            case 'oeq':
                                $class = 'green';
                                $operator = __('Include:');
                                break;
                            case 'omn':
                                $class = 'silver';
                                $operator = __('Above:');
                                break;
                            case 'omx':
                                $class = 'silver';
                                $operator = __('Up to:');
                                break;
                            case 'ono':
                                $class = 'orange';
                                $operator = __('Exclude:');
                                break;
                            case 'olk':
                                $class = 'blue';
                                $operator = 'LIKE';
                                break;
                            case 'opn':
                                $class = 'blue';
                                $operator = __('This Phone number:');
                                break;
                        }
                        $item = GetFilterItem('[' . $id . ']', $value, 'content');
                        if ($item)
                            echo '<div filtername="' . $id . '" filtertypes="' . $type . '" filtervalue="' . $value . '" class="filter-item filter-' . $class . ' filter-container" >' . $operator . $item . '</div>';
                    }
                }
                ?>
                
                <style>
                    .filter-container
                    {}
                            
                    .filter-container div
                    {
                        margin-top: 3px;
                        margin-left: 8px;
                        margin-right: 4px !Important;
                    }
                </style>
            </p>
        </div>
    </div>
</div>

<div class="filtermenu-separator">
</div>

<div id="filtermenu">
    <div id="filtermenu-clr" filtertypes="clr" style="display: none;"><?php _e('Clear filter from "<span></span>"') ?></div>
    
    <div id="filtermenu-oeq" filtertypes="oeq" style="display: none;"><?php _e('Include: "<span></span>"') ?></div>
    <div id="filtermenu-ono" filtertypes="ono" style="display: none;"><?php _e('Exclude: "<span></span>"') ?></div>
    
    <div id="filtermenu-omn" filtertypes="omn" style="display: none;"><?php _e('Above: "<span></span>"') ?></div>
    <div id="filtermenu-omx" filtertypes="omx" style="display: none;"><?php _e('Up to: "<span></span>"') ?></div>
</div>

<?php
} //helper_filters

function helper_filters() {
    if (WP_TEST) return helper_filters_test();
    
    global $specfilters;
    $cat = arg($_GET, 'cat', '');
    $author = arg($_GET, 'author', '');
    
    $checked_sale       = arg($_GET, 'qallow_saleoeq', 0) == 1;
    $checked_rent       = arg($_GET, 'qallow_rentoeq', 0) == 1;
    $checked_exchange   = arg($_GET, 'qallow_exchangeoeq', 0) == 1;
    $checked_donation   = arg($_GET, 'qallow_donationoeq', 0) == 1;
    $checked_salary     = ($cat == 127) || arg($_GET, 'qallow_salaryoeq', 0) == 1;
    $checked_payment    = ($cat == 321) || arg($_GET, 'qallow_paymentoeq', 0) == 1;
    
    
    $show_sale = true;
    $show_rent = true;
    $show_exchange = true;
    $show_donation = true;
    $show_salary = true;
    $show_payment = true;
    
    if (is_home()) {
        $show_transaction_types = true;
        $only_one = false;
    } else {
        if (!$checked_sale)
            $show_sale = show_transaction_type('allow_sale');

        if (!$checked_rent)
            $show_rent = show_transaction_type('allow_rent');

        if (!$checked_exchange)
            $show_exchange = show_transaction_type('allow_exchange');

        if (!$checked_donation)
            $show_donation = show_transaction_type('allow_donation');

        if (!$checked_salary)
            $show_salary = show_transaction_type('allow_salary');

        if (!$checked_payment)
            $show_payment = show_transaction_type('allow_payment');
    
        $show_transaction_types  = $show_donation
                                || $show_sale
                                || $show_rent
                                || $show_exchange
                                || $show_salary
                                || $show_payment;
        
        $only_one = 1 == ( ($show_donation ? 1 : 0)
                         + ($show_sale ? 1 : 0)
                         + ($show_rent ? 1 : 0)
                         + ($show_exchange ? 1 : 0)
                         + ($show_salary ? 1 : 0)
                         + ($show_payment ? 1 : 0)
                         );
                         
        $only_one_type = !$only_one ? '' : ($show_donation ? '4' : '')   //donation
                                         . ($show_sale ? '1' : '')       //sale
                                         . ($show_rent ? '2' : '')       //rent
                                         . ($show_exchange ? '3' : '')   //exchange
                                         . ($show_salary ? '5' : '')     //salary
                                         . ($show_payment ? '6' : '');   //payment
        
        $show_transaction_types = $show_transaction_types && !$only_one;
        
        $expand_sale        = $checked_sale     || ($only_one && $show_sale);
        $expand_rent        = $checked_rent     || ($only_one && $show_rent);
        $expand_exchange    = $checked_exchange || ($only_one && $show_exchange);
        $expand_donation    = $checked_donation || ($only_one && $show_donation);
        $expand_salary      = $checked_salary   || ($only_one && $show_salary);
        $expand_payment     = $checked_payment  || ($only_one && $show_payment);
    }
?>
<input type="hidden" id="filter_cat" value="<?php echo $cat ?>" />
<input type="hidden" id="filter_author" value="<?php echo $author ?>" />
<input type="hidden" id="filter_page" value="" />
<input type="hidden" id="filter_advanced" value="<?php if ($specfilters){ echo '1'; } else { echo '0'; } ?>" />
<input type="hidden" id="filter_only_one" value="<?php echo $only_one_type ?>" />

<div class="filter-container-filters-main">
    <input type="search" value="<?php if (isset($_GET['s'])) echo $_GET['s']; ?>" class="field" id="filter_searchtext" placeholder="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" defaultvalue="<?php _e('Type text to searh.') ?>" style="margin-right: 4px; width: <?php echo is_home() ? /* 500 */ 617 : (is_author() ? /*465*/ 575 : /*250*/ 366) ?>px;" />
<?php
//helper_location_combo('qlocationoeq', __('everywhere'));

    if (!is_author()) {
        echo '<select id="filter_location" style="width: 200px; margin-right: 4px;">';
        echo '<option value="">', __('everywhere'), '</option>';
        $regions = getRegions();
        foreach ($regions as $key => $value) {
            echo '<option value="', $key, '" ', (arg($_GET, 'qitem_locationomn', 0) == $key) ? 'selected="selected"' : "", '>', $value, '</option>';
        }
        echo '</select>';
    } //if (!is_author())
?>
    <input type="submit" class="submit" id="filter_searchsubmit" value="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" style="margin-right: 4px;" />
    <?php /* <a style="-float: left; margin-left: 4px; margin-top: 4px;" id="filter_ShowHideFilters" href="javascript:;"><?php _e('Advanced search'); ?></a> */ ?>
</div>

<div id="filter_container_filters" class="filter-container-filters" style="<?php if (false && !$specfilters) { echo 'display: none;'; } ?>">
    <div class="filtersdiv" style="<?php if ((!$show_transaction_types) || $cat == 127 || $cat == 321 || $cat == 362 || $cat == 374 || $cat == 348) { echo 'display: none;'; } ?>">
        <div class="filterslbl">
            <p>
                <?php _e('Transaction type') ?>:</p>
        </div>
        <div class="filtersctrl" <?php if (is_home()) { ?> style="width: 600px" <?php } ?>>
            <table>
                <tr>
                    <td rowspan="2" style="vertical-align: middle; <?php if ($only_one) { echo 'display: none;'; } ?>">
                        <input type="radio" id="filter_allow_alltransactions" name="transactiontype" class="checkareabgsum" value="" checked="checked" />
                        <label for="filter_allow_alltransactions"><?php _e('All types'); ?></label>
                    </td>
                    <td style="<?php if (!$show_sale) { echo 'display: none;'; } ?>">
                        <input type="radio" id="filter_allow_sale" name="transactiontype" class="checkareabgsum" value="1" <?php if ($checked_sale) { ?> checked="checked" <?php } ?> />
                        <label for="filter_allow_sale"><?php _e('sale'); ?></label>
                    </td>
                    <td style="<?php if (!$show_rent) { echo 'display: none;'; } ?>">
                        <input type="radio" id="filter_allow_rent" name="transactiontype" class="checkareabgsum" value="2" <?php if ($checked_rent) { ?> checked="checked" <?php } ?> />
                        <label for="filter_allow_rent"><?php _e('rent'); ?></label>
                    </td>
                    <td style="<?php if (!$show_exchange) { echo 'display: none;'; } ?>">
                        <input type="radio" id="filter_allow_exchange" name="transactiontype" class="checkareabgsum" value="3" <?php if ($checked_exchange) { ?> checked="checked" <?php } ?> />
                        <label for="filter_allow_exchange"><?php _e('exchange'); ?></label>
                    </td>
                    <td style="<?php if (!$show_donation) { echo 'display: none;'; } ?>">
                        <input type="radio" id="filter_allow_donation" name="transactiontype" class="checkareabgsum" value="4" <?php if ($checked_donation) { ?> checked="checked" <?php } ?> />
                        <label for="filter_allow_donation"><?php _e('donate'); ?></label>
                    </td>
                </tr>
                <?php if (is_home()) { ?>
                <tr>
                    <td>
                        <input type="radio" disabled="disabled" />
                        <a href="<?php echo site_url('/?cat=127') ?>"><?php _e('job'); ?></a>
                        <?php /* ?>
                        <input type="radio" id="filter_allow_salary" name="transactiontype" class="checkareabgsum" value="5" <?php if (arg($_GET, 'qallow_salaryoeq', 0) == 1) { ?> checked="checked" <?php } ?> />
                        <label for="filter_allow_salary"><?php _e('job'); ?></label>
                        <?php */ ?>
                    </td>
                    <td>
                        <input type="radio" disabled="disabled" />
                        <a href="<?php echo site_url('/?cat=321') ?>"><?php _e('service'); ?></a>
                        <?php /* ?>
                        <input type="radio" id="filter_allow_payment" name="transactiontype" class="checkareabgsum" value="6" <?php if (arg($_GET, 'qallow_paymentoeq', 0) == 1) { ?> checked="checked" <?php } ?> />
                        <label for="filter_allow_payment"><?php _e('service'); ?></label>
                        <?php */ ?>
                    </td>
                    <td>
                        <input type="radio" disabled="disabled" />
                        <a href="<?php echo site_url('/?cat=362') ?>"><?php _e('resume'); ?></a>
                    </td>
                    <td>
                        <input type="radio" disabled="disabled" />
                        <a href="<?php echo site_url('/?cat=374') ?>"><?php _e('event'); ?></a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
    <div class="filtersdiv" id="filter_priceforsale" <?php if (!$expand_sale) { ?> style="display:none;" <?php } ?>>
        <div class="filterslbl">
            <p><?php _e('Price for sale') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <input type="text" id="filter_sale_price_min" class="txtareabgsum" value="<?php echo ifset($_GET['qsale_realpriceomn']) ?>" onkeypress="return isNumberKey(event)" />
                <span> - </span>
                <input type="text" id="filter_sale_price_max" class="txtareabgsum" value="<?php echo ifset($_GET['qsale_realpriceomx']) ?>" onkeypress="return isNumberKey(event)" />
            
                <select id="filter_sale_currency" class="filter-select-currency">
                    <option value="<?php echo cur_GetCurrency('AMD'); ?>"><?php _e('currency_AMD') ?></option>
                    <option value="<?php echo cur_GetCurrency('USD'); ?>"><?php _e('currency_USD') ?></option>
                    <option value="<?php echo cur_GetCurrency('EUR'); ?>"><?php _e('currency_EUR') ?></option>
                    <option value="<?php echo cur_GetCurrency('RUR'); ?>"><?php _e('currency_RUR') ?></option>
                </select>
            </p>
        </div>
    </div>
    
    <div class="filtersdiv" id="filter_priceforrent" <?php if (!$expand_rent) { ?> style="display:none;" <?php } ?>>
        <div class="filterslbl">
            <p>
                <?php _e('Price for rent') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <input type="text" id="filter_rent_price_min" class="txtareabgsum" style="width:20%" value="<?php echo $_GET['qrent_realpriceomn'] ?>" onkeypress="return isNumberKey(event)" />
                <span> - </span>
                <input type="text" id="filter_rent_price_max" class="txtareabgsum" style="width:20%" value="<?php echo $_GET['qrent_realpriceomx'] ?>" onkeypress="return isNumberKey(event)" />
            
                <select id="filter_rent_currency" class="txtareabgcurrency" style="width:21%">
                    <option value="<?php echo cur_GetCurrency('AMD'); ?>"><?php _e('currency_AMD') ?></option>
                    <option value="<?php echo cur_GetCurrency('USD'); ?>"><?php _e('currency_USD') ?></option>
                    <option value="<?php echo cur_GetCurrency('EUR'); ?>"><?php _e('currency_EUR') ?></option>
                    <option value="<?php echo cur_GetCurrency('RUR'); ?>"><?php _e('currency_RUR') ?></option>
                </select>
                <select id="filter_rent_frequency" class="txtareabgcurrency" style="width:22%">
                    <option value="720"><?php _e('hourly'); ?></option>
                    <option value="24"><?php _e('daily'); ?></option>
                    <option value="1" selected="selected"><?php _e('monthly'); ?></option>
                    <option value="0.0833333333333333"><?php _e('annually'); ?></option>
                </select>
            </p>
        </div>
    </div>
    <div id="filter_priceforexchange" class="filtersdiv" <?php if (!$expand_exchange) { ?> style="display:none;" <?php } ?>>
        <div class="filterslbl">
            <p>
                <?php _e('Exchange with') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <input type="text" id="filter_exchange_with" disabled="disabled" class="txtbg defaultText" defaultvalue="<?php _e('What do you want in return') ?>" value="<?php echo replace_quotes($_GET['exchange_with']); ?>" size="30" />
                <br />
                <span class="hint"><?php echo sprintf(__('%s characters max'), 120); ?></span>
            </p>
        </div>
    </div>

    <div class="filtersdiv" id="filter_fordonation" <?php if (!$expand_donation) { ?> style="display:none;" <?php } ?>>
        <div class="filterslbl">
            <p>
                <?php _e('Donation') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <span style="font-size:110%; font-weight: bold;">
                    <?php _e('I need a donation...!!!') ?>
                </span>
            </p>
        </div>
    </div>

    <div class="filtersdiv" id="filter_forjob" <?php if (!$expand_salary) { ?> style="display:none;" <?php } ?>>
        <div class="filterslbl">
            <p>
                <?php _e('Salary') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <span style="font-size:110%; font-weight: bold;">
                    <?php _e('I need a job...!!!') ?>
                </span>
            </p>
        </div>
    </div>
<?php /*
    <div class="filtersdiv" id="filter_forservice" <?php if (!$expand_payment) { ?> style="display:none;" <?php } ?>>
        <div class="filterslbl">
            <p>
                <?php _e('Payment') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <span style="font-size:110%; font-weight: bold;">
                    <?php _e('I need a service...!!!') ?>
                </span>
            </p>
        </div>
    </div>
*/ ?>
    <div class="filtersdiv" id="filter_additional">
        <div class="filterslbl">
            <p>
                <?php _e('Additional') ?>:</p>
        </div>
        <div class="filtersctrl">
            <input type="checkbox" id="filter_additional_withimages" <?php if (isset($_GET['qfilesolk']) && $_GET['qfilesolk'] == 'image') { echo 'checked="checked"'; } ?> />
                <label for="filter_additional_withimages"><?php _e('Only with pictures') ?></label>
        </div>
    </div>
    <div class="filtersdiv" id="filter_forfilters">
        <div class="filterslbl">
            <p>
                <?php _e('Filters') ?>:</p>
        </div>
        <div class="filtersctrl">
            <p>
                <?php 
                $excludeList = array('item_location', 'sale_realprice', 'rent_realprice', 'allow_sale', 'allow_rent', 'allow_exchange', 'allow_donation', 'allow_salary', 'allow_payment', '', '', '', '');
                
                foreach($specfilters as $id => $filter)
                {
                    if (in_array($id, $excludeList))
                        continue;
                    
                    foreach($filter as $type => $value)
                    {
                        switch($type)
                        {
                            case 'oeq':
                                $class = 'green';
                                $operator = __('Include:');
                                break;
                            case 'omn':
                                $class = 'silver';
                                $operator = __('Above:');
                                break;
                            case 'omx':
                                $class = 'silver';
                                $operator = __('Up to:');
                                break;
                            case 'ono':
                                $class = 'orange';
                                $operator = __('Exclude:');
                                break;
                            case 'olk':
                                $class = 'blue';
                                $operator = 'LIKE';
                                break;
                        }
                        $item = GetFilterItem('[' . $id . ']', $value, 'content');
                        if ($item)
                            echo '<div filtername="' . $id . '" filtertypes="' . $type . '" filtervalue="' . $value . '" class="filter-item filter-' . $class . ' filter-container" >' . $operator . $item . '</div>';
                    }
                }
                ?>
                
                <style>
                    .filter-container
                    {}
                            
                    .filter-container div
                    {
                        margin-top: 3px;
                        margin-left: 8px;
                        margin-right: 4px !Important;
                    }
                </style>
            </p>
        </div>
    </div>
</div>

<div class="filtermenu-separator">
</div>

<div id="filtermenu">
    <div id="filtermenu-clr" filtertypes="clr" style="display: none;"><?php _e('Clear filter from "<span></span>"') ?></div>
    
    <div id="filtermenu-oeq" filtertypes="oeq" style="display: none;"><?php _e('Include: "<span></span>"') ?></div>
    <div id="filtermenu-ono" filtertypes="ono" style="display: none;"><?php _e('Exclude: "<span></span>"') ?></div>
    
    <div id="filtermenu-omn" filtertypes="omn" style="display: none;"><?php _e('Above: "<span></span>"') ?></div>
    <div id="filtermenu-omx" filtertypes="omx" style="display: none;"><?php _e('Up to: "<span></span>"') ?></div>
</div>

<?php
} //helper_filters

function helper_filters_left_footer()
{
    ?>
    <style>
        .filters-left-footer
        {
            text-align: center;
            font-size: 134%;
            -font-weight: bold;
            background-color: #51B9A9;
            position: fixed;
            bottom: 0px;
            z-index: 1000;
            width: 237px;
            height: 32px;
            padding-top: 8px;
            cursor: pointer;
            border: 1px solid #0063F8;
            -border-bottom: 0px;
            border-radius: 6px 6px 0px 0px;
            color: #eee;
            
            border-radius: 6px;
            bottom: 22px;
            font-size: 144%;
            padding-top: 6px;
            height: 28px;
            
            <?php $col1 = '#ff702a'; $col2 = '#ec500a'; ?>
            background: -moz-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: -webkit-gradient(linear,left top,left bottom,color-stop(0%, <?php echo $col1 ?>),color-stop(100%, <?php echo $col2 ?>)) !Important;
            background: -webkit-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: -o-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: -ms-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $col1 ?>', endColorstr='<?php echo $col2 ?>', GradientType=0 ) !Important;
            color: #55000000;
        }
        
        .filters-left-footer:hover
        {
            <?php $col1 = '#ec500a'; $col2 = '#ff702a'; ?>
            background: -moz-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: -webkit-gradient(linear,left top,left bottom,color-stop(0%, <?php echo $col1 ?>),color-stop(100%, <?php echo $col2 ?>)) !Important;
            background: -webkit-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: -o-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: -ms-linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            background: linear-gradient(top, <?php echo $col1 ?> 0%, <?php echo $col2 ?> 100%) !Important;
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $col1 ?>', endColorstr='<?php echo $col2 ?>', GradientType=0 ) !Important;
            color: #55000000;
        }
        
        .filters-left-footer-gradient
        {
            background-image: url('<?php echo site_url('/wp-includes/images/white_gradient.png') ?>');
            height: 40px;
            position: fixed;
            bottom: 36px;
            z-index: 999;
            width: 239px;
            cursor: default;
            
            height: 80px;
            bottom: 0px;
        }
    </style>
    <script>
    $(document).ready(function(){
        if ($('.filter-priority-secondary').length > 0)
            $('#showAllFilters').show();
            
        $('#showAllFilters').click(function() {
            $(this).hide();
            $('.filter-priority-secondary').slideDown();
        });
    });
    </script>
    
    <button id="showAllFilters" style="width: 238px; margin-top: 10px; height: 30px; display: none;"><?php _e('Show all filters') ?></button>
    
    <div class="filters-left-footer-gradient">
    </div>
    <div id="filters-left-footer-submit" class="filters-left-footer">
        <?php _e('Apply filters') ?>
    </div>
        
    <?php	
}

/* *************************** END ************************ */
/* ************************* Filters ********************** */
/* ******************************************************** */






/* ******************************************************** */
/* ******************** filter-renderers ****************** */
/* ************************** BEGIN *********************** */


function filter_group($id, $title, $priority = SECONDARY_FILTER)
{
?>
<div class="addpostinnerdiv_filters addpostgroup">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //filter_group

function filter_group_sub($id, $title, $priority = SECONDARY_FILTER)
{
?>
<div class="addpostinnerdiv_filters addpostsubgroup_filters ">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //filter_group_sub

if (!function_exists('replace_quotes'))
{
    function replace_quotes($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        $tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}

if (!function_exists('replace_quotes_decode'))
{
    function replace_quotes_decode($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        //$tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}

function filter_radio($id, $title = '', $values = array(), $cols = 4, $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $values	  = $args['values'];
        $cols	  = $args['cols'];
        $priority = $args['priority'];
        
        if (!isset($cols)) $cols = 4;
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    
    filter_begin($id, $title);
?>
        <table class="checkgrid_filters">
        <?php
    $i = 0;
    foreach ( $values as $v ) {
        if ($i % $cols == 0)
            echo '<tr>';
        
        echo '<td>';
        ?>
            <input type="radio" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>" class="checkareabgsum" value="<?php echo $v[0]; ?>" <?php if ($_GET['q' . $id] == $v[0]) { ?> checked="checked" <?php } ?> />
            <label for="<?php echo $id; ?>_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
            <?php
        
        echo '</td>';
        
        if ($i % $cols == $cols - 1)
            echo '</tr>';
        
        $i++;
    }
    if ($i % $cols != 0)
        echo '</tr>';
        ?>
        </table>
<?php
    filter_end($id, $title);
} //filter_radio

function filter_select_used($id, $byKeys = false)
{
    if ($byKeys) {
        foreach ( $values as $v ) {
            if (isset($_GET["q{$id}_{$v[0]}oeq"])) {
                return true;
                break;
            }
        }
    } else {
        if (isset($_GET["q{$id}oeq"]))
            return true;
    }
    return false;
} //filter_select_used

function filter_select_only($id, $values = array(), $byKeys = false, $fromDB = false)
{
    if (is_array($id)) {
        $args = $id;
        
        $id			= arg($args, 'id', '');
        $values		= arg($args, 'values', array());
        $byKeys		= arg($args, 'byKeys', false);
        $fromDB 	= arg($args, 'fromDB', true);
    }
    
    if ($byKeys) {
        if ($fromDB) {
            global $wpdb;
            
            $IDs = array();
            
            foreach ( $values as $i => $v ) {
                $IDs[] = "{$id}_{$v[0]}";
            }
            
            $filtredPostIds = get_specfilter_select_query($IDs);
            
            $IDs = "''";
            
            foreach ( $values as $i => $v ) {
                $IDs .= ",'post_{$id}_{$v[0]}'";
            }
            
            $bdb_values_query = "SELECT DISTINCT `meta_key` AS val
                                 FROM `{$wpdb->prefix}postmeta`
                                 WHERE `meta_key` IN ({$IDs}) AND `meta_value` = '1'";
                                
            if ($filtredPostIds !== false)
                $bdb_values_query .= " AND `post_id` IN ($filtredPostIds)";

            $bdb_values = $wpdb->get_results($bdb_values_query);

            $newValues = array();
            
            foreach ( $values as $i => $v ) {
                $haveValue = false;
                foreach($bdb_values as $value) {
                    if ($value->val == "post_{$id}_{$v[0]}") {
                        $haveValue = $i;
                        break;
                    }
                }
                if ($haveValue !== false)
                    array_push( $newValues, $values[$haveValue] );
            }
            
            $values = $newValues;
        }
 ?>
    <select id="<?php echo $id; ?>" class="select_filters">
        <option value=""><?php _e('Does not matter') ?></option>
        
        <?php foreach ( $values as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" style="<?php if (isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if (isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if (arg($_GET, 'q' . $id . '_' . $v[0] . 'oeq', 0) == 1) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
        <?php } ?>
    </select>
    <script>
    $(document).ready(function() {
        $('#<?php echo $id; ?>').change(function() {
            <?php foreach ( $values as $v ) { ?>
            advancedFilters['<?php echo $id ?>_<?php echo $v[0] ?>'] = [{ include: false }];
            <?php } ?>
            
            var value = $(this).find('option:checked').val();
            
            if (!(value == '')) {
                advancedFilters['<?php echo $id ?>_' + value] = [{type: 'oeq', value: 1, include: true }];
            }
        });
    });
    </script>
    <?php
    } else {
        if ($fromDB) {
            global $wpdb;
            $filtredPostIds = get_specfilter_select_query($id);
            
            $bdb_values_query = "SELECT DISTINCT `meta_value` AS val
                                 FROM `{$wpdb->prefix}postmeta`
                                 WHERE `meta_key` = 'post_{$id}' AND `meta_value` != ''";
                                
            if ($filtredPostIds !== false)
                $bdb_values_query .= " AND `post_id` IN ($filtredPostIds)";

            $bdb_values = $wpdb->get_results($bdb_values_query);
            
            $newValues = array();

            foreach ( $values as $i => $v ) {
                $haveValue = false;
                
                foreach($bdb_values as $value) {
                    if ($v[0] == $value->val) {
                        $haveValue = $i;
                        break;
                    }
                }
                
                if ($haveValue !== false)
                    array_push( $newValues, $values[$haveValue] );
            }
            $values = $newValues;
        }
    ?>
    <select id="<?php echo $id; ?>" class="select_filters">
        <option value="" <?php if (!isset($_GET["q{$id}oeq"])) { ?> selected="selected" <?php } ?> ><?php _e('Does not matter') ?></option>
        
        <?php foreach ( $values as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" style="<?php if (isset($v[2])) { echo "color: {$v[2]}; "; } ?><?php if (isset($v[3])) { echo "background-color: {$v[3]}; "; } ?>" <?php if (arg($_GET, "q{$id}oeq", '') == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
        <?php } ?>
    </select>
    <script>
    $(document).ready(function() {
        $('#<?php echo $id; ?>').change(function() {
            var value = $(this).find('option:checked').val();
            
            if (value == '') {
                advancedFilters['<?php echo $id ?>'] = [{ include: false }];
            } else {
                advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: value, include: true }];
            }
        });
    });
    </script>
    <?php
    }
} //filter_select_only

function filter_select($id, $title = '', $values = array(), $byKeys = false, $priority = SECONDARY_FILTER, $fromDB = true) {
    if (is_array($id)) {
        $args = $id;
        
        $id			= arg($args, 'id', '');
        $title		= arg($args, 'title', '');
        $values		= arg($args, 'values', array());
        $byKeys		= arg($args, 'byKeys', false);
        $priority	= arg($args, 'priority', SECONDARY_FILTER);
        $fromDB 	= arg($args, 'fromDB', true);
    }
    if ($byKeys) {
        foreach ( $values as $v ) {
            if (isset($_GET["q{$id}_{$v[0]}oeq"])) {
                $priority = USED_FILTER;
                break;
            }
        }
    } elseif (isset($_GET["q{$id}oeq"])) {
        $priority = USED_FILTER;
    }
    
    filter_begin($id, $title, false, $priority);
    
    if ($byKeys) {
        if ($fromDB) {
            global $wpdb;
            
            $IDs = array();
            
            foreach ($values as $i => $v) {
                $IDs[] = "{$id}_{$v[0]}";
            }
            
            $filtredPostIds = get_specfilter_select_query($IDs);
            
            $IDs = "''";
            
            foreach ( $values as $i => $v ) {
                $IDs .= ",'post_{$id}_{$v[0]}'";
            }
            
            $bdb_values_query = "SELECT DISTINCT `meta_key` AS val
                                 FROM `{$wpdb->prefix}postmeta`
                                 WHERE `meta_key` IN ({$IDs}) AND `meta_value` = '1'";
                                
            if ($filtredPostIds !== false)
                $bdb_values_query .= " AND `post_id` IN ($filtredPostIds)";

            $bdb_values = $wpdb->get_results($bdb_values_query);

            $newValues = array();
            
            foreach ($values as $i => $v) {
                $haveValue = false;
                foreach ($bdb_values as $value) {
                    if ($value->val == "post_{$id}_{$v[0]}") {
                        $haveValue = $i;
                        break;
                    }
                }
                if ($haveValue !== false)
                    array_push( $newValues, $values[$haveValue] );
            }
            
            $values = $newValues;
        }
 ?>
    <select id="<?php echo $id; ?>" class="select_filters">
        <option value=""><?php _e('Does not matter') ?></option>
        <?php foreach ( $values as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" style="<?php if (isset($v[2])) { echo "color: {$v[2]}; "; } ?><?php if (isset($v[3])) { echo "background-color: {$v[3]}; "; } ?>" <?php if (arg($_GET, "q{$id}_{$v[0]}oeq", 0) == 1) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
        <?php } ?>
    </select>
    <br />
    <br />
    <script>
    $(document).ready(function() {
        $('#<?php echo $id; ?>').change(function() {
            <?php foreach ( $values as $v ) { ?>
            advancedFilters['<?php echo $id ?>_<?php echo $v[0] ?>'] = [{ include: false }];
            <?php } ?>
            
            var value = $(this).find('option:checked').val();
            
            if (!(value == '')) {
                advancedFilters['<?php echo $id ?>_' + value] = [{type: 'oeq', value: 1, include: true }];
            }
        });
    });
    </script>
    <?php
    } else {
        if ($fromDB) {
            global $wpdb;
            $filtredPostIds = get_specfilter_select_query($id);
            
            $bdb_values_query = "SELECT DISTINCT `meta_value` AS val
                                 FROM `{$wpdb->prefix}postmeta`
                                 WHERE `meta_key` = 'post_{$id}' AND `meta_value` != ''";
                                
            if ($filtredPostIds !== false)
                $bdb_values_query .= " AND `post_id` IN ($filtredPostIds)";

            $bdb_values = $wpdb->get_results($bdb_values_query);
            
            $newValues = array();

            foreach ( $values as $i => $v ) {
                $haveValue = false;
                
                foreach($bdb_values as $value) {
                    if ($v[0] == $value->val) {
                        $haveValue = $i;
                        break;
                    }
                }
                
                if ($haveValue !== false)
                    array_push( $newValues, $values[$haveValue] );
            }
            $values = $newValues;
        }
    ?>
    <select id="<?php echo $id; ?>" class="select_filters">
        <option value="" <?php if (!isset($_GET["q{$id}oeq"])) { ?> selected="selected" <?php } ?> ><?php _e('Does not matter') ?></option>
        
        <?php foreach ( $values as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" style="<?php if (isset($v[2])) { echo "color: {$v[2]}; "; } ?><?php if (isset($v[3])) { echo "background-color: {$v[3]}; "; } ?>" <?php if (arg($_GET, "q{$id}oeq", '') == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
        <?php } ?>
    </select>
    <br />
    <br />
    <script>
    $(document).ready(function() {
        $('#<?php echo $id; ?>').change(function() {
            var value = $(this).find('option:checked').val();
            
            if (value == '') {
                advancedFilters['<?php echo $id ?>'] = [{ include: false }];
            } else {
                advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: value, include: true }];
            }
        });
    });
    </script>
    <?php
    }
    filter_end($id, $title);
} //filter_select

function filter_location($id, $title = '', $priority = SECONDARY_FILTER)
{
    
}

function filter_location_disabled($id, $title = '', $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id			= arg($args, 'id', '');
        $title		= arg($args, 'title', '');
        $priority	= arg($args, 'priority', SECONDARY_FILTER);
    }
    
    if (isset($_GET['q' . $id . 'oeq']))
        $priority = USED_FILTER;
        
    $regions = getRegions();
    
    filter_begin($id, $title, false, $priority);
    ?>
    <select id="<?php echo $id; ?>" class="select_filters">
        <option value="" <?php if (!isset($_GET['q' . $id . 'oeq'])) { ?> selected="selected" <?php } ?> ><?php _e('Does not matter') ?></option>
        
        <?php foreach ( $regions as $key => $value ) { ?>
            <option value="<?php echo $key; ?>" <?php if (arg($_GET, 'q' . $id . 'oeq', '') == $key) { ?> selected="selected" <?php } ?> ><?php echo $value; ?></option>
        <?php } ?>
    </select>
    <br />
    <br />
    <script>
    $(document).ready(function() {
        $('#<?php echo $id; ?>').change(function() {
            var value = $(this).find('option:checked').val();
            
            if (value == '') {
                advancedFilters['<?php echo $id ?>'] = [{ include: false }];
            } else {
                advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: value, include: true }];
            }
        });
    });
    </script>
    <?php
    filter_end($id, $title);
} //filter_select

function filter_check_key($id, $title = '', $key = array(), $values = array(), $cols = 4, $maxcount = 0, $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $key	  = $args['key'];
        $values	  = $args['values'];
        $cols	  = $args['cols'];
        $maxcount = $args['maxcount'];

        $priority = $args['priority'];
        
        if (!isset($cols)) $cols = 4;
        if (!isset($maxcount)) $maxcount = 0;
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    
    if (isset($_GET['q' . $id . '_' . $key[0] . 'oeq'])) {
        $priority = USED_FILTER;
    } else {
        foreach ( $values as $v ) {
            if (isset($_GET['q' . $id . '_' . $v[0] . 'oeq'])) {
                $priority = USED_FILTER;
                break;
            }
        }
    }
    
    filter_begin($id, $title, false, $priority);
                ?>
    <input type="checkbox" id="<?php echo $id; ?>_key_<?php echo $key[0]; ?>" class="checkareabgsum" value="1" <?php if (arg($_GET, 'q' . $id . '_' . $key[0] . 'oeq', 0) == 1) { ?> checked="checked" <?php } ?> />
    <label for="<?php echo $id; ?>_key_<?php echo $key[0]; ?>"> <?php echo $key[1]; ?> </label>
    <br />
    <div id="<?php echo $id; ?>_subs" style="border-top: 1px solid #eee;">
        <table class="checkgrid_filters">
        <?php
    $i = 0;
    foreach ( $values as $v ) {
        if ($i % $cols == 0)
            echo '<tr>';
        ?>
            <td>
                <input type="checkbox" id="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>" name="<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum switch_<?php echo $id; ?>" value="1" <?php if ($_GET['q' . $id . '_' . $v[0] . 'oeq'] == 1) { ?> checked="checked" <?php } ?> />
                <label for="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
            </td>
        <?php
        if ($i % $cols == $cols - 1)
            echo '</tr>';
        
        $i++;
    }
    if ($i % $cols != 0)
        echo '</tr>';
        ?>
        </table>
    </div>
    <script type="text/javascript">

    $(document).ready(function() {
        $("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").change(function(){
            if ($("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").is(':checked')) 
            {
                $('input.switch_<?php echo $id; ?>').each(function() {
                    $(this).removeAttr('checked');
                    advancedFilters[$(this).attr('name')] = [{ include: false }];
                });
                
                advancedFilters['<?php echo $id; ?>_<?php echo $key[0]; ?>'] = [{type: 'oeq', value: 1, include: true }];
            } else {
                advancedFilters['<?php echo $id; ?>_<?php echo $key[0]; ?>'] = [{ include: false }];
            }
        });
        $('input.switch_<?php echo $id; ?>').change(function(){
            $("#<?php echo $id; ?>_key_<?php echo $key[0]; ?>").removeAttr('checked');
            advancedFilters['<?php echo $id; ?>_<?php echo $key[0]; ?>'] = [{ include: false }];
            
            if ($(this).is(':checked')) {
                advancedFilters[$(this).attr('name')] = [{type: 'oeq', value: 1, include: true }];
            } else {
                advancedFilters[$(this).attr('name')] = [{ include: false }];
            }
        });
    });

    </script>
    <?php
    filter_end($id, $title);
} //filter_check

function filter_check($id, $title = '', $values = array(), $cols = 4, $maxcount = 0, $priority = SECONDARY_FILTER) {
    if (is_array($id)) {
        $args = $id;
        
        $id		  = arg($args, 'id');
        $title	  = arg($args, 'title');
        $values	  = arg($args, 'values', array());
        $cols	  = arg($args, 'cols', 4);
        $maxcount = arg($args, 'maxcount', 0);
        $priority = arg($args, 'priority', SECONDARY_FILTER);
        
        if (!isset($cols)) $cols = 4;
        if (!isset($maxcount)) $maxcount = 0;
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    
    foreach ( $values as $v ) {
        if (isset($_GET["q{$id}_{$v[0]}oeq"])) {
            $priority = USED_FILTER;
            break;
        }
    }
    
    filter_begin($id, $title, false, $priority);
?>
    <table class="checkgrid_filters">
    <?php
    $i = 0;
    foreach ( $values as $v ) {
        if ($i % $cols == 0)
            echo '<tr>';
    ?>
        <td>
            <input type="checkbox" id="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>" name="<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum switch_<?php echo $id; ?>" value="1" <?php if (arg($_GET, "q{$id}_{$v[0]}oeq", 0) == 1) { ?> checked="checked" <?php } ?> />
            <label for="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
        </td>
    <?php
        if ($i % $cols == $cols - 1)
            echo '</tr>';
        
        $i++;
    }
    if ($i % $cols != 0)
        echo '</tr>';
    ?>
    </table>
    <script type="text/javascript">

    $(document).ready(function() {
        $('input.switch_<?php echo $id; ?>').change(function() {
            if ($(this).is(':checked')) {
                advancedFilters[$(this).attr('name')] = [{type: 'oeq', value: 1, include: true }];
            } else {
                advancedFilters[$(this).attr('name')] = [{ include: false }];
            }
        });
    });

    </script>
    <?php
    filter_end($id, $title);
} //filter_check

function filter_check_v1($id, $title, $values, $cols = 4, $maxcount = 0, $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $values	  = $args['values'];
        $cols	  = $args['cols'];
        $maxcount = $args['maxcount'];

        $priority = $args['priority'];
        
        if (!isset($cols)) $cols = 4;
        if (!isset($maxcount)) $maxcount = 0;
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }

    filter_begin($id, $title, false, $priority);
?>
        <table class="checkgrid_filters">
        <?php
    $i = 0;
    foreach ( $values as $v ) {
        if ($i % $cols == 0)
            echo '<tr>';
        
        echo '<td>';
        ?>
            <input type="checkbox" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum" value="1" <?php if ($_GET['q' . $id . '_' . $v[0]] == 1) { ?> checked="checked" <?php } ?> />
            <label for="<?php echo $id; ?>_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
            </span>
            <?php
        
        echo '</td>';
        
        if ($i % $cols == $cols - 1)
            echo '</tr>';
        
        $i++;
    }
    if ($i % $cols != 0)
        echo '</tr>';
        ?>
        </table>
<script type="text/javascript">

$("#<?php echo $id; ?>_<?php echo $key[0]; ?>").change(function(){
    if ($("#<?php echo $id; ?>_<?php echo $key[0]; ?>").is(':checked')) 
    {
        $("#<?php echo $id; ?>_subs").fadeOut("slow");
    }
    else
    {
        $("#<?php echo $id; ?>_subs").fadeIn("slow");
    }
});

</script>
<?php
    filter_end($id, $title);
} //filter_check

function filter_yes_no($id, $title = '', $half = false, $priority = SECONDARY_FILTER, $hideYes = false, $hideNo = false)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = arg($args, 'id', '');
        $title	  = arg($args, 'title', '');
        $half	  = arg($args, 'half', false);

        $priority = arg($args, 'priority', SECONDARY_FILTER);
        
        $hideYes  = arg($args, 'hideYes', false);
        $hideNo   = arg($args, 'hideNo', false);
    }
    
    if (isset($_GET['q' . $id . 'oeq']))
        $priority = USED_FILTER;
    
    filter_begin($id, $title, $half, $priority);
?>
        <?php if (!$hideYes) : ?><div id="<?php echo $id; ?>_img_yes" class="check-span check-span-editable check-yes"></div><?php endif; ?>
        <?php if (!$hideNo)  : ?><div id="<?php echo $id; ?>_img_no" class="check-span check-span-editable check-no"></div><?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#<?php echo $id; ?>_img_no').click(statechanged_<?php echo $id; ?>_no);
        $('#<?php echo $id; ?>_img_yes').click(statechanged_<?php echo $id; ?>_yes);
        
        var val = '<?php echo $_GET['q' . $id . 'oeq']; ?>';
        
        if (val == '1') {
            $('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
        } else if (val == '2') {
            $('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
        }
    });
    
    function statechanged_<?php echo $id; ?>_no()
    {
        $('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
        $('#<?php echo $id; ?>_img_yes').addClass('check-yes');
        $('#<?php echo $id; ?>_img_yes').removeClass('check-yes-checked');
        
        if ($('#<?php echo $id; ?>_img_no').hasClass('check-no-checked')) {
                advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: 1, include: true }];
        } else {
                advancedFilters['<?php echo $id ?>'] = [{ include: false }];
        }
    }
    
    function statechanged_<?php echo $id; ?>_yes()
    {
        $('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
        $('#<?php echo $id; ?>_img_no').addClass('check-no');
        $('#<?php echo $id; ?>_img_no').removeClass('check-no-checked');
        
        if ($('#<?php echo $id; ?>_img_yes').hasClass('check-yes-checked')) {
                advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: 2, include: true }];
        } else {
                advancedFilters['<?php echo $id ?>'] = [{ include: false }];
        }
    }
</script>
<?php

    filter_end($id, $title);
} //filter_yes_no

function filter_slider($id, $title = '', $rate = 1, $min = 0, $max = 100, $text = '', $begin = '', $end = '', $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $rate	  = $args['rate'];
        $min	  = $args['min'];
        $max	  = $args['max'];
        $text	  = $args['text'];
        $begin	  = $args['begin'];
        $end	  = $args['end'];
        $priority = $args['priority'];
        
        if (!isset($begin)) $begin = '';
        if (!isset($rate)) $rate = 1;
        if (!isset($end)) $end = '';
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    $value = __('Does not matter');
    $minVal = (isset($_GET['q' . $id . 'omn'])) ? ($_GET['q' . $id . 'omn'] / $rate) : $min;
    $maxVal = (isset($_GET['q' . $id . 'omx'])) ? ($_GET['q' . $id . 'omx'] / $rate) : $max;
    
    if (isset($_GET['q' . $id . 'omn']) || isset($_GET['q' . $id . 'omx']))
        $priority = USED_FILTER;
    
    filter_begin($id, $title, false, $priority);
?>
        <input type="hidden" id="<?php echo $id; ?>" class="txtbg" value="<?php echo $_GET['q' . $id]; ?>" size="30" name="post_<?php echo $id; ?>" />
        <div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; -font-weight:bold; font-size: 120%"><?php echo $value ?></div>
        
        <br />
        <!-- Begin - Slite for total_area -->
        <div style="padding-left: 10px; padding-right: 10px;">
        <div id="slider_<?php echo $id ?>"></div>
        </div>
        <div style="width:43%; float:left; margin-left: 11px; float: left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if ($begin == '') echo _f($text, $min * $rate); else echo _f($begin, $min * $rate); ?></div>
        <div style="width:43%; float:left; margin-right: 10px; float: right; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max * $rate); else echo _f($end, $max * $rate); ?></div>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#slider_<?php echo $id; ?>').slider({
                range: true,
                values: [<?php echo $minVal; ?>, <?php echo $maxVal; ?>],
                
                min: <?php echo $min ?>,
                max: <?php echo $max ?>,
                slide: function( event, ui ) {
                
                    var str_<?php echo $id ?> = '<?php echo $text ?>';
                
                    if ((ui.values[0] == <?php echo $min ?>) && (ui.values[1] == <?php echo $max ?>))
                        $( '#<?php echo $id ?>_view' ).text( '<?php echo $value ?>' );
                    else
                        $( '#<?php echo $id ?>_view' ).text(
                                                        str_<?php echo $id ?>.replace('%s', Math.round(1000 * (ui.values[0] * <?php echo $rate ?>)) / 1000 )
                                                        + ' - ' +
                                                        str_<?php echo $id ?>.replace('%s', Math.round(1000 * (ui.values[1] * <?php echo $rate ?>)) / 1000 )
                                                    );
                    var minValue = Math.round(1000 * (ui.values[0] * <?php echo $rate ?>)) / 1000;
                    var maxValue = Math.round(1000 * (ui.values[1] * <?php echo $rate ?>)) / 1000;
                
                    advancedFilters['<?php echo $id ?>'] = [
                        {type: 'omn', value: minValue, include: (ui.values[0] != <?php echo $min ?>)},
                        {type: 'omx', value: maxValue, include: (ui.values[1] != <?php echo $max ?>)}
                                                    ];
                    
                    
                } // slide: function
            }) // $slider
        
            var str_<?php echo $id ?> = '<?php echo $text ?>';
            
            if (($( '#slider_<?php echo $id ?>' ).slider( 'values', 0 ) == <?php echo $min ?>) && ($( '#slider_<?php echo $id ?>' ).slider( 'values', 1 ) == <?php echo $max ?>))
                $( '#<?php echo $id ?>_view' ).text( '<?php echo $value ?>' );
            else
                $( '#<?php echo $id ?>_view' ).text(
                                                    str_<?php echo $id ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $id ?>' ).slider( 'values', 0 ) * <?php echo $rate ?>)) / 1000 )
                                                    + ' - ' +
                                                    str_<?php echo $id ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $id ?>' ).slider( 'values', 1 ) * <?php echo $rate ?>)) / 1000 )
                                                );
                
        }); // $(document).ready

    </script> 
    <!-- End --- Slite for total_area -->
                
    <?php

    filter_end($id, $title);
} //filter_slider

function filter_text($id, $title = '', $default = '', $hint = '', $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $default  = $args['default'];
        $hint	  = $args['hint'];
        $priority = $args['priority'];
        
        if (!isset($hint)) $hint = '';
        if (!isset($default)) $default = '';
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    $value = replace_quotes($_GET['q' . $id . 'olk']);
    
    if (isset($_GET['q' . $id . 'olk']))
        $priority = USED_FILTER;
        
    filter_begin($id, $title, false, $priority);
                ?>
    <input type="text" id="<?php echo $id; ?>" class="txtbg defaultText filter-input" style="width: 220px;" defaultvalue="<?php echo $default; ?>" value="<?php echo $value; ?>" size="30" />
    <?php
    
    if ($hint)
    {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#<?php echo $id; ?>').change(function() {
                advancedFilters['<?php echo $id ?>'] = [ {type: 'olk', value: $('#<?php echo $id ?>').val(), include: ($('#<?php echo $id ?>').val().trim().length > 0)} ];
            });
        }); // $(document).ready
    </script>
    <?php
    filter_end($id, $title);
} //filter_text

function filter_phone_number_v1($id, $title = '', $default = '', $hint = '', $priority = SECONDARY_FILTER) {
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $default  = $args['default'];
        $hint	  = $args['hint'];
        $priority = $args['priority'];
        
        if (!isset($hint)) $hint = '';
        if (!isset($default)) $default = '';
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    $value = replace_quotes($_GET['q' . $id . 'olk']);
    
    if (isset($_GET['q' . $id . 'olk'])) {
        $priority = USED_FILTER;
    }
    
    filter_begin($id, $title, false, $priority);
    ?>
    <input type="text" id="<?php echo $id; ?>" class="txtbg defaultText filter-input" style="width: 220px;" defaultvalue="<?php echo $default; ?>" value="<?php echo str_replace('%', '', $value); ?>" size="30" />
    <?php
    
    if ($hint) {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#<?php echo $id; ?>').change(function() {
                var value = $('#<?php echo $id ?>').val();
                var number = '%';
                for (i=0; i<value.length; i++) {
                    var n = value.charAt(i);
                    if (n >= '0' && n <= '9') {
                        number += n + '%';
                    }
                }
                advancedFilters['<?php echo $id ?>'] = [ {type: 'olk', value: number, include: ($('#<?php echo $id ?>').val().trim().length > 0)} ];
            });
        }); // $(document).ready
    </script>
    <?php
    filter_end($id, $title);
} //filter_text

function filter_phone_number($id, $title = '', $default = '', $hint = '', $priority = SECONDARY_FILTER) {
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $default  = $args['default'];
        $hint	  = $args['hint'];
        $priority = $args['priority'];
        
        if (!isset($hint)) $hint = '';
        if (!isset($default)) $default = '';
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    
    if (isset($_GET["q{$id}opn"])) {
        $priority = USED_FILTER;
        $value = preg_replace('/\D/', '', $_GET["q{$id}opn"]);
    } else {
        $value = '';
    }
    
    filter_begin($id, $title, false, $priority);
    ?>
    <input type="text" id="<?php echo $id; ?>" class="txtbg defaultText filter-input" style="width: 220px;" defaultvalue="<?php echo $default; ?>" value="<?php echo $value ?>" size="30" />
    <?php
    
    if ($hint) {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#<?php echo $id; ?>').change(function() {
                var value = $('#<?php echo $id ?>').val();
                var number = '';
                for (i=0; i < value.length; i++) {
                    var n = value.charAt(i);
                    if ((n >= '1' && n <= '9') || (number != '' && n == '0')) {
                        number += n;
                    }
                }
                advancedFilters['<?php echo $id ?>'] = [ {type: 'opn', value: number, include: ($('#<?php echo $id ?>').val().trim().length > 0)} ];
            });
        }); // $(document).ready
    </script>
    <?php
    filter_end($id, $title);
} //filter_text

function filter_datepicker($id, $title = '', $minDate = 0, $hint = '', $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
                    
        $id		  = $args['id'];
        $title	  = $args['title'];
        $minDate  = $args['minDate'];
        $hint	  = $hint['hint'];
        $priority = $args['priority'];
                    
        if (!isset($minDate)) $minDate = 0;
        if (!isset($hint)) $hint = '';
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    
    
    
    filter_begin($id, $title, false, $priority);
?>
    <input type="text" id="alternate_<?php echo $id; ?>" class="txtbg" style="width: 45%; text-align: center;" value="<?php echo replace_quotes($_GET['qalternate_' . $id]); ?>" disabled="disabled">
    <input type="hidden" id="<?php echo $id; ?>" name="post_alternate_<?php echo $id; ?>" value="<?php echo replace_quotes($_GET['qalternate_' . $id]); ?>">
    
    <div id="datepicker_<?php echo $id; ?>" style="line-height: 1;"></div>
    
    <script type="">
        $(document).ready(function() {
            <?php if (WPLANG == 'en_EN') echo '
                var loc = "en-GB";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            <?php if (WPLANG == 'ru_RU') echo '
                var loc = "ru";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            <?php if (WPLANG == 'am_HY') echo '
                var loc = "hy";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            
            $('#datepicker_<?php echo $id; ?>')
                .datepicker({ 
                    minDate: '<?php echo $minDate; ?>',
                    altField: "#alternate_<?php echo $id; ?>",
                    altFormat: formatalt,
                    onSelect: function(dateText, inst) {
                        $('#<?php echo $id; ?>').val(dateText);
                    }
                });
                
            $('#datepicker_<?php echo $id; ?>').datepicker( "option", $.datepicker.regional[ loc ] );
        });
    </script>
    <?php
    
    if ($hint)
    {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
    
    filter_end($id, $title);
} //filter_text
/*
function filter_number($id, $title = '', $default = '', $units = array(), $hint = '', $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = $args['id'];
        $title	  = $args['title'];
        $default  = $args['default'];
        $units	  = $args['units'];
        $hint	  = $args['hint'];

        $priority = $args['priority'];
        
        if (!isset($hint)) $hint = '';
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    
    if (isset($_GET['q' . $id]))
        $priority = USED_FILTER;
    
    filter_begin($id, $title, false, $priority);
    ?>
        <input type="text" id="<?php echo $id; ?>" class="txtbg defaultText" style="width: 150px;" defaultvalue="<?php echo $default; ?>" value="<?php echo replace_quotes($_GET['q' . $id]); ?>" size="30" name="post_<?php echo $id; ?>" onkeypress="return isNumberKey(event)">
        <?php
    
    if ($hint)
    {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
        ?>
        <select id="<?php echo $id; ?>_unit" name="post_<?php echo $id; ?>_unit" style="width: 70px;">
        <?php foreach ( $units as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" <?php if ($_GET['q' . $id . '_unit'] == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
        <?php } ?>
        </select>
<?php
    filter_end($id, $title);
} //filter_text
*/
function filter_number($id, $title = '', $units = array(), $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = arg($args, 'id', '');
        $title	  = arg($args, 'title', '');
        $priority = arg($args, 'priority', SECONDARY_FILTER);
        $units	  = arg($args, 'units', array());
    }
    
    $value = __('Does not matter');
    if (isset($_GET['q' . $id . 'omn']) || isset($_GET['q' . $id . 'omx']))
        $priority = USED_FILTER;
    
    foreach($units as $uId => $unit) {
        $unitId = $id . '_unit_' . $uId;
        
        $unitName = arg($unit, 'name', 1);
        $rate	  = arg($unit, 'rate', 1);
        $min	  = arg($unit, 'min', 0);
        $max	  = arg($unit, 'max', 100);
        $text	  = arg($unit, 'text', '');
        $begin	  = arg($unit, 'begin', '');
        $end	  = arg($unit, 'end', '');
        
        $minVal = (isset($_GET['q' . $id . 'omn'])) ? ($_GET['q' . $id . 'omn'] / $rate) : $min;
        $maxVal = (isset($_GET['q' . $id . 'omx'])) ? ($_GET['q' . $id . 'omx'] / $rate) : $max;
    
        filter_begin($id, $title . '<br /><small>(' . $unitName . ')</small>', false, $priority);
    
    ?>
        <input type="hidden" id="<?php echo $unitId; ?>" class="txtbg" value="<?php echo $_GET['q' . $unitId]; ?>" size="30" name="post_<?php echo $unitId; ?>" />
        <div id="<?php echo $unitId; ?>_view" style="width:100%; float:left; text-align:center; -font-weight:bold; font-size: 120%"><?php echo $value ?></div>
        
        <br />
        <!-- Begin - Slite for total_area -->
        <div style="padding-left: 10px; padding-right: 10px;">
        <div id="slider_<?php echo $unitId ?>"></div>
        </div>
        <div style="width:43%; float:left; margin-left: 11px; float: left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if ($begin == '') echo _f($text, $min * $rate); else echo _f($begin, $min * $rate); ?></div>
        <div style="width:43%; float:left; margin-right: 10px; float: right; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max * $rate); else echo _f($end, $max * $rate); ?></div>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#slider_<?php echo $unitId; ?>').slider({
                    range: true,
                    values: [<?php echo $minVal; ?>, <?php echo $maxVal; ?>],
                
                    min: <?php echo $min ?>,
                    max: <?php echo $max ?>,
                    slide: function( event, ui ) {
                
                        var str_<?php echo $unitId ?> = '<?php echo $text ?>';
                
                        if ((ui.values[0] == <?php echo $min ?>) && (ui.values[1] == <?php echo $max ?>))
                            $( '#<?php echo $unitId ?>_view' ).text( '<?php echo $value ?>' );
                        else
                            $( '#<?php echo $unitId ?>_view' ).text(
                                                            str_<?php echo $unitId ?>.replace('%s', Math.round(1000 * (ui.values[0] * <?php echo $rate ?>)) / 1000 )
                                                            + ' - ' +
                                                            str_<?php echo $unitId ?>.replace('%s', Math.round(1000 * (ui.values[1] * <?php echo $rate ?>)) / 1000 )
                                                        );
                        var minValue = Math.round(1000 * (ui.values[0] * <?php echo $rate ?>)) / 1000;
                        var maxValue = Math.round(1000 * (ui.values[1] * <?php echo $rate ?>)) / 1000;
                
                    advancedFilters['<?php echo $id ?>'] = [
                            {type: 'omn', value: minValue, include: (ui.values[0] != <?php echo $min ?>)},
                            {type: 'omx', value: maxValue, include: (ui.values[1] != <?php echo $max ?>)}
                                                        ];
                    
                    
                    } // slide: function
                }) // $slider
        
                var str_<?php echo $unitId ?> = '<?php echo $text ?>';
            
                if (($( '#slider_<?php echo $unitId ?>' ).slider( 'values', 0 ) == <?php echo $min ?>) && ($( '#slider_<?php echo $unitId ?>' ).slider( 'values', 1 ) == <?php echo $max ?>))
                    $( '#<?php echo $unitId ?>_view' ).text( '<?php echo $value ?>' );
                else
                    $( '#<?php echo $unitId ?>_view' ).text(
                                                        str_<?php echo $unitId ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $unitId ?>' ).slider( 'values', 0 ) * <?php echo $rate ?>)) / 1000 )
                                                        + ' - ' +
                                                        str_<?php echo $unitId ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $unitId ?>' ).slider( 'values', 1 ) * <?php echo $rate ?>)) / 1000 )
                                                    );
                
            }); // $(document).ready

        </script> 
        <!-- End --- Slite for total_area -->
                
    <?php
        filter_end($id, $title);
    }
} //filter_slider


function filter_slider_by_list($id, $title = '', $value = '', $min = 1, $max = 100, $text = '', $list = array(), $begin = '', $end = '', $priority = SECONDARY_FILTER)
{
    filter_slider_by_list2($id, $title, $min, $max, $value, $text, $list, $begin = '', $end = '', $priority);
}

function filter_slider_by_list2($id, $title = '', $min = 0, $max = 100, $format = '', $text = '', $list = array(), $begin = '', $end = '', $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = arg($args, 'id');
        $title	  = arg($args, 'title');
        $min	  = arg($args, 'min');
        $max	  = arg($args, 'max');
        $list	  = arg($args, 'listItems' , array());
        $format	  = arg($args, 'format', '%s');
        $text	  = arg($args, 'text', '%s');
        $textAll  = arg($args, 'textAll', __('Does not matter'));
        $textMore = arg($args, 'textMore', __('%s or more'));
        $textUpTo = arg($args, 'textUpTo', __('up to %s'));
        $begin	  = arg($args, 'begin', '');
        $end	  = arg($args, 'end', '');
        $priority = arg($args, 'priority', SECONDARY_FILTER);
    }
    
    $textAll  = isset($textAll) ? $textAll : __('Does not matter');
    $textMore = isset($textMore) ? $textMore : __('%s or more');
    $textUpTo = isset($textUpTo) ? $textUpTo : __('up to %s');
    
    $minVal = arg($_GET, 'q' . $id . 'omn', $min);
    $maxVal = arg($_GET, 'q' . $id . 'omx', $max);
    
    if ($minVal != $min || $maxVal != $max)
        $priority = USED_FILTER;
    
    filter_begin($id, $title, false, $priority);
    
?>
    <div id="<?php echo $id ?>_view" class="filter-slider-list-label"><?php echo $textAll ?></div>

    <br />
    <!-- Begin - Slite for total_area -->
    <div style="padding-left: 10px; padding-right: 10px;">
        <div id="slider_<?php echo $id ?>"></div>
    </div>

    <div style="width:43%; float:left; margin-left: 11px; float: left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if ($begin == '') echo _f($text, $min); else echo _f($begin, $min); ?></div>
    <div style="width:43%; float:left; margin-right: 10px; float: right; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;"><?php if ($end == '') echo _f($text, $max); else echo _f($end, $max); ?></div>
    <br />
    <br />
    <d filterSliderList>
        <d name><?php echo $id ?></d>
        <d text><?php echo $text ?></d>
        <d format><?php echo $format ?></d>
        <d min><?php echo $min ?></d>
        <d max><?php echo $max ?></d>
        <d textAll><?php echo $textAll ?></d>
        <d textMore><?php echo $textMore ?></d>
        <d textUpTo><?php echo $textUpTo ?></d>
        <d minVal><?php echo $minVal ?></d>
        <d maxVal><?php echo $maxVal ?></d>
        <d fulllist>
        <?php
    foreach($list as $key => $value)
    {
        echo '<d key="' . $key . '">' . $value . '</d>';
    }
        ?>
        </d>
    </d>
<?php
    filter_end($id, $title);

} //filter_slider


function filter_begin($id, $title, $half = false, $priority = SECONDARY_FILTER)
{
$priorityClass = ($priority == USED_FILTER) ? "filter-priority-used" : (($priority == PRIMARY_FILTER) ? "filter-priority-primary" : (($priority == SECONDARY_FILTER) ? "filter-priority-secondary" : ""));
?>
<div class="addpostinnerdiv_filters<?php if ($half) echo '-half'; ?> <?php echo $priorityClass ?>" id="filtercontainer_<?php echo $id; ?>" <?php the_hint($id); ?>>
<?php if ($title) { ?>
    <div class="addpostlbl_filters<?php if ($half) echo '-half'; ?>">
        <?php echo $title; ?>
    </div>
    <div class="addpostctrl_filters<?php if ($half) echo '-half'; ?> radio">
<?php } else { ?>
    <div class="addpostctrl_filters-full radio">
<?php } ?>
    <?php
}

function filter_end($id = '', $title = '')
{
?>
    </div>
</div>
<?php
}


function _obsolete_filter_slider_by_list($id, $title, $value, $min, $max, $text, $list, $begin = '', $end = '')
{
    $minVal = ($_GET['q' . $id . 'omn'] != '') ? $_GET['q' . $id . 'omn'] : $min;
    $maxVal = ($_GET['q' . $id . 'omx'] != '') ? $_GET['q' . $id . 'omx'] : $max;
    
    filter_begin($id, $title);
    ?>
    <div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; -font-weight:bold; font-size: 120%"><?php echo __('Does not matter'); ?></div>

    <br />
    <!-- Begin - Slite for total_area -->
    <div style="padding-left: 10px; padding-right: 10px;">
        <div id="slider_<?php echo $id ?>"></div>
    </div>

    <div style="width:43%; float:left; margin-left: 11px; float: left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if ($begin == '') echo _f($text, $min); else echo _f($begin, $min); ?></div>
    <div style="width:43%; float:left; margin-right: 10px; float: right; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max); else echo _f($end, $max); ?></div>
    <br />
    <br />

    <script type="text/javascript">
        $(document).ready(function() {
        
            var fulllist_<?php echo $id; ?> = [
            '<?php echo $value ?>',

            <?php
    for($i = $min; $i <= $max; $i += 1)
    {
        echo '\'';
        
        if ($list[$i])
            echo sprintf($list[$i], $i);
        else
            echo sprintf($text, $i);
        
        echo '\'';
        
        if ($i < $max)
            echo ', ';
    }
            ?>
            ];
        
            $('#slider_<?php echo $id; ?>').slider({
                range: true,
                values: [<?php echo $minVal; ?>, <?php echo $maxVal; ?>],
                
                min: <?php echo $min ?>,
                max: <?php echo $max ?>,
                slide: function( event, ui ) {
                
                var str_<?php echo $id ?> = '<?php echo $text ?>';
                
                $( '#<?php echo $id ?>_view' ).text(
                                                        str_<?php echo $id ?>.replace('%s', ui.values[0])
                                                        + ' - ' +
                                                        str_<?php echo $id ?>.replace('%s', ui.values[1])
                                                    );
                var minValue = ui.values[0];
                var maxValue = ui.values[1];
                
                advancedFilters['<?php echo $id ?>'] = [
                            {type: 'omn', value: minValue, include: (ui.values[0] != <?php echo $min ?>)},
                            {type: 'omx', value: maxValue, include: (ui.values[1] != <?php echo $max ?>)}
                                                    ];
                                                    
            } // slide: function
        }) // $slider
        
        var str_<?php echo $id ?> = '<?php echo $text ?>';
                $( '#<?php echo $id ?>_view' ).text(
                                                        str_<?php echo $id ?>.replace('%s', $( '#slider_<?php echo $id ?>' ).slider( 'values', 0 ) )
                                                        + ' - ' +
                                                        str_<?php echo $id ?>.replace('%s', $( '#slider_<?php echo $id ?>' ).slider( 'values', 1 ) )
                                                    );
                
    }); // $(document).ready

        </script> 
        <!-- End --- Slite for total_area -->
        
    <?php
    filter_end($id, $title);

} //filter_slider


function _obsolete_filter_yearselector($id, $title, $beginvalue, $endvalue, $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
                    
        $id		  = $args['id'];
        $title	  = $args['title'];
        $beginvalue = $args['beginvalue'];
        $endvalue = $args['endvalue'];
        $priority = $args['priority'];
                    
        if (!isset($priority)) $priority = SECONDARY_FILTER;
    }
    
    if (isset($_GET['q' . $id]) || isset($_GET['q' . $id]))
        $priority = USED_FILTER;
    
    filter_begin($id, $title, false, $priority);
?>
        <select id="<?php echo $id; ?>"  name="post_<?php echo $id; ?>" class="txtareabgcurrency">
                <option value="0" selected="selected">
                <?php _e('Select year') ?>
                </option>
                <option value="<?php echo $beginvalue ?>" <?php if ($_GET['q' . $id] == $beginvalue) { echo 'selected="selected"'; } ?>><?php echo sprintf(__('%s and older'), $beginvalue); ?></option>
                <?php for($i = $beginvalue + 1; $i <= $endvalue; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if ($_GET['q' . $id] == $i) { echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        <script type="text/javascript">
        $(function() {
            var select_<?php echo $id; ?> = $( "#<?php echo $id; ?>" );
            var slider_<?php echo $id; ?> = $( "<div id='slider_<?php echo $id; ?>'></div>" ).insertAfter( select_<?php echo $id; ?> ).slider({
                min: 1,
                max: <?php echo 2 + $endvalue - $beginvalue ?>,
                range: "min",
                value: select_<?php echo $id; ?>[ 0 ].selectedIndex + 1,
                slide: function( event, ui ) {
                    select_<?php echo $id; ?>[ 0 ].selectedIndex = ui.value - 1;
                }
            });
            
            $("<br /><br />").insertAfter( select_<?php echo $id; ?> );
            
            $( "#<?php echo $id; ?>" ).change(function() {
                slider_<?php echo $id; ?>.slider( "value", this.selectedIndex + 1 );
            });
        });
        </script> 
<?php
    filter_end($id, $title);
} //filter_yearselector

/* *************************** END ************************ */
/* ******************** filter-renderers ****************** */
/* ******************************************************** */







/* ******************************************************** */
/* ******************** ba-helper-price *** *************** */
/* ************************** BEGIN *********************** */


function helper_price($params = array())
{
    $defaults = array(
        'allow_donation' => false,
        'allow_sale' => true,
        'allow_rent' => true,
        'allow_exchange' => true,
        
        'donate' => false,
        'sale' => false,
        'rent' => false,
        'exchange' => false
    );
    
    $result = array_merge ($defaults, $params);
    
    $is_single = ($result['allow_donation'] ? 1 : 0) + ($result['allow_sale'] ? 1 : 0) + ($result['allow_rent'] ? 1 : 0) + ($result['allow_exchange'] ? 1 : 0) == 1;
    
    $show_donation  = ($is_single && $result['allow_donation']) || _p_isset('allow_donation');
    $show_sale      = ($is_single && $result['allow_sale'])     || _p_isset('allow_sale');
    $show_rent      = ($is_single && $result['allow_rent'])     || _p_isset('allow_rent');
    $show_exchange  = ($is_single && $result['allow_exchange']) || _p_isset('allow_exchange');
    
if ($is_single) {
    
    if ($show_donation) {
        echo '<input name="post_allow_donation" type="hidden" value="1" />';
    } elseif ($show_sale) {
        echo '<input name="post_allow_sale"     type="hidden" value="1" />';
    } elseif ($show_rent) {
        echo '<input name="post_allow_rent"     type="hidden" value="1" />';
    } elseif ($show_exchange) {
        echo '<input name="post_allow_exchange" type="hidden" value="1" />';
    }
    
} else {
?>
<div class="addpostinnerdiv" id="container_price" <?php the_hint($id); ?>>
    <div class="addpostlbl">
        <p>
            <?php _e('Transaction type') ?><span style="color: red;">*</span>:</p>
            </div>
            <div class="addpostctrl">
            <p>
            
            <?php if ($result['allow_donation']) { ?>
            <input type="checkbox" id="allow_donation" name="post_allow_donation" class="checkareabgsum" value="1" <?php if ($show_donation) { ?> checked="checked" <?php } ?> />
            <label for="allow_donation">
                <?php _e('donate'); ?>
            </label>
            
            <span id="allpricesbuttons"  <?php if ($_POST['post_allow_donation']) { ?> style="display:none;" <?php } ?>> <span>|</span>
            
            <?php } else { ?>
                <span>
            <?php } ?>
            
            <?php if ($result['allow_sale']) { ?>

            <input type="checkbox" id="allow_sale" name="post_allow_sale" class="checkareabgsum" value="1" <?php if ($show_sale && !$show_donation) { ?> checked="checked" <?php } ?> />
            <label for="allow_sale">
                <?php _e('sale'); ?>
            </label>
            <?php } ?>
            
            <?php if ($result['allow_rent']) { ?>
            
            <input type="checkbox" id="allow_rent" name="post_allow_rent" class="checkareabgsum" value="1" <?php if ($show_rent && !$show_donation) { ?> checked="checked" <?php } ?> />
            <label for="allow_rent">
                <?php _e('rent'); ?>
            </label>
            <?php } ?>
            
            <?php if ($result['allow_exchange']) { ?>
            
            <input type="checkbox" id="allow_exchange" name="post_allow_exchange" class="checkareabgsum" value="1" <?php if ($show_exchange && !$show_donation) { ?> checked="checked" <?php } ?> />
            <label for="allow_exchange">
                <?php _e('exchange'); ?>
            </label>
            <?php } ?>
            
            </span>
        </p>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() { 
    $('#allow_sale').change(function() {
        if ($('#allow_sale').is(':checked')) {
            $('#container_sale_price').slideDown('fast');
        } else {
            $('#container_sale_price').slideUp('fast');
        }
    });

    $('#allow_rent').change(function() {
        if ($('#allow_rent').is(':checked')) {
            $('#container_rent_price').slideDown('fast');
        } else {
            $('#container_rent_price').slideUp('fast');
        }
    });

    $('#allow_exchange').change(function() {
        if ($('#allow_exchange').is(':checked')) {
            $('#container_exchange').slideDown('fast');
        } else {
            $('#container_exchange').slideUp('fast');
        }
    });

    $('#allow_donation').change(function() {
        if ($('#allow_donation').is(':checked')) {
            $('#allow_sale').removeAttr('checked').trigger('change');			
            $('#allow_rent').removeAttr('checked').trigger('change');
            $('#allow_exchange').removeAttr('checked').trigger('change');
            
            $('#container_donation').slideDown('fast');
        
            $('#allprices').slideUp('fast');
            $('#allpricesbuttons').fadeOut('fast');
        } else {
            $('#container_donation').slideUp('fast');
        
            $('#allprices').slideDown('fast');
            $('#allpricesbuttons').fadeIn('fast');
        }
    });
}); 

</script>
<?php
} // if not $is_single
?>
<div id="allprices" <?php if (_p_isset('allow_donation')) { ?> style="display:none;" <?php } ?>>
    <div class="addpostinnerdiv" id="container_sale_price" <?php if (!$show_sale) { ?> style="display:none;" <?php } ?>>
        <div class="addpostlbl">
            <p>
                <?php _e('Price type for sale') ?><span style="color: red;">*</span>:</p>
        </div>
        <div class="addpostctrl radio" id="container_sale_contract">
            <p>
                <input type="radio" id="sale_contract_finalprice" name="post_sale_contract" class="checkareabgsum" value="0" <?php if (_p('sale_contract') == '0') { ?> checked="checked" <?php } ?> />
                <label for="sale_contract_finalprice"><?php _e('the final price'); ?></label>
                
                <input type="radio" id="sale_contract_approximateprice" name="post_sale_contract" class="checkareabgsum" value="1" <?php if (_p('sale_contract') == 1) { ?> checked="checked" <?php } ?> />
                <label for="sale_contract_approximateprice"><?php _e('approximate price'); ?></label>
                
                <input type="radio" id="sale_contract_bynegotiation" name="post_sale_contract" class="checkareabgsum" value="2" <?php if (_p('sale_contract') == 2) { ?> checked="checked" <?php } ?> />
                <label for="sale_contract_bynegotiation"><?php _e('by negotiation'); ?></label>
            </p>
        </div>
        <div class="" id="container_sale_pricevalue" <?php if (_p('sale_contract', 0) == 2) { ?> style="display:none;" <?php } ?>>
            <div class="addpostlbl">
                <p>
                    <?php _e('Price for sale') ?><span style="color: red;">*</span>:</p>
            </div>
            <div class="addpostctrl">
                <p>
                    <input type="text" id="sale_price" name="post_sale_price" class="txtareabgsum" value="<?php _pe('sale_price') ?>" onkeypress="return isNumberKey(event)" />
                        
                    <select id="sale_currency"  name="post_sale_currency" class="txtareabgcurrency">
                    <option value="AMD" <?php if (_p('sale_currency') == 'AMD') echo 'selected="selected"'; ?>>
                        <?php _e('currency_AMD') ?>
                        </option>
                        <option value="USD" <?php if (_p('sale_currency') == 'USD') echo 'selected="selected"'; ?>>
                        <?php _e('currency_USD') ?>
                        </option>
                        <option value="EUR" <?php if (_p('sale_currency') == 'EUR') echo 'selected="selected"'; ?>>
                        <?php _e('currency_EUR') ?>
                        </option>
                        <option value="RUR" <?php if (_p('sale_currency') == 'RUR') echo 'selected="selected"'; ?>>
                        <?php _e('currency_RUR') ?>
                        </option>
                    </select>
                </p>
            </div>
        </div>
        <?php if(WP_TEST) { ?>
        <div class="addpostctrl radio" id="container_sale_method">
            <p>
                <input type="radio" id="sale_method_finalprice" name="post_sale_method" class="checkareabgsum" value="1" <?php if (_p('sale_method') == 1) { ?> checked="checked" <?php } ?> />
                <label for="sale_method_finalprice"><?php _e('the final price'); ?></label>
                
                <input type="radio" id="sale_method_approximateprice" name="post_sale_method" class="checkareabgsum" value="2" <?php if (_p('sale_method') == 2) { ?> checked="checked" <?php } ?> />
                <label for="sale_method_approximateprice"><?php _e('approximate price'); ?></label>
                
                <input type="radio" id="sale_method_bynegotiation" name="post_sale_method" class="checkareabgsum" value="3" <?php if (_p('sale_method') == 3) { ?> checked="checked" <?php } ?> />
                <label for="sale_method_bynegotiation"><?php _e('by negotiation'); ?></label>
            </p>
        </div>
        <?php } ?>
    </div>
    <div class="addpostinnerdiv" id="container_rent_price" <?php if (!$show_rent) { ?> style="display:none;" <?php } ?>>
        <div class="addpostlbl">
            <p>
                <?php _e('Price type for rent') ?><span style="color: red;">*</span>:</p>
        </div>
        <div class="addpostctrl radio" id="container_rent_contract">
            <p>
                <input type="radio" id="rent_contract_finalprice" name="post_rent_contract" class="checkareabgsum" value="0" <?php if (_p('rent_contract') == '0') { ?> checked="checked" <?php } ?> />
                <label for="rent_contract_finalprice"><?php _e('the final price'); ?></label>
                
                <input type="radio" id="rent_contract_approximateprice" name="post_rent_contract" class="checkareabgsum" value="1" <?php if (_p('rent_contract') == '1') { ?> checked="checked" <?php } ?> />
                <label for="rent_contract_approximateprice"><?php _e('approximate price'); ?></label>
                
                <input type="radio" id="rent_contract_bynegotiation" name="post_rent_contract" class="checkareabgsum" value="2" <?php if (_p('rent_contract') == '2') { ?> checked="checked" <?php } ?> />
                <label for="rent_contract_bynegotiation"><?php _e('by negotiation'); ?></label>
            </p>
        </div><?php ?>
        <div class="" id="container_rent_pricevalue" <?php if (_p('rent_contract', 0) == 2) { ?> style="display:none;" <?php } ?>>
            <div class="addpostlbl">
                <p>
                    <?php _e('Price for rent') ?><span style="color: red;">*</span>:</p>
            </div>
            <div class="addpostctrl">
                <p>
                    <input type="text" id="rent_price" name="post_rent_price" class="txtareabgsum" value="<?php _pe('rent_price') ?>" onkeypress="return isNumberKey(event)" />
                    <select id="rent_currency"  name="post_rent_currency" class="txtareabgcurrency" style="width:21%">
                        <option value="AMD" <?php if (_p('rent_currency') == 'AMD') echo 'selected="selected"'; ?>>
                        <?php _e('currency_AMD') ?>
                        </option>
                        <option value="USD" <?php if (_p('rent_currency') == 'USD') echo 'selected="selected"'; ?>>
                        <?php _e('currency_USD') ?>
                        </option>
                        <option value="EUR" <?php if (_p('rent_currency') == 'EUR') echo 'selected="selected"'; ?>>
                        <?php _e('currency_EUR') ?>
                        </option>
                        <option value="RUR" <?php if (_p('rent_currency') == 'RUR') echo 'selected="selected"'; ?>>
                        <?php _e('currency_RUR') ?>
                        </option>
                        </select>
                        <select id="rent_frequency"  name="post_rent_frequency" class="txtareabgcurrency" style="width:22%">
                        <option value="daily"   <?php if (_p('rent_frequency') == 'hourly') echo 'selected="selected"'; ?>>
                        <?php _e('hourly'); ?>
                        </option>
                        <option value="daily"   <?php if (_p('rent_frequency') == 'daily') echo 'selected="selected"'; ?>>
                        <?php _e('daily'); ?>
                        </option>
                        <option value="monthly" <?php if (_p('rent_frequency') == 'monthly') echo 'selected="selected"'; ?>>
                        <?php _e('monthly'); ?>
                        </option>
                        <option value="annually" <?php if (_p('rent_frequency') == 'annually') echo 'selected="selected"'; ?>>
                        <?php _e('annually'); ?>
                        </option>
                    </select>
                </p>
            </div>
        </div>
        <div>
            <div class="addpostlbl">
                <p>
                    <?php _e('Minimum lease term') ?>:</p>
            </div>
            <div class="addpostctrl">
                <p>
                    <input type="hidden" id="rent_minleaseterm" class="txtbg" value="<?php _pe('rent_minleaseterm') ?>" size="30" name="post_rent_minleaseterm" />
                    <div style="width:20%; float:left; text-align:left;">0</div>
                    <div id="minleaseterm_view" style="width:60%; float:left; text-align:center; font-weight:bold; font-size: 120%">50</div>
                    <div style="width:20%; float:left; text-align:right;" >90</div>
                    <br />
                    <div id="slider_minleaseterm"></div>
                </p>
            </div>
            <div class="addpostlbl">
                <p>
                    <?php _e('Minimum lease term unit') ?>:</p>
            </div>
            <div class="addpostctrl radio" id="rent_measure">
                <p>
                    <?php
    $post_rent_measure = _p('rent_measure');
    if (!$post_rent_measure) {
        $post_rent_measure = 2;
    }
                    ?>
                    <input type="radio" id="rent_measure_h" name="post_rent_measure" class="checkareabgsum" value="1" <?php if ($post_rent_measure == '1') { ?> checked="checked" <?php } ?> />
                    <label for="rent_measure_h"><?php _e('hours'); ?></label>
                    <input type="radio" id="rent_measure_d" name="post_rent_measure" class="checkareabgsum" value="2" <?php if ($post_rent_measure == '2') { ?> checked="checked" <?php } ?> />
                    <label for="rent_measure_d"><?php _e('days'); ?></label>
                    <input type="radio" id="rent_measure_m" name="post_rent_measure" class="checkareabgsum" value="3" <?php if ($post_rent_measure == '3') { ?> checked="checked" <?php } ?> />
                    <label for="rent_measure_m"><?php _e('months'); ?></label>
                    <input type="radio" id="rent_measure_t" name="post_rent_measure" class="checkareabgsum" value="4" <?php if ($post_rent_measure == '4') { ?> checked="checked" <?php } ?> />
                    <label for="rent_measure_t"><?php _e('years'); ?></label>
                </p>
            </div>
        </div>
    </div>
    <div class="addpostinnerdiv" id="container_exchange" <?php if (!$show_exchange) { ?> style="display:none;" <?php } ?>>
        <div class="addpostlbl">
            <p>
                <?php _e('Exchange with') ?>:</p>
        </div>
        <div class="addpostctrl">
            <p>
                <input type="text" id="exchange_with" class="txtbg defaultText" defaultvalue="<?php _e('What do you want in return') ?>" value="<?php echo replace_quotes(_p('exchange_with')); ?>" size="30" name="post_exchange_with" />
                <br />
                <span class="hint"><?php echo sprintf(__('%s characters max'), 120); ?></span>
            </p>
        </div>
    </div>
</div>

<div class="addpostinnerdiv" id="container_donation" <?php if (!$show_donation) { ?> style="display:none;" <?php } ?>>
    <div class="addpostlbl">
        <p>
            <?php _e('Donation') ?>:</p>
    </div>
    <div class="addpostctrl">
        <p>
            <span style="font-size:110%; font-weight: bold;"><?php _e('Thank you!') ?></span></p>
    </div>
</div>
            
            
            
            
            
            
<script type="text/javascript">

$(document).ready(function() {
    $('input[name="post_rent_measure"]').change(function() {
        $( '#rent_minleaseterm' ).val( $( '#slider_minleaseterm' ).slider( 'value' ) );
        $( '#minleaseterm_view' ).text( $( '#slider_minleaseterm' ).slider( 'value' ) + ' ' + $('input[name="post_rent_measure"]:checked + label').text());
    });

    $( '#slider_minleaseterm' ).slider({
        range: 'min',
        value: <?php _pe('rent_minleaseterm', 0) ?>,
        min: 0,
        max: 90,
        slide: function( event, ui ) {
            $( '#rent_minleaseterm' ).val( ui.value );
            $( '#minleaseterm_view' ).text( ui.value + ' ' + $('input[name="post_rent_measure"]:checked + label').text() );
        }
    });
                
    $( '#rent_minleaseterm' ).val( $( '#slider_minleaseterm' ).slider( 'value' ) );
    $( '#minleaseterm_view' ).text( $( '#slider_minleaseterm' ).slider( 'value' ) + ' ' + $('input[name="post_rent_measure"]:checked + label').text());
                
                
    //sale_contract_bynegotiation
    $('[name="post_sale_contract"]').change(function(){ 
        if ($('#sale_contract_bynegotiation').is(':checked')) 
        {
            $('#container_sale_pricevalue').slideUp('fast');
        }
        else
        {
            $('#container_sale_pricevalue').slideDown('fast');
        }
    });
    
    //rent_contract_bynegotiation
    $('[name="post_rent_contract"]').change(function(){ 
        if ($('#rent_contract_bynegotiation').is(':checked')) 
        {
            $('#container_rent_pricevalue').slideUp('fast');
        }
        else
        {
            $('#container_rent_pricevalue').slideDown('fast');
        }
    });
});
    
</script>

<?php
} //helper_price


/* *************************** END ************************ */
/* ******************** filter-renderers ****************** */
/* ******************************************************** */



/* ******************************************************** */
/* ************************* Filters ********************** */
/* ************************** BEGIN *********************** */


include 'ba-helpers/ba-helper-mobile.php';

/* *************************** END ************************ */
/* ******************** filter-renderers ****************** */
/* ******************************************************** */



/* ******************************************************** */
/* ************************* Filters ********************** */
/* ************************** BEGIN *********************** */


include 'ba-helpers/ba-helper-cars.php';

/* *************************** END ************************ */
/* ******************** filter-renderers ****************** */
/* ******************************************************** */



/* ******************************************************** */
/* ******************* ba-helper-salary ******************* */
/* ************************** BEGIN *********************** */


function helper_salary() { ?>
<div class="addpostinnerdiv" id="container_salary" <?php the_hint($id); ?>>
    <div class="addpostlbl">
        <p>
            <?php _e('Salary') ?>:</p>
    </div>
    <div class="addpostctrl radio" id="salary_contract">
        <p>
        <input type="radio" id="price_salary_fixedpayment" name="post_salary_type" class="checkareabgsum" value="0" <?php if (_p('salary_type') == '0') { ?> checked="checked" <?php } ?> />
            <label for="price_salary_fixedpayment"><?php _e('fixed salary'); ?></label>
                
            <input type="radio" id="price_salary_pieceworkpayment" name="post_salary_type" class="checkareabgsum" value="1" <?php if (_p('salary_type') == '1') { ?> checked="checked" <?php } ?> />
            <label for="price_salary_pieceworkpayment"><?php _e('piecework payment'); ?></label>
                
            <input type="radio" id="price_salary_bynegotiation" name="post_salary_type" class="checkareabgsum" value="2" <?php if (_p('salary_type') == '2') { ?> checked="checked" <?php } ?> />
            <label for="price_salary_bynegotiation"><?php _e('by negotiation'); ?></label>
        </p>
    </div>
    <div class="addpostctrl">
        <p>
            <input type="hidden" name="post_allow_salary" id="allow_salary" value="1"/>
            <input type="text" id="salary" name="post_salary" class="txtareabgsum" value="<?php _pe('salary') ?>" onkeypress="return isNumberKey(event)" />
            <select id="payment_currency"  name="post_payment_currency" class="txtareabgcurrency" style="width:21%">
                <option value="AMD" <?php if (_p('payment_currency') == 'AMD') echo 'selected="selected"'; ?>>
                <?php _e('currency_AMD') ?>
                </option>
                <option value="USD" <?php if (_p('payment_currency') == 'USD') echo 'selected="selected"'; ?>>
                <?php _e('currency_USD') ?>
                </option>
                <option value="EUR" <?php if (_p('payment_currency') == 'EUR') echo 'selected="selected"'; ?>>
                <?php _e('currency_EUR') ?>
                </option>
                <option value="RUR" <?php if (_p('payment_currency') == 'RUR') echo 'selected="selected"'; ?>>
                <?php _e('currency_RUR') ?>
                </option>
            </select>
            <select id="payment_frequency"  name="post_payment_frequency" class="txtareabgcurrency" style="width:22%">
                <option value="monthly" <?php if (_p('payment_frequency') == 'monthly') echo 'selected="selected"'; ?>>
                <?php _e('monthly'); ?>
                </option>
                <option value="daily"   <?php if (_p('payment_frequency') == 'daily') echo 'selected="selected"'; ?>>
                <?php _e('daily'); ?>
                </option>
                <option value="hourly"   <?php if (_p('payment_frequency') == 'hourly') echo 'selected="selected"'; ?>>
                <?php _e('hourly'); ?>
                </option>
            </select>
        </p>
    </div>
</div>
<?php
} //helper_salary


function helper_payment() { ?>
<div class="addpostinnerdiv" id="container_payment" <?php the_hint($id); ?>>
    <div class="addpostlbl">
        <p>
            <?php _e('Payment') ?>:</p>
            </div>
            <div class="addpostctrl radio" id="payment_contract">
            <p>
            <input type="radio" id="price_payment_fixedpayment" name="post_payment_type" class="checkareabgsum" value="0" <?php if (_p('payment_type') == '0') { ?> checked="checked" <?php } ?> />
                <label for="price_payment_fixedpayment"><?php _e('fixed payment'); ?></label>
                
                <input type="radio" id="price_payment_pieceworkpayment" name="post_payment_type" class="checkareabgsum" value="1" <?php if (_p('payment_type') == '1') { ?> checked="checked" <?php } ?> />
                <label for="price_payment_pieceworkpayment"><?php _e('piecework payment'); ?></label>
                
                <input type="radio" id="price_payment_bynegotiation" name="post_payment_type" class="checkareabgsum" value="2" <?php if (_p('payment_type') == '2') { ?> checked="checked" <?php } ?> />
                <label for="price_payment_bynegotiation"><?php _e('by negotiation'); ?></label>
            </p>
        </div>
            <div class="addpostctrl">
            <p>
            <input type="hidden" name="post_allow_payment" id="allow_payment" value="1"/>
            <input type="text" id="payment" name="post_payment" class="txtareabgsum" value="<?php _pe('payment') ?>" onkeypress="return isNumberKey(event)" />
            <select id="payment_currency"  name="post_payment_currency" class="txtareabgcurrency" style="width:21%">
                <option value="AMD" <?php if (_p('payment_currency') == 'AMD') echo 'selected="selected"'; ?>>
                <?php _e('currency_AMD') ?>
                </option>
                <option value="USD" <?php if (_p('payment_currency') == 'USD') echo 'selected="selected"'; ?>>
                <?php _e('currency_USD') ?>
                </option>
                <option value="EUR" <?php if (_p('payment_currency') == 'EUR') echo 'selected="selected"'; ?>>
                <?php _e('currency_EUR') ?>
                </option>
                <option value="RUR" <?php if (_p('payment_currency') == 'RUR') echo 'selected="selected"'; ?>>
                <?php _e('currency_RUR') ?>
                </option>
            </select>
            <select id="payment_frequency"  name="post_payment_frequency" class="txtareabgcurrency" style="width:22%">
                <option value="lumpsum"   <?php if (_p('payment_frequency') == 'lumpsum') echo 'selected="selected"'; ?>>
                <?php _e('lump sum'); ?>
                </option>
                <option value="hourly"   <?php if (_p('payment_frequency') == 'hourly') echo 'selected="selected"'; ?>>
                <?php _e('hourly'); ?>
                </option>
                <option value="daily"   <?php if (_p('payment_frequency') == 'daily') echo 'selected="selected"'; ?>>
                <?php _e('daily'); ?>
                </option>
                <option value="monthly" <?php if (_p('payment_frequency') == 'monthly') echo 'selected="selected"'; ?>>
                <?php _e('monthly'); ?>
                </option>
            </select>
        </p>
    </div>
</div>
<?php
} //helper_payment


/* *************************** END ************************ */
/* ******************** filter-renderers ****************** */
/* ******************************************************** */



/* ******************************************************** */
/* ******************** ba-helper-color ******************* */
/* ************************** BEGIN *********************** */

global $colorsliast;

$colorsliast = array( 
    array(4,  'Black', '#ffffff', '#000'),
    array(2,  'White', '#000', '#ffffff'),
    array(6,  'Silver', '#000', '#f0f0f0'),
    array(8,  'Gray', '#000', '#bdbdbd'),
    array(30, 'Beige', '#000', '#eee4d3'),
    array(20, 'Yellow', '#000', '#f8f191'),
    array(22, 'Gold', '#000', '#ead18b'),
    array(28, 'Orange', '#000', '#FF7F00'),
    array(10, 'Red', '#000', '#FF0000'),
    array(34, 'Cherry', '#fff', '#cc1539'),
    array(24, 'Brown', '#fff', '#681a00'),
    array(32, 'Aubergine', '#fff', '#7b425a'),
    array(16, 'Light blue', '#000', '#bcdbf1'),
    array(18, 'Lilac', '#000', '#d1b6e8'),
    array(26, 'Purple', '#fff', '#d14db6'),
    array(14, 'Blue', '#fff', '#0000dd'),
    array(12, 'Green', '#000', '#98e058'),
    array('other', 'other', '#000', false)
    );

function helper_colors($id, $title)
{
    global $colorsliast;
    $values = $colorsliast;
    
    helper_begin($id, $title);
?>
    <select id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">
        <option value="" <?php if (_p($id) == '') { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>
        
        <?php foreach ( $values as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" style="<?php if (isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if (isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if (_p($id) == $v[0]) { ?> selected="selected" <?php } ?> ><?php _e($v[1]); ?></option>
        <?php } ?>
        </select>
        <br />
            
        <?php if (WP_TRANS) { ?>
            <ui id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">				
            <?php foreach ( $values as $v ) { ?>
                <li ><?php echo $v[1]; ?></li>
            <?php } ?>
            </ui>
        <?php } ?>
<?php
    helper_end($id, $title);
} //helper_price


function render_color($id, $title) {
?>
<tr class="render_postinnerdiv">
    <td class="render_postlbl"><?php echo $title ?>:</td>
    <td class="render_postctrl">
        <?php
    
        global $colorsliast;
    
        $val = get_post_meta(get_the_ID(), 'post_' . $id);
        $val = $val[0];
    
        if ($val) {
            foreach($colorsliast as $item) {
                if ($val == $item[0]) {
                    $val = $item;
                    break;
                }
            }
            echo '<strong>', __($val[1]), '</strong>';
        
            if ($val[3] !== false) {
                ?><div style="width: 22px; height: 16px; margin: 2px; border: 1px solid #777; float: right; background-color: <?php echo $val[3] ?>;"></div><?php
            }
        } else {
            _e('not selected');
        }
    ?>
    </td>
</tr>	
<?php
}


function filter_colors($id, $title, $priority = SECONDARY_FILTER)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = arg($args, 'id', '');
        $title	  = arg($args, 'title', '');
        $priority = arg($args, 'priority', SECONDARY_FILTER);
    }
    if (isset($_GET['q' . $id . 'oeq']))
        $priority = USED_FILTER;
    
    filter_begin($id, $title, false, $priority);
    
    
    global $colorsliast;
    $values = $colorsliast;
?>
    <select id="<?php echo $id; ?>" class="select_filters">
        <option value="" <?php if (!isset($_GET['q' . $id . 'oeq'])) { ?> selected="selected" <?php } ?> ><?php _e('Does not matter') ?></option>
        
        <?php foreach ( $values as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" style="<?php if (isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if (isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if (arg($_GET, 'q' . $id . 'oeq', '') == $v[0]) { ?> selected="selected" <?php } ?> ><?php _e($v[1]); ?></option>
        <?php } ?>
    </select>
    <br />
    <br />
    <script>
    $(document).ready(function() {
        $('#<?php echo $id; ?>').change(function() {
            var value = $(this).find('option:checked').val();
            
            if (value == '') {
                advancedFilters['<?php echo $id ?>'] = [{ include: false }];
            } else {
                advancedFilters['<?php echo $id ?>'] = [{type: 'oeq', value: value, include: true }];
            }
        });
    });
    </script>
<?php
    filter_end($id, $title);
} //helper_price

/* *************************** END ************************ */
/* ******************** filter-renderers ****************** */
/* ******************************************************** */



/* ******************************************************** */
/* ************************* Filters ********************** */
/* ************************** BEGIN *********************** */


include 'ba-helpers/ba-helper-home.php';


/* *************************** END ************************ */
/* ******************** filter-renderers ****************** */
/* ******************************************************** */
//////////////////////////////////////////////////////////////////

$plugindir = get_option('home').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));

wp_enqueue_script('ba-htmlhelper', $plugindir . '/ba-htmlhelper.js', array('jQuery', 'jQuery UI'), '1.0');


function helper_group($id, $title)
{
?>
<div class="addpostinnerdiv addpostgroup">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //helper_group

function helper_group_required($id, $title)
{
?>
<div class="addpostinnerdiv addpostrequiredgroup">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //helper_subgroup_required

function helper_group_sub($id, $title)
{
?>
<div class="addpostinnerdiv addpostsubgroup">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //helper_group_sub

function helper_group_optional($id, $title)
{
?>
<div class="addpostinnerdiv addpostoptionalgroup">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //helper_group_optional

function helper_group_optional_begin($id, $title)
{
?>
<div class="addpostinnerdiv addpostoptionalgroup">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //helper_group_optional_begin

function helper_group_optional_end($id)
{
?>
<div class="addpostinnerdiv addpostoptionalgroup">
    <p> <?php echo $title ?> </p>
    </div>
    <?php

} //helper_group_optional_end

if (!function_exists('replace_quotes'))
{
    function replace_quotes($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        $tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}

if (!function_exists('replace_quotes_decode'))
{
    function replace_quotes_decode($text) {
        $healthy = array('\\\'', '\"', '\\\\');
        $yummy   = array('\'', '"', '\\');
        
        $tmp = $text;
        
        $tmp = htmlspecialchars_decode($tmp, ENT_QUOTES);
        $tmp = str_replace($healthy, $yummy, $tmp);
        //$tmp = htmlspecialchars($tmp, ENT_QUOTES);
        
        return $tmp;
    }
}
function helper_upload()
{
?>
            <div class="addpostinnerdiv">
            <div class="addpostlbl">
                <p>
                    <?php _e('Article Content') ?>:</p>
                    </div>
                    <div class="addpostctrl">
                    
                    <?php	include 'ba-upload/upload.php'; ?>

                </p>
            </div>
        </div>
        <?php
    }

function helper_upload_old() {
    helper_group_sub('attfilesgroup', __('Files / Images'));
    
    $format = _p('files');
    
?>
<div class="addpostinnerdiv" id="container_filebox" <?php the_hint($id); ?>>
    <input id="attfiles" name="post_files" type="hidden" value="<?php echo replace_quotes($format) ?>" />
    
    <div class="addpostctrl addpostctrl-full" id="att">
<?php
    
    $list = split('[{]json[}]', $format);
    
    $id = 1;
    
    foreach($list as $item) {
        if (strlen($item) > 3) {
            $info = json_decode(replace_quotes_decode($item));
            
            $id = MD5($info->name);
            
            switch($info->type) {
                case 'image/png': case 'image/jpeg': case 'image/gif': case 'image/bmp': case 'image/x-icon':
                    echo '<div id="att_'. $id . '" class="att-file att-file-image">';
                    echo '<div class="att-file-image-default"></div>';
                    
                    if ($_POST['post_thumbnail'] == $info->thumbnail_url)
                        echo '<input type="radio" class="att-file-image-default-input" id="thumbnail_'. $id . '" name="post_thumbnail" value="' . $info->thumbnail_url . '" checked="checked" />';
                    else
                        echo '<input type="radio" class="att-file-image-default-input" id="thumbnail_'. $id . '" name="post_thumbnail" value="' . $info->thumbnail_url . '"  />';
                    
                    
                    echo '<a href="' . $info->url . '" target="_new"><img style="" alt="' . $info->name . '" src="' . $info->standards_url . '"/></a>' . '<br />';
                    break;
                case 'application/msword': case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                    echo '<div id="att_' . $id . '" class="att-file att-file-word">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/doc.png"/></a>';
                    break;
                case 'text/plain':
                    echo '<div id="att_' . $id . '" class="att-file att-file-text">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/text.png"/></a>';
                    break;
                case 'application/vnd.ms-excel': case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                    echo '<div id="att_' . $id . '" class="att-file att-file-excel">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/excel.png"/></a>';
                    break;
                case 'application/x-zip-compressed':
                    echo '<div id="att_' . $id . '" class="att-file att-file-archive">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/archive.png"/></a>';
                    break;
                case 'application/pdf':
                    echo '<div id="att_' . $id . '" class="att-file att-file-book">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/pdf.png"/></a>';
                    break;
                default:
                    echo '<div id="att_' . $id . '" class="att-file att-file-other">';
                    echo '<a href="' . $info->url . '" target="_new"><img style="width: 128px; height: 128px;" alt="' . $info->name . '" src="/wp-includes/images/icons/unknown.png"/></a>';
            }
            
            echo '<br />';
            
            //echo '<a href="' . $info->url . '" target="_new">' . $info->name . '</a><br />';
            echo '<input type="text" name="post_file_' . MD5($info->name) . '" id="file_' . MD5($info->name) . '" style="width: 90%" defaultvalue="' . __('') . '" value="' . str_replace('"', '&quot;', _p('file_' . MD5($info->name))) . '" />';
            echo '<br />';
            echo 'Size: ' . formatSizeUnits($info->size);
            echo '<a class="button-remove-file" style="color: #f31;">' . __('Remove') . '<div class="file-json" style="display: none;">{json}' . replace_quotes_decode($item) . '</div></a>';
            echo '</div>';
        }
    }
    ?>
        <div class="addpostctrl addpostctrl-full">
            <p>
                <iframe src="upload.php" class="upframe" scrolling="no"></iframe></p>
        </div>
    </div>	
    <br />
</div>
<?php
}

function helper_links_from_net()
{
    if (!isset($_GET['t']))
        return;
?>
<div class="addpostinnerdiv" id="container_images_from_net">
    <div class="addpostlbl">
        <p><?php _e('Web Search') ?>:</p>
        <p style="font-size: 90%; color: #777;"><?php _e('Insert link from search results.') ?>:</p>
    </div>
    <div class="addpostctrl" id="images_from_net">
        <div class="addpostctrl">
            <p>
                <iframe src="<?php echo site_url('/addnew/bing-search/') ?>" class="google-images-frame" scrolling="no"> </iframe>
            </p>
        </div>
    </div>	
    <br />
</div>
<?php
}

function helper_radio($id, $title, $values, $cols = 4) {
    helper_begin($id, $title);
?>
        <table class="checkgrid">
        <?php
        $i = 0;
        foreach ( $values as $v ) {
            if ($i % $cols == 0)
                echo '<tr>';
            
            echo '<td>';
        ?>
            <input type="radio" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>" class="checkareabgsum" value="<?php echo $v[0]; ?>" <?php if (_p($id) == $v[0]) { ?> checked="checked" <?php } ?> />
            <label for="<?php echo $id; ?>_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
            <?php
            
            echo '</td>';
            
            if ($i % $cols == $cols - 1)
                echo '</tr>';
            
            $i++;
        }
        if ($i % $cols != 0)
            echo '</tr>';
        ?>
        </table>
<?php
    helper_end($id, $title);
} //helper_radio

function helper_select($id, $title, $values) {
    helper_begin($id, $title);
?>
    <select id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">
        <option value="" <?php if (_p($id) == '') { ?> selected="selected" <?php } ?> ><?php _e('Please select') ?></option>
            
        <?php foreach ( $values as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" style="<?php if (isset($v[2])) { echo 'color: ' . $v[2] . '; '; } ?><?php if (isset($v[3])) { echo 'background-color: ' . $v[3] . '; '; } ?>" <?php if (_p($id) == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
        <?php } ?>
        </select>
        <br />
<?php
    helper_end($id, $title);
} //helper_select

function helper_yearselector($id, $title, $beginvalue, $endvalue) {
    helper_begin($id, $title);
?>
        <select id="<?php echo $id; ?>"  name="post_<?php echo $id; ?>" class="txtareabgcurrency">
                <option value="0" selected="selected">
                <?php _e('Select year') ?>
                </option>
                <option value="<?php echo $beginvalue ?>" <?php if (_p($id) == $beginvalue) { echo 'selected="selected"'; } ?>><?php echo sprintf(__('%s and older'), $beginvalue); ?></option>
                <?php for($i = $beginvalue + 1; $i <= $endvalue; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if (_p($id) == $i) { echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
                <?php } ?>
            </select>
        <script type="text/javascript">
        $(function() {
            var select_<?php echo $id; ?> = $( "#<?php echo $id; ?>" );
            var slider_<?php echo $id; ?> = $( "<div id='slider_<?php echo $id; ?>'></div>" ).insertAfter( select_<?php echo $id; ?> ).slider({
                min: 1,
                max: <?php echo 2 + $endvalue - $beginvalue ?>,
                range: "min",
                value: select_<?php echo $id; ?>[ 0 ].selectedIndex + 1,
                slide: function( event, ui ) {
                    select_<?php echo $id; ?>[ 0 ].selectedIndex = ui.value - 1;
                }
            });
            
            $("<br /><br />").insertAfter( select_<?php echo $id; ?> );
            
            $( "#<?php echo $id; ?>" ).change(function() {
                slider_<?php echo $id; ?>.slider( "value", this.selectedIndex + 1 );
            });
        });
        </script> 
<?php
    helper_end($id, $title);
} //helper_yearselector

function helper_check_key($id, $title, $key, $values, $cols = 4, $maxcount = 0) {
    helper_begin($id, $title);
?>
    <input type="checkbox" id="<?php echo $id; ?>_key_<?php echo $key[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $key[0]; ?>" class="checkareabgsum helper-check-input helper-check-input-key" value="1" <?php if (_p("{$id}_{$key[0]}", 0) == 1) { ?> checked="checked" <?php } ?> />
    <label for="<?php echo $id; ?>_key_<?php echo $key[0]; ?>"> <?php echo $key[1]; ?> </label>
    <br />
    <div id="<?php echo $id; ?>_subs" class="helper-check-options" style="border-top: 1px solid #eee; <?php if (_p($id . '_' . $key[0], 0) == 1) { ?> display:none; <?php } ?>">
        <table class="checkgrid">
        <?php
        $i = 0;
        foreach ( $values as $v ) {
            if ($i % $cols == 0)
                echo '<tr>';
            
            echo '<td>';
            ?>
                <input type="checkbox" id="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum helper-check-input helper-check-input-option switch_<?php echo $id; ?>" value="1" <?php if (_p("{$id}_{$v[0]}", 0) == 1) { ?> checked="checked" <?php } ?> />
                <label for="<?php echo $id; ?>_switch_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
            <?php
            
            echo '</td>';
            
            if ($i % $cols == $cols - 1)
                echo '</tr>';
            
            $i++;
        }
        if ($i % $cols != 0)
            echo '</tr>';
        ?>
        </table>
    </div>
    <script type="text/javascript">
        (function (h, maxcount) {
            $('.helper-check-input-key', h).change(function() {
                if ($(this).is(':checked')) {
                    $('.helper-check-options', h).slideUp("fast");
                    $('.helper-check-input-option', h).attr('checked', false);
                } else {
                    $('.helper-check-options', h).slideDown("fast");
                }
            });
            
            if (maxcount > 0) {
                var options = $('.helper-check-input-option', h).change(function() {
                    if (options.filter(':checked').length < maxcount) {
                        options.removeAttr('disabled');
                    } else {
                        options.filter(':not(:checked)').attr('disabled', 'disabled');
                    }
                });
                options.change();
            }
        })($('#container_<?php echo $id; ?>'), <?php echo $maxcount ?>);
    </script>
<?php
    helper_end($id, $title);
} //helper_check

function helper_check($id, $title, $values, $cols = 4, $maxcount = 0) {
    helper_begin($id, $title);
?>
    <table class="checkgrid">
        <?php
        $i = 0;
        foreach ( $values as $v ) {
            if ($i % $cols == 0)
                echo '<tr>';
            
            echo '<td>';
        ?>
            <input type="checkbox" id="<?php echo $id; ?>_<?php echo $v[0]; ?>" name="post_<?php echo $id; ?>_<?php echo $v[0]; ?>" class="checkareabgsum helper-check-input helper-check-input-option" value="1" <?php if (_p("{$id}_{$v[0]}", 0) == 1) { ?> checked="checked" <?php } ?> />
            <label for="<?php echo $id; ?>_<?php echo $v[0]; ?>"> <?php echo $v[1]; ?> </label>
            </span>
            <?php
            
            echo '</td>';
            
            if ($i % $cols == $cols - 1)
                echo '</tr>';
            
            $i++;
        }
        if ($i % $cols != 0)
            echo '</tr>';
        ?>
    </table>
    <script type="text/javascript">
        (function (h, maxcount) {
            if (maxcount > 0) {
                var options = $('.helper-check-input-option', h).change(function() {
                    if (options.filter(':checked').length < maxcount) {
                        options.removeAttr('disabled');
                    } else {
                        options.filter(':not(:checked)').attr('disabled', 'disabled');
                    }
                });
                options.change();
            }
        })($('#container_<?php echo $id; ?>'), <?php echo $maxcount ?>);
    </script>
    <?php
    helper_end($id, $title);
} //helper_check

function helper_yes_no($id, $title, $half = false, $hideYes = false, $hideNo = false)
{
    if (is_array($id)) {
        $args = $id;
        
        $id		  = arg($args, 'id', '');
        $title	  = arg($args, 'title', '');
        $half	  = arg($args, 'half', false);
        $hideYes  = arg($args, 'hideYes', false);
        $hideNo   = arg($args, 'hideNo', false);
    }

helper_begin($id, $title, $half);
?>
        <input type="hidden" id="<?php echo $id; ?>" name="post_<?php echo $id; ?>" value="<?php _pe($id); ?>" />
        
        <?php if (!$hideYes) : ?><div id="<?php echo $id; ?>_img_yes" class="check-span check-span-editable check-yes"></div><?php endif; ?>
        <?php if (!$hideNo)  : ?><div id="<?php echo $id; ?>_img_no" class="check-span check-span-editable check-no"></div><?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#<?php echo $id; ?>_img_no').click(statechanged_<?php echo $id; ?>_no);
        $('#<?php echo $id; ?>_img_yes').click(statechanged_<?php echo $id; ?>_yes);
        
        var val = $('#<?php echo $id; ?>').val();
        
        if (val == 1) {
            $('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
        } else if (val == 2) {
            $('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
        }
    });
    
    function statechanged_<?php echo $id; ?>_no()
    {
        $('#<?php echo $id; ?>_img_no').toggleClass('check-no check-no-checked');
        $('#<?php echo $id; ?>_img_yes').addClass('check-yes');
        $('#<?php echo $id; ?>_img_yes').removeClass('check-yes-checked');
        
        if ($('#<?php echo $id; ?>_img_no').hasClass('check-no-checked')) {
            $('#<?php echo $id; ?>').val('1');
        } else {
            $('#<?php echo $id; ?>').val('');
        }
    }
    
    function statechanged_<?php echo $id; ?>_yes()
    {
        $('#<?php echo $id; ?>_img_yes').toggleClass('check-yes check-yes-checked');
        $('#<?php echo $id; ?>_img_no').addClass('check-no');
        $('#<?php echo $id; ?>_img_no').removeClass('check-no-checked');
        
        if ($('#<?php echo $id; ?>_img_yes').hasClass('check-yes-checked')) {
            $('#<?php echo $id; ?>').val('2');
        } else {
            $('#<?php echo $id; ?>').val('');
        }
    }
</script>
<?php

helper_end($id, $title);
} //helper_yes_no

function helper_slider($id, $title, $value, $rate = 1, $min, $max, $text, $begin = '', $end = '') {
    helper_begin($id, $title);
?>
    <input type="hidden" id="<?php echo $id; ?>" class="txtbg" value="<?php _pe($id); ?>" size="30" name="post_<?php echo $id; ?>" />
<?php        
    $per = 100 / ($max - $min + 1);
        
    if ($per < 4) $per = 4;
    if ($per > 30) $per = 30;    
?>
        <!--	
        <div style="width:<?php echo $per; ?>%; float:left; text-align:left; color: #a21;">Ø</div>
        <div style="width:20%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php echo $min * $rate ?></div>
        <div id="<?php echo $id; ?>_view" style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; font-weight:bold; font-size: 120%"><?php echo $value ?></div>
        <div style="width:20%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php echo $max * $rate ?></div>
                
        <br />
        <div id="slider_<?php echo $id ?>"></div>
        -->
        
        <div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; font-weight:bold; font-size: 120%"><?php echo $value ?></div>
        
        <br />
        <!-- Begin - Slite for total_area -->
        <div id="slider_<?php echo $id ?>"></div>
        
        <div style="width:<?php echo $per; ?>%; float:left; text-align:left; color: #a21;">Ø</div>
        <div style="width:40%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if ($begin == '') echo _f($text, $min * $rate); else echo _f($begin, $min * $rate); ?></div>
        <div style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max * $rate); else echo _f($end, $max * $rate); ?></div>
        
        <!-- 
        <div style="width:40%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php echo $min * $rate ?></div>
        <div style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php echo $max * $rate ?></div>
        -->
        <script type="text/javascript">
        $(document).ready(function() {
        $('#slider_<?php echo $id; ?>').slider({
                range: 'min',
                value: <?php if (_p($id) != '') { echo (_p($id) / $rate); } else { echo $min - 1; }; ?>,
                min: <?php echo $min - 1 ?>,
                max: <?php echo $max ?>,
                slide: function( event, ui ) {
                
                if (ui.value > <?php echo $min - 1 ?>) {
                
                $( '#<?php echo $id ?>' ).val(Math.round(1000 * (  ui.value * <?php echo $rate ?> )) / 1000);
                
                var str_<?php echo $id ?> = '<?php echo $text ?>';
                
                $( '#<?php echo $id ?>_view' ).text( str_<?php echo $id ?>.replace('%s', Math.round(1000 * (ui.value * <?php echo $rate ?>)) / 1000) );
                
                } else {
                
                $( '#<?php echo $id ?>' ).val( '' );
                $( '#<?php echo $id ?>_view' ).text('<?php echo $value ?>');
                
                } // if
                } // slide: function
                }) // $slider

                if ($( '#slider_<?php echo $id ?>' ).slider( 'value' ) > <?php echo $min - 1 ?>) {
                var str_<?php echo $id ?> = '<?php echo $text ?>';
                $( '#<?php echo $id ?>_view' ).text( str_<?php echo $id ?>.replace('%s', Math.round(1000 * ($( '#slider_<?php echo $id ?>' ).slider( 'value' ) * <?php echo $rate ?>)) / 1000 ));
                } else {
                $( '#<?php echo $id ?>' ).val( '' );
                $( '#<?php echo $id ?>_view' ).text('<?php echo $value ?>');
                } // if
                
                
                }); // $(document).ready

                </script> 
                <!-- End --- Slite for total_area -->
                
<?php
    helper_end($id, $title);
} //helper_slider

function helper_slider_by_list($id, $title, $value, $min, $max, $text, $list, $begin = '', $end = '') {
    helper_begin($id, $title);
?>
    <input type="hidden" id="<?php echo $id; ?>" class="txtbg" value="<?php _pe($id); ?>" size="30" name="post_<?php echo $id; ?>" />
<?php
    $per = 100 / ($max - $min + 1);
    
    if ($per < 4) $per = 4;
    if ($per > 30) $per = 30;
?>
    <div id="<?php echo $id; ?>_view" style="width:100%; float:left; text-align:center; font-weight:bold; font-size: 120%"><?php echo $value ?></div>
    <br />
    <div id="slider_<?php echo $id ?>"></div>
    <div style="width:<?php echo $per; ?>%; float:left; text-align:left; color: #a21;">Ø</div>
            
    <div style="width:40%; float:left; text-align:left; padding-left: 3px; border-left: 1px solid #ccc;"><?php if ($begin == '') echo  _f($text, $min); else echo _f($begin, $min); ?></div>
    <div style="width:<?php echo (58 - $per); ?>%; float:left; text-align:right; padding-right: 3px; border-right: 1px solid #ccc;" ><?php if ($end == '') echo _f($text, $max); else echo _f($end, $max); ?></div>
    <br />
    <br />
    <script type="text/javascript">
    $(function() {
        (function(o) {
            o.slider.slider({
                range: 'min',
                value: o.value,
                min: o.min,
                max: o.max,
                slide: function( event, ui ) {
                    if (ui.value > o.min) {
                        o.input.val( ui.value );
                    } else {
                        o.input.val( '' );
                    }
                    o.view.text(o.items[ui.value - o.min]);
                }
            });
          
            if (o.slider.slider('value') > o.min) {
                o.view.text(o.items[o.slider.slider('value') - o.min]);
            } else {
                o.input.val('');
                o.view.text(o.items[0]);
            } // if
        })({
            slider: $( '#slider_<?php echo $id; ?>' ),
            min: <?php echo $min - 1 ?>,
            max: <?php echo $max ?>,
            items: [<?php
                        echo "'$value', ";
                        for($i = $min; $i <= $max; $i += 1) {
                            echo "'", (isset($list[$i]) ? sprintf($list[$i], $i) : sprintf($text, $i)), (($i < $max) ? "', " : "'");
                        }
                        ?>],
            value: <?php echo _p($id, $min - 1); ?>,
            input: $('#<?php echo $id ?>'),
            view: $('#<?php echo $id ?>_view'),
            text: '<?php echo $text ?>'
        });
    });
    </script>
<?php
    helper_end($id, $title);
} //helper_slider

function helper_slider_double($id, $title, $value)
{
    helper_begin($id, $title);

?>
            <input readonly="readonly" type="text" id="total_area" class="txtbg" value="<?php echo replace_quotes($_POST['post_total_area']); ?>" size="30" name="post_total_area" />
            <br />
            
            <!-- Begin - Slite for total_area -->
            <div id="slider_total_area"></div>
            <script type="text/javascript">
                $(document).ready(function() {
                    $( "#slider_total_area" ).slider({
                        range: true,
                        values: [10, 20],
                        min: 4,
                        max: 100,
                        slide: function( event, ui ) {
                            $( "#total_area" ).val( ui.values[ 0 ] * 5 + " <?php _e("m") ?>² from " + ui.values[ 1 ] * 5 + " <?php _e("m") ?>² total");
                        }
                    });
                    
                    $( "#total_area" ).val( $( "#slider_total_area" ).slider( "values", 0 ) * 5 + " <?php _e("m") ?>² from " + $( "#slider_total_area" ).slider( "values", 1 ) * 5 + " <?php _e("m") ?>² total");
                });

            </script> 
            <!-- End --- Slite for total_area -->
                    
<?php
    helper_end($id, $title);

} //helper_slider_double

function helper_text($id, $title, $default, $hint)
{
    helper_begin($id, $title);
?>
    <input type="text" id="<?php echo $id; ?>" class="txtbg defaultText" defaultvalue="<?php echo $default; ?>" value="<?php echo replace_quotes(_p($id)); ?>" size="30" name="post_<?php echo $id; ?>">
    <?php
    
    if ($hint)
    {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
            
    helper_end($id, $title);
} //helper_text

function helper_datepicker_select($id, $name, $values, $default = '') {
?>
    <select id="<?php echo "{$id}_{$name}" ?>" class="helper-datepicker-select helper-datepicker-select-<?php echo $name; ?>" name="post_<?php echo "{$id}_{$name}" ?>">
        <?php foreach ( $values as $value => $text ) { ?>
            <option value="<?php echo $value ?>" <?php if (_p("{$id}_{$name}", $default) == $value) { ?> selected="selected" <?php } ?> ><?php echo $text ?></option>
        <?php } ?>
    </select>
<?php
} //helper_select

function helper_datepicker($id, $title, $minDate = 0, $hint) {
    helper_begin($id, $title);
    ?>
    <div>
        <input type="radio" id="datepicker_<?php echo $id; ?>_selected_0" class="helper-datepicker-selected-0" name="post_<?php echo $id; ?>_selected" value="0" <?php if (_p("{$id}_selected", 0) == 0) { ?> checked="checked" <?php } ?> />
        <label for="datepicker_<?php echo $id; ?>_selected_0"><?php _e('Unspecified') ?></label>
    </div>
    <div class="helper-datepicker">
        <input type="radio" id="datepicker_<?php echo $id; ?>_selected_1" class="helper-datepicker-selected-1" name="post_<?php echo $id; ?>_selected" value="1" <?php if (_p("{$id}_selected", 0) == 1) { ?> checked="checked" <?php } ?> />
            <?php
            $range = array();
            for ($i = date('Y') + 3; $i > 1900; $i--)
                $range[$i] = $i;
            
            helper_datepicker_select($id, 'year', $range, date('Y'));
    
            helper_datepicker_select($id, 'month', array(
                    1 => __('January'),
                    2 => __('February'),
                    3 => __('March'),
                    4 => __('April'),
                    5 => __('May'),
                    6 => __('June'),
                    7 => __('July'),
                    8 => __('August'),
                    9 => __('September'),
                    10 => __('October'),
                    11 => __('November'),
                    12 => __('December'),
                    ));
    
            $range = range(0, 31);
            unset($range[0]);
            helper_datepicker_select($id, 'day', $range);
            ?>
    </div>
    <div id="datepicker_<?php echo $id; ?>_DISABLED" style="line-height: 1;"></div>
    
    <script type="">
        $(document).ready(function() {
            <?php if (WPLANG == 'en_EN') echo '
                var loc = "en-GB";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            <?php if (WPLANG == 'ru_RU') echo '
                var loc = "ru";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            <?php if (WPLANG == 'am_HY') echo '
                var loc = "hy";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            
            $('#datepicker_<?php echo $id; ?>')
                .datepicker({ 
                    minDate: '<?php echo $minDate; ?>',
                    altField: "#alternate_<?php echo $id; ?>",
                    altFormat: formatalt,
                    onSelect: function(dateText, inst) {
                        $('#<?php echo $id; ?>').val(dateText);
                    }/*,
                    defaultDate: '<?php echo replace_quotes(_p("alternate_$id")); ?>'*/
                });
                
            $('#datepicker_<?php echo $id; ?>').datepicker( "option", $.datepicker.regional[ loc ] );
            
            
        });
    </script>
    <?php
    
    if ($hint) {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
            
    helper_end($id, $title);
} //helper_text

function helper_datepicker_v1($id, $title, $minDate = 0, $hint)
{
    helper_begin($id, $title);
    ?>
    <input type="text" id="alternate_<?php echo $id; ?>" class="txtbg" style="width: 45%; text-align: center;" value="<?php echo replace_quotes($_POST['post_alternate_' . $id]); ?>" disabled="disabled">
    <input type="hidden" id="<?php echo $id; ?>" name="post_alternate_<?php echo $id; ?>" value="<?php echo replace_quotes($_POST['post_alternate_' . $id]); ?>">
    
    <div id="datepicker_<?php echo $id; ?>" style="line-height: 1;"></div>
    
    <script type="">
        $(document).ready(function() {
            <?php if (WPLANG == 'en_EN') echo '
                var loc = "en-GB";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            <?php if (WPLANG == 'ru_RU') echo '
                var loc = "ru";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            <?php if (WPLANG == 'am_HY') echo '
                var loc = "hy";
                var format = "DD, d MM, yy";
                var formatalt = "dd.mm.yy";
            '; ?>
            
            $('#datepicker_<?php echo $id; ?>')
                .datepicker({ 
                    minDate: '<?php echo $minDate; ?>',
                    altField: "#alternate_<?php echo $id; ?>",
                    altFormat: formatalt,
                    onSelect: function(dateText, inst) {
                        $('#<?php echo $id; ?>').val(dateText);
                    }/*,
                    defaultDate: '<?php echo replace_quotes($_POST['post_alternate_' . $id]); ?>'*/
                });
                
            $('#datepicker_<?php echo $id; ?>').datepicker( "option", $.datepicker.regional[ loc ] );
        });
    </script>
    <?php
    
    if ($hint)
    {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
            
    helper_end($id, $title);
} //helper_text

function helper_textarea($id, $title, $default, $hint, $height = 400)
{
    helper_begin($id, $title);
    /*
    ?>
    <textarea id="<?php echo $id; ?>" class="txtareabgcont defaultText" cols="40" rows="<?php echo $rows; ?>" defaultvalue="<?php echo $default; ?>" name="post_<?php echo $id; ?>"><?php echo replace_quotes(_p($id)); ?></textarea>
    <?php
    */
    ?>
    <textarea id="<?php echo $id; ?>" class="txtareabgcont defaultText" style="height: <?php echo $height; ?>px;" defaultvalue="<?php echo $default; ?>" name="post_<?php echo $id; ?>"><?php echo replace_quotes(_p($id)); ?></textarea>
    <?php
    
    if ($hint)
    {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
            
    helper_end($id, $title);
} //helper_text

function helper_hidden($id)
{
    ?>
    <input type="hidden" id="<?php echo $id; ?>" name="post_<?php echo $id; ?>" value="<?php echo replace_quotes(_p($id)); ?>">
    <?php
} //helper_hidden

function helper_number($id, $title, $default, $units, $hint) {
    helper_begin($id, $title);
    ?>
        <input type="text" id="<?php echo $id; ?>" class="txtbg defaultText" style="width: 280px;" defaultvalue="<?php echo $default; ?>" value="<?php echo replace_quotes(_p($id)); ?>" size="30" name="post_<?php echo $id; ?>" onkeypress="return isNumberKey(event)">
        <?php
        
        if ($hint)
        {
            echo '<br /><span class="hint">' . $hint . '</span>';
        }
        
        ?>
        <select id="<?php echo $id; ?>_unit" name="post_<?php echo $id; ?>_unit" style="width: 180px;">
        <?php foreach ( $units as $v ) { ?>
            <option value="<?php echo $v[0]; ?>" <?php if (arg($_POST, 'post_' . $id . '_unit', '') == $v[0]) { ?> selected="selected" <?php } ?> ><?php echo $v[1]; ?></option>
        <?php } ?>
        </select>
<?php
    helper_end($id, $title);
} //helper_number

function helper_resolution($id, $title, $suggestions) {
    if (is_array($id)) {
        $args = $id;
        
        $id			 = arg($args, 'id', '');
        $title		 = arg($args, 'title', '');
        $suggestions = arg($args, 'suggestions', array());
    }
    
    helper_begin($id, $title);
    ?>
    <div style="margin-bottom: 10px;">
    <?php foreach ($suggestions as $v) { ?>
        <a style="padding: 3px;margin: 2px;background: #DAE9E6;" href="javascript:(function(){$('#<?php echo $id; ?>_width').val(<?php echo $v[0]; ?>).focus();$('#<?php echo $id; ?>_height').val(<?php echo $v[1]; ?>).focus();})()"><?php echo "{$v[0]}x{$v[1]}"; if (isset($v[2]) && $v[2]) echo " ({$v[2]})"; ?></a>
    <?php } ?>
    </div>
    
    <input type="text" id="<?php echo $id; ?>_width" class="txtbg defaultText" style="width: 100px;" defaultvalue="<?php _e('width') ?>" value="<?php echo replace_quotes(_p("{$id}_width")); ?>" size="30" name="post_<?php echo $id; ?>_width" onkeypress="return isNumberKey(event)">
    <span>X</span>
    <input type="text" id="<?php echo $id; ?>_height" class="txtbg defaultText" style="width: 100px;" defaultvalue="<?php _e('height') ?>" value="<?php echo replace_quotes(_p("{$id}_height")); ?>" size="30" name="post_<?php echo $id; ?>_height" onkeypress="return isNumberKey(event)">
    <?php
    helper_end($id, $title);
} //helper_resolution

function helper_user_location($default = '')
{
    $selected = $_POST['post_location'];
    
    if (!$selected)
        $selected = $default;
    
    helper_begin('location', __('Location'));
?>
            <select id="location" name="post_location">
            <option value="-1">
            <?php _e('Select location'); ?>
                </option>
                <?php
                //include '../wp-content/plugins/ba-includes/ba-regions.php';
                
                $regions = getRegions();
                
                foreach ($regions as $key => $value) {
                /*?>
                <option value="<?php echo $key; ?>" <?php if ($selected == $key) { echo 'selected="selected"'; } ?>>
                <?php echo $value ?>
                </option>
                <?php*/
                    echo '<option value="', $key, '" ', ($selected == $key) ? 'selected="selected"' : "", '>', $value, '</option>';
            }
            
                ?>
            </select>
            <?php /* <br /><span class="hint"><?php _e('Please select your region') ?></span> */ ?>
<?php
    helper_end('location', __('Location'));
}

define('USER_DEFAULT', 'USER_DEFAULT');
define('USER_LOCATION', 'USER_LOCATION');

function helper_location($id, $title = '', $default = '')
{
    if (is_array($id)) {
        $args = $id;
        
        $id			= arg($args, 'id', '');
        $title		= arg($args, 'title', '');
    }
    
    helper_begin($id, $title);
    
    $selected = _p($id);
    if (!$selected)
        if ($default == USER_LOCATION) {
            $user_id = get_current_user_id();
            if ($user_id > 0)
                $selected = get_user_meta($user_id, 'location', true);
        } else {
            $selected = $default;
        }
            ?>
    <select id="<?php echo $id ?>" name="post_<?php echo $id ?>">
    <option value=""><?php _e('Select location'); ?></option>
<?php
        $regions = getRegions();
                
        foreach ($regions as $key => $value) {
            echo '<option value="', $key, '" ', ($selected == $key) ? 'selected="selected"' : "", '>', $value, '</option>';
        }
?>
    </select>
    <br /> 
<?php
    helper_end($id, $title);
}

function helper_location_combo($id, $default)
{
?>
<select id="<?php echo $id; ?>" name="post_<?php echo $id; ?>">
    <option value="-1"> <?php echo $default; ?> </option>
    <?php
    
                $regions = getRegions();
                
    foreach ($regions as $key => $value) {
        /* ?><option value="<?php echo $key; ?>" <?php if ($_POST['post_location'] == $key) { echo 'selected="selected"'; } ?>><?php echo $value ?></option><?php */
        echo '<option value="', $key, '" ', ($_POST['post_location'] == $key) ? 'selected="selected"' : "", '>', $value, '</option>';
    }

?>
</select>
<?php
}

function helper_hint($id)
{
?>
<span class="helper-hint" title="<?php global $helper_hints; echo $helper_hints[$id]; ?>">?</span>
<?php
}

if (!function_exists('the_hint'))
{
    function the_hint($id)
    {
        
    }
}

function helper_begin($id, $title, $half = false)
{
    global $requireds;
    ?>
    <div class="addpostinnerdiv<?php if ($half) echo '-half'; ?>" id="container_<?php echo $id; ?>" <?php the_hint($id); ?>>
    <?php if ($title) { ?>
        <div class="addpostlbl<?php if ($half) echo '-half'; ?>">
            <p><?php echo $title; if (isset($requireds[$id])) { echo '<span style="color: red;">*</span>'; } //font-size: 120%; font-weight: bold; ?>:</p>
        </div>
        <div class="addpostctrl<?php if ($half) echo ' addpostctrl-half'; ?>">
    <?php } else { ?>
        <div class="addpostctrl addpostctrl-full">
    <?php } ?>
<?php
}

function helper_end($id = '', $title = '')
{
    ?>
    </div>
</div>
<?php
}

function helper_likebox($likebox_params) {
    if (isset($likebox_params['facebook'])) {
        ?>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) return;
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/<?php echo get_language_code() ?>/all.js#xfbml=1&appId=326575494130260";
             fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <div class="fb-like-box" data-href="<?php echo $likebox_params['facebook'] ?>" data-width="220" data-show-faces="true" data-stream="false" data-header="true"></div>
        <?php 
    }
    if (isset($likebox_params['vkontakte'])) {
        ?>
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?97"></script>

            <!-- VK Widget -->
            <div id="vk_groups"></div>
            <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 0, width: "230", height: "290"}, <?php echo $likebox_params['vkontakte'] ?>);
            </script>
        <?php 
    }
}

define('WD1', pow(2, 0));
define('WD2', pow(2, 1));
define('WD3', pow(2, 2));
define('WD4', pow(2, 3));
define('WD5', pow(2, 4));
define('WD6', pow(2, 5));
define('WD7', pow(2, 6));

define('WD_ALL', pow(2, 7) - 1);

function helper_weekdays($id, $title, $hint = false)
{
    helper_begin($id, $title);
    ?>
    <input type="hidden" id="<?php echo $id; ?>" name="post_<?php echo $id; ?>" value="<?php _pe($id, 0) ?>" />
    
    <a class="weekdays-specials weekdays-specials-everyday" href="javascript:;"><?php _e('Every day')   ?></a>,
    <a class="weekdays-specials weekdays-specials-workweek" href="javascript:;"><?php _e('Workweek')    ?></a>,
    <a class="weekdays-specials weekdays-specials-weekend"  href="javascript:;"><?php _e('Weekend')     ?></a>,
    <a class="weekdays-specials weekdays-specials-unselect" href="javascript:;"><?php _e('Unselect all')?></a>
    
    <div class="weekdays">
        <div class="weekdays-day <?php if ((_p($id, 0) & WD1) == WD1) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD1 ?>"><?php _e('Monday')     ?></div>
        <div class="weekdays-day <?php if ((_p($id, 0) & WD2) == WD2) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD2 ?>"><?php _e('Tuesday')    ?></div>
        <div class="weekdays-day <?php if ((_p($id, 0) & WD3) == WD3) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD3 ?>"><?php _e('Wednesday')  ?></div>
        <div class="weekdays-day <?php if ((_p($id, 0) & WD4) == WD4) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD4 ?>"><?php _e('Thursday')   ?></div>
        <div class="weekdays-day <?php if ((_p($id, 0) & WD5) == WD5) echo 'weekdays-day-selected'; ?> weekdays-day-workweek" value="<?php echo WD5 ?>"><?php _e('Friday')     ?></div>
        <div class="weekdays-day <?php if ((_p($id, 0) & WD6) == WD6) echo 'weekdays-day-selected'; ?> weekdays-day-weekend"  value="<?php echo WD6 ?>"><?php _e('Saturday')   ?></div>
        <div class="weekdays-day <?php if ((_p($id, 0) & WD7) == WD7) echo 'weekdays-day-selected'; ?> weekdays-day-weekend"  value="<?php echo WD7 ?>"><?php _e('Sunday')     ?></div>
    </div>
    <?php
    
    if ($hint !== false) {
        echo '<br /><span class="hint">' . $hint . '</span>';
    }
    
    helper_end($id, $title);
} //helper_text
