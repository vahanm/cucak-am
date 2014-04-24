<?php


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
?>
<div class="addpostinnerdiv" id="container_price" <?php the_hint($id); ?>>
	<div class="addpostlbl">
		<p>
			<?php _e('Transaction type') ?><span style="color: red;">*</span>:</p>
			</div>
			<div class="addpostctrl">
			<p>
			
			<?php if ($result['allow_donation']) { ?>
			<input type="checkbox" id="allow_donation" name="post_allow_donation" class="checkareabgsum" value="1" <?php if($_POST['post_allow_donation']) { ?> checked="checked" <?php } ?> />
			<label for="allow_donation">
				<?php _e('donate'); ?>
			</label>
			
			<span id="allpricesbuttons"  <?php if($_POST['post_allow_donation']) { ?> style="display:none;" <?php } ?>> <span>|</span>
			
			<?php } else { ?>
				<span>
			<?php } ?>
			
			<?php if ($result['allow_sale']) { ?>

			<input type="checkbox" id="allow_sale" name="post_allow_sale" class="checkareabgsum" value="1" <?php if($_POST['post_allow_sale'] && !$_POST['post_allow_donation']) { ?> checked="checked" <?php } ?> />
			<label for="allow_sale">
				<?php _e('sale'); ?>
			</label>
			<?php } ?>
			
			<?php if ($result['allow_rent']) { ?>
			
			<input type="checkbox" id="allow_rent" name="post_allow_rent" class="checkareabgsum" value="1" <?php if($_POST['post_allow_rent'] && !$_POST['post_allow_donation']) { ?> checked="checked" <?php } ?> />
			<label for="allow_rent">
				<?php _e('rent'); ?>
			</label>
			<?php } ?>
			
			<?php if ($result['allow_exchange']) { ?>
			
			<input type="checkbox" id="allow_exchange" name="post_allow_exchange" class="checkareabgsum" value="1" <?php if($_POST['post_allow_exchange'] && !$_POST['post_allow_donation']) { ?> checked="checked" <?php } ?> />
			<label for="allow_exchange">
				<?php _e('exchange'); ?>
			</label>
			<?php } ?>
			
			</span> </p>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() { 

	$('#allow_sale').change(function(){
		if ($('#allow_sale').is(':checked')) 
		{
			$('#container_sale_price').slideDown('fast');
		}
		else
		{
			$('#container_sale_price').slideUp('fast');
		}
	});

	$('#allow_rent').change(function(){
		if ($('#allow_rent').is(':checked')) 
		{
			$('#container_rent_price').slideDown('fast');
		}
		else
		{
			$('#container_rent_price').slideUp('fast');
		}
	});

	$('#allow_exchange').change(function(){
		if ($('#allow_exchange').is(':checked')) 
		{
			$('#container_exchange').slideDown('fast');
		}
		else
		{
			$('#container_exchange').slideUp('fast');
		}
	});

	$('#allow_donation').change(function(){
		if ($('#allow_donation').is(':checked')) 
		{
			$('#allow_sale').removeAttr('checked').trigger('change');			
			$('#allow_rent').removeAttr('checked').trigger('change');
			$('#allow_exchange').removeAttr('checked').trigger('change');
			
			$('#container_donation').slideDown('fast');
		
			$('#allprices').slideUp('fast');
			$('#allpricesbuttons').fadeOut('fast');
		}
		else
		{
			$('#container_donation').slideUp('fast');
		
			$('#allprices').slideDown('fast');
			$('#allpricesbuttons').fadeIn('fast');
		}
	});
}); 

</script>
<div id="allprices" <?php if($_POST['post_allow_donation']) { ?> style="display:none;" <?php } ?>>
	<div class="addpostinnerdiv" id="container_sale_price" <?php if(!$_POST['post_allow_sale']) { ?> style="display:none;" <?php } ?>>
		<div class="addpostlbl">
			<p>
				<?php _e('Price type for sale') ?><span style="color: red;">*</span>:</p>
		</div>
		<div class="addpostctrl radio" id="container_sale_contract">
			<p>
				<input type="radio" id="sale_contract_finalprice" name="post_sale_contract" class="checkareabgsum" value="0" <?php if($_POST['post_sale_contract'] == '0') { ?> checked="checked" <?php } ?> />
				<label for="sale_contract_finalprice"><?php _e('the final price'); ?></label>
				
				<input type="radio" id="sale_contract_approximateprice" name="post_sale_contract" class="checkareabgsum" value="1" <?php if($_POST['post_sale_contract'] == '1') { ?> checked="checked" <?php } ?> />
				<label for="sale_contract_approximateprice"><?php _e('approximate price'); ?></label>
				
				<input type="radio" id="sale_contract_bynegotiation" name="post_sale_contract" class="checkareabgsum" value="2" <?php if($_POST['post_sale_contract'] == '2') { ?> checked="checked" <?php } ?> />
				<label for="sale_contract_bynegotiation"><?php _e('by negotiation'); ?></label>
			</p>
		</div>
		<div class="" id="container_sale_pricevalue" <?php if($_POST['post_sale_contract'] == 2) { ?> style="display:none;" <?php } ?>>
			<div class="addpostlbl">
				<p>
					<?php _e('Price for sale') ?><span style="color: red;">*</span>:</p>
			</div>
			<div class="addpostctrl">
				<p>
					<input type="text" id="sale_price" name="post_sale_price" class="txtareabgsum" value="<?php echo $_POST['post_sale_price'] ?>" onkeypress="return isNumberKey(event)" />
						
					<select id="sale_currency"  name="post_sale_currency" class="txtareabgcurrency">
					<option value="AMD" <?php if($_POST['post_sale_currency'] == 'AMD') echo 'selected="selected"'; ?>>
						<?php _e('currency_AMD') ?>
						</option>
						<option value="USD" <?php if($_POST['post_sale_currency'] == 'USD') echo 'selected="selected"'; ?>>
						<?php _e('currency_USD') ?>
						</option>
						<option value="EUR" <?php if($_POST['post_sale_currency'] == 'EUR') echo 'selected="selected"'; ?>>
						<?php _e('currency_EUR') ?>
						</option>
						<option value="RUR" <?php if($_POST['post_sale_currency'] == 'RUR') echo 'selected="selected"'; ?>>
						<?php _e('currency_RUR') ?>
						</option>
					</select>
				</p>
			</div>
		</div>
	</div>
						<div class="addpostinnerdiv" id="container_rent_price" <?php if(!$_POST['post_allow_rent']) { ?> style="display:none;" <?php } ?>>
		<div class="addpostlbl">
			<p>
				<?php _e('Price type for rent') ?><span style="color: red;">*</span>:</p>
		</div>
		<div class="addpostctrl radio" id="container_rent_contract">
			<p>
				<input type="radio" id="rent_contract_finalprice" name="post_rent_contract" class="checkareabgsum" value="0" <?php if($_POST['post_rent_contract'] == '0') { ?> checked="checked" <?php } ?> />
				<label for="rent_contract_finalprice"><?php _e('the final price'); ?></label>
				
				<input type="radio" id="rent_contract_approximateprice" name="post_rent_contract" class="checkareabgsum" value="1" <?php if($_POST['post_rent_contract'] == '1') { ?> checked="checked" <?php } ?> />
				<label for="rent_contract_approximateprice"><?php _e('approximate price'); ?></label>
				
				<input type="radio" id="rent_contract_bynegotiation" name="post_rent_contract" class="checkareabgsum" value="2" <?php if($_POST['post_rent_contract'] == '2') { ?> checked="checked" <?php } ?> />
				<label for="rent_contract_bynegotiation"><?php _e('by negotiation'); ?></label>
			</p>
		</div><?php ?>
		<div class="" id="container_rent_pricevalue" <?php if($_POST['post_rent_contract'] == 2) { ?> style="display:none;" <?php } ?>>
			<div class="addpostlbl">
				<p>
					<?php _e('Price for rent') ?><span style="color: red;">*</span>:</p>
			</div>
			<div class="addpostctrl">
				<p>
					<input type="text" id="rent_price" name="post_rent_price" class="txtareabgsum" value="<?php echo $_POST['post_rent_price'] ?>" onkeypress="return isNumberKey(event)" />
					<select id="rent_currency"  name="post_rent_currency" class="txtareabgcurrency" style="width:21%">
						<option value="AMD" <?php if($_POST['post_rent_currency'] == 'AMD') echo 'selected="selected"'; ?>>
						<?php _e('currency_AMD') ?>
						</option>
						<option value="USD" <?php if($_POST['post_rent_currency'] == 'USD') echo 'selected="selected"'; ?>>
						<?php _e('currency_USD') ?>
						</option>
						<option value="EUR" <?php if($_POST['post_rent_currency'] == 'EUR') echo 'selected="selected"'; ?>>
						<?php _e('currency_EUR') ?>
						</option>
						<option value="RUR" <?php if($_POST['post_rent_currency'] == 'RUR') echo 'selected="selected"'; ?>>
						<?php _e('currency_RUR') ?>
						</option>
						</select>
						<select id="rent_frequency"  name="post_rent_frequency" class="txtareabgcurrency" style="width:22%">
						<option value="daily"   <?php if($_POST['post_rent_frequency'] == 'hourly') echo 'selected="selected"'; ?>>
						<?php _e('hourly'); ?>
						</option>
						<option value="daily"   <?php if($_POST['post_rent_frequency'] == 'daily') echo 'selected="selected"'; ?>>
						<?php _e('daily'); ?>
						</option>
						<option value="monthly" <?php if($_POST['post_rent_frequency'] == 'monthly') echo 'selected="selected"'; ?>>
						<?php _e('monthly'); ?>
						</option>
						<option value="annually" <?php if($_POST['post_rent_frequency'] == 'annually') echo 'selected="selected"'; ?>>
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
					<input type="hidden" id="rent_minleaseterm" class="txtbg" value="<?php echo $_POST['post_rent_minleaseterm']; ?>" size="30" name="post_rent_minleaseterm" />
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
					$post_rent_measure = $_POST['post_rent_measure'];
					if(!$post_rent_measure)
					{
						$post_rent_measure = 2;
					}
					?>
					<input type="radio" id="rent_measure_h" name="post_rent_measure" class="checkareabgsum" value="1" <?php if($post_rent_measure == '1') { ?> checked="checked" <?php } ?> />
					<label for="rent_measure_h"><?php _e('hours'); ?></label>
					<input type="radio" id="rent_measure_d" name="post_rent_measure" class="checkareabgsum" value="2" <?php if($post_rent_measure == '2') { ?> checked="checked" <?php } ?> />
					<label for="rent_measure_d"><?php _e('days'); ?></label>
					<input type="radio" id="rent_measure_m" name="post_rent_measure" class="checkareabgsum" value="3" <?php if($post_rent_measure == '3') { ?> checked="checked" <?php } ?> />
					<label for="rent_measure_m"><?php _e('months'); ?></label>
					<input type="radio" id="rent_measure_t" name="post_rent_measure" class="checkareabgsum" value="4" <?php if($post_rent_measure == '4') { ?> checked="checked" <?php } ?> />
					<label for="rent_measure_t"><?php _e('years'); ?></label>
				</p>
			</div>
		</div>
	</div>
	<div class="addpostinnerdiv" id="container_exchange" <?php if(!$_POST['post_allow_exchange']) { ?> style="display:none;" <?php } ?>>
		<div class="addpostlbl">
			<p>
				<?php _e('Exchange with') ?>:</p>
		</div>
		<div class="addpostctrl">
			<p>
				<input type="text" id="exchange_with" class="txtbg defaultText" defalutvalue="<?php _e('What do you want in return') ?>" value="<?php echo replace_quotes($_POST['post_exchange_with']); ?>" size="30" name="post_exchange_with" />
				<br />
				<span class="hint"><?php echo sprintf(__('%s characters max'), 120); ?></span>
			</p>
		</div>
	</div>
</div>

<div class="addpostinnerdiv" id="container_donation" <?php if(!$_POST['post_allow_donation']) { ?> style="display:none;" <?php } ?>>
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
		value: <?php if($_POST['post_rent_minleaseterm']) { echo $_POST['post_rent_minleaseterm']; } else { echo 0; }; ?>,
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


?>