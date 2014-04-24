<?php


function helper_filters()
{
	 global $specfilters;
?>
<input type="hidden" id="filter_cat" value="<?php echo $_GET['cat'] ?>" />
<input type="hidden" id="filter_author" value="<?php echo $_GET['author'] ?>" />
<input type="hidden" id="filter_page" value="" />
<input type="hidden" id="filter_advanced" value="<?php if($specfilters){ echo '1'; } else { echo '0'; } ?>" />
<div style="width: 100%; float: left; background-color: #fdfdfd; border: 1px solid #eee; text-align: right; padding: 5px 0px 3px 0px;">
	<input type="text" value="<?php echo $_GET['s'] ?>" class="field" id="filter_searchtext" placeholder="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" defalutvalue="<?php _e('Type text to searh.') ?>" style="margin-right: 4px;" />
<?php
//helper_location_combo('qlocationoeq', __('everywhere'));

if(!is_author()) {
    echo '<select id="filter_location" style="width: 200px; margin-right: 4px;">';
    echo '<option value="">', __('everywhere'), '</option>';
    $regions = getRegions();
    foreach ($regions as $key => $value) {
	    echo '<option value="', $key, '" ', ($_GET['qlocationomn'] == $key) ? 'selected="selected"' : "", '>', $value, '</option>';
    }
    echo '</select>';
} //if(!is_author())
?>
	<input type="submit" class="submit" id="filter_searchsubmit" value="<?php esc_attr_e( 'Search', TEMPLATE_DOMAIN ); ?>" style="margin-right: 4px;" />
	<a style="float: left; margin-left: 4px; margin-top: 4px;" id="filter_ShowHideFilters" href="javascript:;"><?php _e('Advanced search'); ?></a>
</div>

<div id="filter_container_filters" style="width: 100%; float: left; background-color: #fdfdfd; border: 1px solid #eee; border-top: 0; <?php if(!$specfilters){ echo 'display: none;'; } ?>">
	<div class="filtersdiv">
		<div class="filterslbl">
			<p>
				<?php _e('Transaction type') ?>:</p>
		</div>
		<div class="filtersctrl">
			<table>
				<tr>
					<td rowspan="2" style="vertical-align: middle;">
						<input type="radio" id="filter_allow_alltransactions" name="transactiontype" class="checkareabgsum" value="" checked="checked" />
						<label for="filter_allow_alltransactions"><?php _e('All types'); ?></label>
					</td>
					<td>
						<input type="radio" id="filter_allow_sale" name="transactiontype" class="checkareabgsum" value="1" <?php if($_GET['qallow_saleoeq'] == 1) { ?> checked="checked" <?php } ?> />
						<label for="filter_allow_sale"><?php _e('sale'); ?></label>
					</td>
					<td>
						<input type="radio" id="filter_allow_rent" name="transactiontype" class="checkareabgsum" value="2" <?php if($_GET['qallow_rentoeq'] == 1) { ?> checked="checked" <?php } ?> />
						<label for="filter_allow_rent"><?php _e('rent'); ?></label>
					</td>
					<td>
						<input type="radio" id="filter_allow_exchange" name="transactiontype" class="checkareabgsum" value="3" <?php if($_GET['qallow_exchangeoeq'] == 1) { ?> checked="checked" <?php } ?> />
						<label for="filter_allow_exchange"><?php _e('exchange'); ?></label>
					</td>
				</tr>
				<tr>
					<td>
						<input type="radio" id="filter_allow_donation" name="transactiontype" class="checkareabgsum" value="4" <?php if($_GET['qallow_donationoeq'] == 1) { ?> checked="checked" <?php } ?> />
						<label for="filter_allow_donation"><?php _e('donate'); ?></label>
					</td>
					<td>
						<input type="radio" id="filter_allow_salary" name="transactiontype" class="checkareabgsum" value="5" <?php if($_GET['qallow_salaryoeq'] == 1) { ?> checked="checked" <?php } ?> />
						<label for="filter_allow_salary"><?php _e('job'); ?></label>
					</td>
					<td>
						<input type="radio" id="filter_allow_payment" name="transactiontype" class="checkareabgsum" value="6" <?php if($_GET['qallow_paymentoeq'] == 1) { ?> checked="checked" <?php } ?> />
						<label for="filter_allow_payment"><?php _e('service'); ?></label>
					</td>
				</tr>
			</table>
		</div>
	</div>
	
	<div class="filtersdiv" id="filter_priceforsale" <?php if(!$_GET['qallow_saleoeq']) { ?> style="display:none;" <?php } ?>>
		<div class="filterslbl">
			<p>
				<?php _e('Price for sale') ?>:</p>
		</div>
		<div class="filtersctrl">
			<p>
				<input type="text" id="filter_sale_price_min" class="txtareabgsum" value="<?php echo $_GET['qsale_realpriceomn'] ?>" onkeypress="return isNumberKey(event)" />
				<span> - </span>
				<input type="text" id="filter_sale_price_max" class="txtareabgsum" value="<?php echo $_GET['qsale_realpriceomx'] ?>" onkeypress="return isNumberKey(event)" />
			
				<select id="filter_sale_currency" class="filter-select-currency">
					<option value="<?php echo cur_GetCurrency('AMD'); ?>"><?php _e('currency_AMD') ?></option>
					<option value="<?php echo cur_GetCurrency('USD'); ?>"><?php _e('currency_USD') ?></option>
					<option value="<?php echo cur_GetCurrency('EUR'); ?>"><?php _e('currency_EUR') ?></option>
					<option value="<?php echo cur_GetCurrency('RUR'); ?>"><?php _e('currency_RUR') ?></option>
				</select>
			</p>
		</div>
	</div>
	
	<div class="filtersdiv" id="filter_priceforrent" <?php if(!$_GET['qallow_rentoeq']) { ?> style="display:none;" <?php } ?>>
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
	<div id="filter_priceforexchange" class="filtersdiv" <?php if(!$_GET['qallow_exchangeoeq']) { ?> style="display:none;" <?php } ?>>
		<div class="filterslbl">
			<p>
				<?php _e('Exchange with') ?>:</p>
		</div>
		<div class="filtersctrl">
			<p>
				<input type="text" id="filter_exchange_with" disabled="disabled" class="txtbg defaultText" defalutvalue="<?php _e('What do you want in return') ?>" value="<?php echo replace_quotes($_GET['exchange_with']); ?>" size="30" />
				<br />
				<span class="hint"><?php echo sprintf(__('%s characters max'), 120); ?></span>
			</p>
		</div>
	</div>

	<div class="filtersdiv" id="filter_fordonation" <?php if(!$_GET['qallow_donationoeq']) { ?> style="display:none;" <?php } ?>>
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

	<div class="filtersdiv" id="filter_forjob" <?php if(!$_GET['qallow_salaryoeq']) { ?> style="display:none;" <?php } ?>>
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

	<div class="filtersdiv" id="filter_forservice" <?php if(!$_GET['qallow_paymentoeq']) { ?> style="display:none;" <?php } ?>>
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

	<div class="filtersdiv" id="filter_forfilters">
		<div class="filterslbl">
			<p>
				<?php _e('Filters') ?>:</p>
		</div>
		<div class="filtersctrl">
			<p>
				<?php 
				$excludeList = array('location', 'sale_realprice', 'rent_realprice', 'allow_sale', 'allow_rent', 'allow_exchange', 'allow_donation', 'allow_salary', 'allow_payment', '', '', '', '');
				
				foreach($specfilters as $id => $filter)
				{
					if(in_array($id, $excludeList))
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
						if($item)
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

<div style="width: 100%; float: left; margin-bottom: 30px;">
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
?>
