<?php


function helper_salary()
{
	
?>
<div class="addpostinnerdiv" id="container_salary" <?php the_hint($id); ?>>
	<div class="addpostlbl">
		<p>
			<?php _e('Salary') ?>:</p>
			</div>
		<div class="addpostctrl radio" id="salary_contract">
			<p>
			<input type="radio" id="price_salary_fixedpayment" name="post_salary_type" class="checkareabgsum" value="0" <?php if(!_p('salary_type')) { ?> checked="checked" <?php } ?> />
				<label for="price_salary_fixedpayment"><?php _e('fixed salary'); ?></label>
				
				<input type="radio" id="price_salary_pieceworkpayment" name="post_salary_type" class="checkareabgsum" value="1" <?php if(_p('salary_type') == 1) { ?> checked="checked" <?php } ?> />
				<label for="price_salary_pieceworkpayment"><?php _e('piecework payment'); ?></label>
				
				<input type="radio" id="price_salary_bynegotiation" name="post_salary_type" class="checkareabgsum" value="2" <?php if(_p('salary_type') == 2) { ?> checked="checked" <?php } ?> />
				<label for="price_salary_bynegotiation"><?php _e('by negotiation'); ?></label>
			</p>
		</div>
			<div class="addpostctrl">
			<p>
			<input type="hidden" name="post_allow_salary" id="allow_salary" value="1"/>
			<input type="text" id="salary" name="post_salary" class="txtareabgsum" value="<?php _pe('salary') ?>" onkeypress="return isNumberKey(event)" />
			<select id="payment_currency"  name="post_payment_currency" class="txtareabgcurrency" style="width:21%">
				<option value="AMD" <?php if(_p('payment_currency') == 'AMD') echo 'selected="selected"'; ?>>
				<?php _e('currency_AMD') ?>
				</option>
				<option value="USD" <?php if(_p('payment_currency') == 'USD') echo 'selected="selected"'; ?>>
				<?php _e('currency_USD') ?>
				</option>
				<option value="EUR" <?php if(_p('payment_currency') == 'EUR') echo 'selected="selected"'; ?>>
				<?php _e('currency_EUR') ?>
				</option>
				<option value="RUR" <?php if(_p('payment_currency') == 'RUR') echo 'selected="selected"'; ?>>
				<?php _e('currency_RUR') ?>
				</option>
			</select>
			<select id="payment_frequency"  name="post_payment_frequency" class="txtareabgcurrency" style="width:22%">
				<option value="monthly" <?php if(_p('payment_frequency') == 'monthly') echo 'selected="selected"'; ?>>
				<?php _e('monthly'); ?>
				</option>
				<option value="daily"   <?php if(_p('payment_frequency') == 'daily') echo 'selected="selected"'; ?>>
				<?php _e('daily'); ?>
				</option>
				<option value="hourly"   <?php if(_p('payment_frequency') == 'hourly') echo 'selected="selected"'; ?>>
				<?php _e('hourly'); ?>
				</option>
			</select>
		</p>
	</div>
</div>
<?php
} //helper_salary


function helper_payment()
{
	
?>
<div class="addpostinnerdiv" id="container_payment" <?php the_hint($id); ?>>
	<div class="addpostlbl">
		<p>
			<?php _e('Payment') ?>:</p>
			</div>
			<div class="addpostctrl radio" id="payment_contract">
			<p>
			<input type="radio" id="price_payment_fixedpayment" name="post_payment_type" class="checkareabgsum" value="0" <?php if(!_p('payment_type')) { ?> checked="checked" <?php } ?> />
				<label for="price_payment_fixedpayment"><?php _e('fixed payment'); ?></label>
				
				<input type="radio" id="price_payment_pieceworkpayment" name="post_payment_type" class="checkareabgsum" value="1" <?php if(_p('payment_type') == 1) { ?> checked="checked" <?php } ?> />
				<label for="price_payment_pieceworkpayment"><?php _e('piecework payment'); ?></label>
				
				<input type="radio" id="price_payment_bynegotiation" name="post_payment_type" class="checkareabgsum" value="2" <?php if(_p('payment_type') == 2) { ?> checked="checked" <?php } ?> />
				<label for="price_payment_bynegotiation"><?php _e('by negotiation'); ?></label>
			</p>
		</div>
			<div class="addpostctrl">
			<p>
			<input type="hidden" name="post_allow_payment" id="allow_payment" value="1"/>
			<input type="text" id="payment" name="post_payment" class="txtareabgsum" value="<?php _pe('payment') ?>" onkeypress="return isNumberKey(event)" />
			<select id="payment_currency"  name="post_payment_currency" class="txtareabgcurrency" style="width:21%">
				<option value="AMD" <?php if(_p('payment_currency') == 'AMD') echo 'selected="selected"'; ?>>
				<?php _e('currency_AMD') ?>
				</option>
				<option value="USD" <?php if(_p('payment_currency') == 'USD') echo 'selected="selected"'; ?>>
				<?php _e('currency_USD') ?>
				</option>
				<option value="EUR" <?php if(_p('payment_currency') == 'EUR') echo 'selected="selected"'; ?>>
				<?php _e('currency_EUR') ?>
				</option>
				<option value="RUR" <?php if(_p('payment_currency') == 'RUR') echo 'selected="selected"'; ?>>
				<?php _e('currency_RUR') ?>
				</option>
			</select>
			<select id="payment_frequency"  name="post_payment_frequency" class="txtareabgcurrency" style="width:22%">
				<option value="lumpsum"   <?php if(_p('payment_frequency') == 'lumpsum') echo 'selected="selected"'; ?>>
				<?php _e('lump sum'); ?>
				</option>
				<option value="hourly"   <?php if(_p('payment_frequency') == 'hourly') echo 'selected="selected"'; ?>>
				<?php _e('hourly'); ?>
				</option>
				<option value="daily"   <?php if(_p('payment_frequency') == 'daily') echo 'selected="selected"'; ?>>
				<?php _e('daily'); ?>
				</option>
				<option value="monthly" <?php if(_p('payment_frequency') == 'monthly') echo 'selected="selected"'; ?>>
				<?php _e('monthly'); ?>
				</option>
			</select>
		</p>
	</div>
</div>
<?php
} //helper_payment

